<?php
session_start();
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
        <section id="user-profile">
            <div class="profile-container">
                <div class="user-info">
                    <?php
                    if (isset($_SESSION['user'])) {
                        echo '<h3>' . $_SESSION['user']->name . '</h3>';
                        echo '<p>Adresse e-mail: ' . $_SESSION['user']->email . '</p>';
                    } else {
                        echo '<p>Session user not set.</p>';
                    }
                    ?>
                </div>
                <div class="edit-profile">
                    <h3>Modifier le Profil</h3>

                    <form method="post">
                        <label for="new-email">Nouveau Nom:</label>
                        <input type="text" id="new-name" name="new-name" required />

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
                            print_r($update->errorInfo()); // Add this line to display any errors

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
                <!-- Exemple d'achat -->
                <div class="purchase">
                    <p>Nom du Produit: Café Premium</p>
                    <p>Date d'Achat: 2023-12-01</p>
                    <p>Prix: $19.99</p>
                </div>
                <!-- Ajoutez d'autres achats ici -->
            </div>
        </section>
    </main>
    <?php
    require_once "footer.html";
    ?>
    <script src="home.js"></script>
</body>

</html>