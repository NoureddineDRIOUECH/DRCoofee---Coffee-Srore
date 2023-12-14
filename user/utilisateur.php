<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location:../connexion.php');
} else {

?>
    <?php
    session_start();
    $userId = $_SESSION['user']->id;
    ?>
    <?php
    if (isset($_GET['logout'])) {
        session_unset();
        session_destroy();
        header("location:http://localhost/DRCoffee/inscription.php", true);
    }
    ?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8" />
        <meta name="keywords" content="coffee cupochino machine-coffee" />
        <meta name="description" content="Découvrez un univers de délices caféinés sur DRCoffee. Notre site vous invite à explorer une gamme exquise de cafés, des grains soigneusement sélectionnés aux machines à capsules de pointe. Plongez dans une expérience de magasinage unique où la passion pour le café rencontre l'innovation. Parcourez notre catalogue pour découvrir des saveurs riches, des accessoires élégants et des machines qui transforment chaque tasse en une célébration de l'art du café." />
        <meta name="author" content="Noureddine DRIOUECH" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="home.css" />
        <link rel="stylesheet" href="utilisateur.css" />
        <link rel="icon" href="Images/logoIcon.png" type="image/png" />
        <link rel="stylesheet" href="about.css" />
        <title>Welcome To DRCoffee</title>
    </head>

    <body>
        <?php
        require_once "nav.html";
        ?>
        <main>

            <h2>Mon Profil</h2>
            <div class="commande">
                <h3>Mes commandes</h3>
                <?php
                require_once '../connectDB.php';
                $ordersQuery = $database->prepare("SELECT * FROM commandes WHERE idUser = :idUser AND etat != 'Livrée'");

                $ordersQuery->bindParam(":idUser", $userId);
                $ordersQuery->execute();
                $orders = $ordersQuery->fetchAll(PDO::FETCH_ASSOC);

                if ($orders) {
                    echo '<table>';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Produit</th>';
                    echo '<th>Prix</th>';
                    echo '<th>Quantité</th>';
                    echo '<th>ID</th>';
                    echo '<th>Total</th>';
                    echo '<th>ÉTAT</th>';
                    echo '<th>ACTION</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    foreach ($orders as $order) {
                        $orderID = $order['idCommande'];
                        $productsQuery = $database->prepare("SELECT produits.nomProduit, produits.image, commandeDetails.Quantite, produits.prixProduit FROM commandeDetails INNER JOIN produits ON commandeDetails.IDProduit = produits.idProduit WHERE IDCommande = :orderID");
                        $productsQuery->bindParam(":orderID", $orderID);
                        $productsQuery->execute();
                        $products = $productsQuery->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($products as $index => $product) {
                            echo '<tr>';
                            echo '<td style="height: 90px; width:250px">';
                            echo '<div style= "display:flex; justify-content:space-around; align-items:center; height: 90px;">';
                            echo '<img style="
                            height: 100px;
                            width: 100px;" src="data:' . $product['imageType'] . ';base64,' . base64_encode($product['image']) . '" alt="Product Image" />';
                            echo '<p>' . $product['nomProduit'] . '</p>';
                            echo '</div>';
                            echo '</td>';
                            echo '<td>' . $product['prixProduit'] . ' MAD</td>';
                            echo '<td>X' . $product['Quantite'] . '</td>';
                            if ($index === 0) {
                                echo '<td rowspan="' . count($products) . '">' . $order['idCommande'] . '</td>';
                                echo '<td rowspan="' . count($products) . '">' . $order['total'] . ' MAD</td>';
                                echo '<td rowspan="' . count($products) . '">' . $order['etat'] . '</td>';
                                if ($order['etat'] === 'Confirmée' || $order['etat'] === 'En cours de laivraison') {
                                    echo '<td rowspan="' . count($products) . '"><button onclick="imprimerFacture(' . $orderID . ')">Imprimer la Facture</button></td>';
                                }
                                if ($order['etat'] === 'En attente la confiramtion') {
                                    echo '<td rowspan="' . count($products) . '"><button onclick="confirmOrder(' . $orderID . ')">Confirmer</button></td>';
                                }
                            }
                            echo '</tr>';
                        }
                    }

                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p>Aucune commande passée.</p>';
                }
                ?>
            </div>


            <section id="user-profile">
                <div class="profile-container">
                    <div class="user-info">
                        <?php
                        if (isset($_SESSION['user'])) {
                            echo '<h3>' . $_SESSION['user']->name . '</h3>';
                            echo '<p>Adresse e-mail: ' . $_SESSION['user']->email . '</p>';
                            echo '<p>Télephone: ' . $_SESSION['user']->tel . '</p>';
                            echo '<p>Adresse: ' . $_SESSION['user']->address . '</p>';
                        } else {
                            echo '<p>Connectez-Vous.</p>';
                        }
                        ?>
                    </div>
                    <div class="edit-profile">
                        <h3>Modifier le Profil</h3>

                        <form method="post">
                            <label for="new-email">Nouveau Nom:</label>
                            <input type="text" id="new-name" name="new-name" required />

                            <label for="new-add">Nouvelle Adresse:</label>
                            <input type="text" id="new-add" name="new-add" required />

                            <label for="new-tel">Nouveau Numéro de Télephone:</label>
                            <input type="tel" id="new-tel" name="new-tel" required />

                            <label for="new-email">Nouvelle Adresse E-mail:</label>
                            <input type="email" id="new-email" name="new-email" required />

                            <label for="new-password">Nouveau Mot de Passe:</label>
                            <input type="password" id="new-password" name="new-password" required />
                            <input type="hidden" name="user-id" value="<?php echo $_SESSION['user']->id; ?>">

                            <button type="submit" name="update">Enregistrer les Modifications</button>
                        </form>
                        <?php
                        if (isset($_POST["update"])) {
                            $username = 'root';
                            $password = "";
                            $database = new PDO("mysql:host=localhost;dbname=DRCoffee;", $username, $password);
                            $update = $database->prepare("UPDATE users SET name = :name , password = :password , email = :email where id = :id");
                            $update->bindParam(":name", $_POST['new-name']);
                            $update->bindParam(":email", $_POST['new-email']);
                            $passworduser = sha1($_POST['new-password']);
                            $update->bindParam("id", $_POST['user-id']);
                            $update->bindParam(":password", $passworduser);
                            if ($update->execute()) {
                                echo '<p class="sucsses-message">Les modifications sont traités avec succés.</p>';
                                $user = $database->prepare("SELECT * FROM users where id = :id");
                                $user->bindParam(":id", $_POST['user-id']);
                                $user->execute();
                                $_SESSION['user'] = $user->fetchObject();
                                header("Location: {$_SERVER['PHP_SELF']}", true, 303);
                            } else {
                                echo '<p class="error-message">Une erreur s\'est produite. Réssayer ultérieurement.</p>';
                                print_r($update->errorInfo());
                                echo '<p class="error-message">Une erreur s\'est produite. Réssayer ultérieurement.</p>';
                            }
                        }
                        ?>
                    </div>
                    <div class="logout-btn">
                        <form method="get">
                            <button type="submit" name="logout">Déconnexion</button>
                        </form>
                    </div>
                </div>
                <div class="purchase-history">
                    <h3>Historique des Achats</h3>
                    <?php
                    $historyQuery = $database->prepare("SELECT * FROM commandes WHERE idUser = :idUser AND etat = 'Livrée'");
                    $historyQuery->bindParam(":idUser", $userId);
                    $historyQuery->execute();
                    $historyOrders = $historyQuery->fetchAll(PDO::FETCH_ASSOC);

                    if ($historyOrders) {
                        foreach ($historyOrders as $historyOrder) {
                            $historyOrderID = $historyOrder['idCommande'];
                            $historyProductsQuery = $database->prepare("SELECT produits.nomProduit, produits.prixProduit, commandeDetails.Quantite FROM commandeDetails INNER JOIN produits ON commandeDetails.IDProduit = produits.idProduit WHERE IDCommande = :historyOrderID");
                            $historyProductsQuery->bindParam(":historyOrderID", $historyOrderID);
                            $historyProductsQuery->execute();
                            $historyProducts = $historyProductsQuery->fetchAll(PDO::FETCH_ASSOC);

                            echo '<div class="purchase">';
                            echo '<p>Date d\'Achat: ' . $historyOrder['date'] . '</p>';

                            $totalAmount = 0;

                            foreach ($historyProducts as $historyProduct) {
                                echo '<p>Nom du Produit: ' . $historyProduct['nomProduit'] . '</p>';
                                echo '<p>Prix: ' . $historyProduct['prixProduit'] . ' MAD</p>';
                                echo '<p>Quantité: ' . $historyProduct['Quantite'] . '</p>';
                                $totalAmount += $historyProduct['prixProduit'] * $historyProduct['Quantite'];
                            }
                            echo '<p>Total: ' . $totalAmount . ' MAD</p>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Aucun historique d\'achat disponible.</p>';
                    }
                    ?>
                </div>

            </section>

        </main>
        <?php
        require_once "footer.html";
        ?>
        <script src="home.js"></script>
        <script src="utilisateur.js"></script>
    </body>

    </html>
<?php
}
?>