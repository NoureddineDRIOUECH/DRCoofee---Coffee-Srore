<?php
session_start();
require_once '../connectDB.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="coffee cupochino machine-coffee">
    <meta name="description" content="Découvrez un univers de délices caféinés sur DRCoffee. Notre site vous invite à explorer une gamme exquise de cafés, des grains soigneusement sélectionnés aux machines à capsules de pointe. Plongez dans une expérience de magasinage unique où la passion pour le café rencontre l'innovation. Parcourez notre catalogue pour découvrir des saveurs riches, des accessoires élégants et des machines qui transforment chaque tasse en une célébration de l'art du café.">
    <meta name="author" content="Noureddine DRIOUECH">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Images/logoIcon.png" type="image/png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="adminPanel.css" />
    <title>Administration - DRCoffee</title>
</head>

<body>

    <div class="menu">
        <ul>
            <li>
                <h2 style="margin-bottom: 30px; margin-top: 10px">Bonjour Mr.<?php echo $_SESSION['user']->name ?></h2>
            </li>
            <li>
                <a class="active" href='#main'>
                    <i class="fas fa-home"> </i>
                    <p>Menu Principale</p>
                </a>
            </li>
            <li>
                <a href="#users">
                    <i class="fas fa-user-group"> </i>
                    <p>Utilisateurs</p>
                </a>
            </li>
            <li>
                <a href="#commandes">
                    <i class="fas fa-pen"> </i>
                    <p>Commandes</p>
                </a>
            </li>
            <li>
                <a href="#products">
                    <i class="fas fa-table"> </i>
                    <p>Produits</p>
                </a>
            </li>

            <li>
                <a href="#stats">
                    <i class="fas fa-chart-pie"> </i>
                    <p>Statistiques</p>
                </a>
            </li>
            <button onclick="logout()" class="logout">

                <i class="fas fa-sign-out"> </i>
                <p>Deconnexion</p>

            </button>
        </ul>
    </div>
    <div class="content">
        <div id="main" class="title">
            <p>Menu Principale</p>
            <i class="fas fa-chart-bar"></i>
        </div>
        <div class="data-into">
            <div class="box">
                <i class="fas fa-user"></i>
                <div class="data">
                    <p>Utilisateurs</p>
                    <span><?php
                            $users = $database->prepare("SELECT * FROM users WHERE role = 'user'");
                            $users->execute();
                            echo $users->rowCount();
                            ?></span>
                </div>
            </div>
            <div class="box">
                <i class="fas fa-pen"></i>
                <div class="data">
                    <p>Commandes</p>
                    <span><?php
                            $cmd = $database->prepare("SELECT * FROM commandes WHERE etat = 'Confirmée'");
                            $cmd->execute();
                            echo $cmd->rowCount();
                            ?></span>
                </div>
            </div>
            <div class="box">
                <i class="fas fa-table"></i>
                <div class="data">
                    <p>Produits</p>
                    <span><?php
                            $prd = $database->prepare("SELECT * FROM produits");
                            $prd->execute();
                            echo $prd->rowCount();
                            ?></span>
                </div>
            </div>
            <div class="box">
                <i class="fas fa-dollar"></i>
                <div class="data">
                    <p>Revenus</p>
                    <span>
                        <?php
                        $totalRevenue = 0;

                        $confirmedOrders = $database->prepare("SELECT * FROM commandes WHERE etat IN ('Confirmée', 'Livrée')");
                        $confirmedOrders->execute();

                        while ($order = $confirmedOrders->fetch(PDO::FETCH_ASSOC)) {
                            $orderID = $order['idCommande'];
                            $orderDetails = $database->prepare("SELECT produits.prixProduit, commandeDetails.Quantite FROM commandeDetails 
                        INNER JOIN produits ON commandeDetails.IDProduit = produits.idProduit 
                        WHERE IDCommande = :orderID");
                            $orderDetails->bindParam(":orderID", $orderID);
                            $orderDetails->execute();

                            while ($detail = $orderDetails->fetch(PDO::FETCH_ASSOC)) {
                                $totalRevenue += $detail['prixProduit'] * $detail['Quantite'];
                            }
                        }

                        echo $totalRevenue . " MAD";
                        ?>
                    </span>
                </div>
            </div>

        </div>
        <div id="commandes" class="title">
            <p>Commandes</p>
            <i class="fas fa-pen"></i>
        </div>
        <?php
        $commandes = $database->prepare("SELECT * FROM commandes WHERE etat = 'Confirmée'");
        $commandes->execute();

        while ($data = $commandes->fetch(PDO::FETCH_ASSOC)) {
            $userDetails = $database->prepare("SELECT name, tel, address FROM users WHERE id = :userId");
            $userDetails->bindParam(":userId", $data['idUser']);
            $userDetails->execute();
            $userData = $userDetails->fetch(PDO::FETCH_ASSOC);

            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Nom de l\'Utilisateur</th>';
            echo '<th>Téléphone</th>';
            echo '<th>Adresse</th>';
            echo '<th>Total en MAD</th>';
            echo '<th>Articles Commandés</th>';
            echo '<th>Quantité</th>';
            echo '<th>Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            $orderID = $data['idCommande'];
            $productsQuery = $database->prepare("SELECT produits.nomProduit, commandeDetails.Quantite FROM
        commandeDetails INNER JOIN produits ON commandeDetails.IDProduit = produits.idProduit WHERE IDCommande =
        :orderID");
            $productsQuery->bindParam(":orderID", $orderID);
            $productsQuery->execute();
            $products = $productsQuery->fetchAll(PDO::FETCH_ASSOC);

            foreach ($products as $index => $product) {
                echo '<tr>';
                if ($index === 0) {
                    echo '<td rowspan="' . count($products) . '">' . $userData['name'] . '</td>';
                    echo '<td rowspan="' . count($products) . '">' . $userData['tel'] . '</td>';
                    echo '<td rowspan="' . count($products) . '">' . $userData['address'] . '</td>';
                    echo '<td rowspan="' . count($products) . '">' . $data['total'] . ' MAD</td>';
                }
                echo '<td>' . $product['nomProduit'] . '</td>';
                echo '<td>' . $product['Quantite'] . '</td>';
                if ($index === 0) {
                    echo '<td rowspan="' . count($products) . '"><button class="process-btn" data-order-id="' . $data['idCommande'] . '">Traiter</button></td>';
                }
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        }
        ?>


        <div id="products" class="title">
            <p>Produits</p>
            <i class="fas fa-table"></i>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Produit</th>
                    <th>Prix en MAD</th>
                    <th>Quantié</th>
                    <th>Description</th>
                    <th>Catégorie</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $products = $database->prepare("SELECT * FROM produits");
                $products->execute();
                while ($data = $products->fetch(PDO::FETCH_ASSOC)) {
                    $getFile = "data:" . $data['imageType'] . ";base64," . base64_encode($data["image"]);
                    echo ' <tr>

                    <td> <img src="' . $getFile . '" style = "width : 100px"/></td>
                            <td>' . $data['nomProduit'] . '</td>
                            <td>' . $data['prixProduit'] . '</td>
                            <td>' . $data['stock'] . '</td>
                            <td>' . $data['description'] . '</td>
                            <td>' . $data['categoriesProduis'] . '</td>
                            <td>
                                <button onclick="deleteProduct(' . $data['idProduit'] . ')" class="delete-btn">Supprimer</button>
                            </td>
                        </tr>';
                } ?>
            </tbody>
            <tfoot>
                <button class="addP" class="edit-btn" onclick="toggleAddProductSection()">Ajouter Produit</button>
                <div class="add-product-form" style="display:none;">
                    <form method="post" enctype="multipart/form-data">
                        <label for="productName">Nom du Produit:</label>
                        <input type="text" id="productName" name="productName" required>

                        <label for="productPrice">Prix en MAD:</label>
                        <input type="number" id="productPrice" name="productPrice" required>

                        <label for="productStock">Quantité en Stock:</label>
                        <input type="number" id="productStock" name="productStock" required>


                        <label for="productImage">Image de Produit:</label>
                        <input type="file" accept=".jpg" id="productImage" name="productImage" required>

                        <label for="productDescription">Description:</label>
                        <textarea id="productDescription" name="productDescription" required></textarea>

                        <label for="productCategory">Catégorie:</label>
                        <select id="productCategory" name="productCategory" required>
                            <option value="Capsules">Capsules</option>
                            <option value="Machines">Machines</option>
                            <option value="Grains">Grains</option>
                            <option value="Accessoires">Accessoires</option>
                            <option value="Chocolat">Chocolat</option>
                            <option value="Gobelets">Gobelets</option>
                        </select>

                        <button type="submit" name="addProduct" class="edit-btn">Ajouter Produit</button>
                    </form>
                    <?php
                    if (isset($_POST['addProduct'])) {
                        $name = $_POST["productName"];
                        $price = $_POST["productPrice"];
                        $stock = $_POST["productStock"];
                        $description = $_POST["productDescription"];
                        $categorie = $_POST["productCategory"];
                        $image = file_get_contents($_FILES['productImage']['tmp_name']);

                        $addProduct = $database->prepare("INSERT INTO produits (nomProduit, prixProduit, stock, description, categoriesProduis, image, imageType) VALUES (:name, :price, :stock, :description, :categorie, :image, 'jpg')");

                        $addProduct->bindParam(":name", $name);
                        $addProduct->bindParam(":price", $price);
                        $addProduct->bindParam(":stock", $stock);
                        $addProduct->bindParam(":description", $description);
                        $addProduct->bindParam(":categorie", $categorie);
                        $addProduct->bindParam(":image", $image);

                        if ($addProduct->execute()) {
                            echo "product added successfully";
                        }
                    }
                    ?>

                </div>
            </tfoot>
        </table>

        <div id="users" class="title">
            <p>Utilisateurs</p>
            <i class="fas fa-user"></i>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom de l'Utilisateur</th>
                    <th>Email</th>
                    <th>Adresse</th>
                    <th>Télephone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $users = $database->prepare("SELECT * FROM users WHERE role = 'user'");
                $users->execute();
                while ($data = $users->fetch(PDO::FETCH_ASSOC)) {
                    echo ' <tr>
                            <td>' . $data['id'] . '</td>
                            <td>' . $data['name'] . '</td>
                            <td>' . $data['email'] . '</td>
                            <td>' . $data['address'] . '</td>
                            <td>' . $data['tel'] . '</td>
                            <td>
                              <button onclick="deleteUser(' . $data['id'] . ')" class="delete-btn">Supprimer</button>
                            </td>
                        </tr>';
                } ?>
            </tbody>
            <tfoot>
                <div class="add-one">
                    <i class="fas fa-user-plus"></i>
                    <button class="edit-btn" onclick="toggleAddUserForm()">Ajouter un utilisateur</button>

                </div>


                <div class="add-user-form" style="display: none">
                    <form method="post">
                        <label for="name">Nom de l'utilisateur:</label>
                        <input type="text" id="name" name="name" required />

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required />

                        <label for="number">Numéro de Téléphone :</label>
                        <input type="number" id="number" name="tel" required />
                        <label for="address">Adresse:</label>
                        <input type="text" id="address" name="address" required />
                        <label for="password">Mot de passe:</label>
                        <input type="password" id="password" name="password" required />

                        <label for="userRole">Role:</label>
                        <select id="userRole" name="userRole" required>
                            <option value="admin">Admin</option>
                            <option value="user">Utilisateur Normale</option>
                        </select>

                        <button type="submit" name="addUser" class="add-user-btn">Ajouter Utilisateur</button>
                    </form>
                    <?php
                    if (isset($_POST['addUser'])) {
                        $name = $_POST["name"];
                        $passworduser = sha1($_POST["password"]);
                        $email = $_POST["email"];
                        $address = $_POST["address"];
                        $tel = $_POST["tel"];
                        $role = $_POST['userRole'];
                        $adduser = $database->prepare("INSERT INTO users (name, email, tel , address, password,activated, security_code ,role) VALUES (:name, :email, :tel , :address, :password, true, :security_code , :role)");
                        $adduser->bindParam(":email", $email);
                        $adduser->bindParam(":password", $passworduser);
                        $adduser->bindParam(":name", $name);
                        $adduser->bindParam(":address", $address);
                        $adduser->bindParam(":tel", $tel);
                        $adduser->bindParam(":role", $role);
                        $security_code = md5(date("h:m:s"));
                        $adduser->bindParam(":security_code", $security_code);
                        if ($adduser->execute()) {
                            echo "user added succefuly";
                        }
                    }
                    ?>
                </div>
            </tfoot>
        </table>
        <div id="stats" class="title">
            <p>Statistiques de Ventes</p>
            <i class="fas fa-chart-pie"></i>
        </div>
        <div id="statistiques-ventes">
            <div class="sales-statistics">
                <?php
                $currentMonth = date('m');
                $totalSalesQuery = $database->prepare("SELECT SUM(total) AS totalSales FROM commandes WHERE MONTH(date) = :currentMonth");
                $totalSalesQuery->bindParam(':currentMonth', $currentMonth);
                $totalSalesQuery->execute();
                $totalSales = $totalSalesQuery->fetchColumn();
                echo '<p>Total des ventes du mois en cours : ' . $totalSales . ' MAD</p>';


                $totalOrdersQuery = $database->query("SELECT COUNT(*) AS totalOrders FROM commandes");
                $totalOrders = $totalOrdersQuery->fetchColumn();
                echo '<p>Nombre total de commandes : ' . $totalOrders . '</p>';

                if ($totalOrders > 0) {
                    $averageOrderValue = $totalSales / $totalOrders;
                    echo '<p>Valeur moyenne des commandes : ' . $averageOrderValue . ' MAD</p>';
                } else {
                    echo '<p>Valeur moyenne des commandes : Aucune commande disponible</p>';
                }

                $topSellingProductsQuery = $database->query("SELECT produits.nomProduit, SUM(commandeDetails.Quantite) AS totalQuantity
            FROM commandeDetails
            INNER JOIN produits ON commandeDetails.IDProduit = produits.idProduit
            GROUP BY produits.nomProduit
            ORDER BY totalQuantity DESC
            LIMIT 5");

                $topSellingProducts = $topSellingProductsQuery->fetchAll(PDO::FETCH_ASSOC);

                echo '<p>Produits les plus vendus :</p>';
                echo '<ul>';
                foreach ($topSellingProducts as $product) {
                    echo '<li>' . $product['nomProduit'] . ' - Quantité : ' . $product['totalQuantity'] . '</li>';
                }
                echo '</ul>';
                ?>
            </div>
        </div>

        <script src="admin.js"></script>
</body>

</html>