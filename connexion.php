<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="coffee cupochino machine-coffee">
    <meta name="description"
        content="Découvrez un univers de délices caféinés sur DRCoffee. Notre site vous invite à explorer une gamme exquise de cafés, des grains soigneusement sélectionnés aux machines à capsules de pointe. Plongez dans une expérience de magasinage unique où la passion pour le café rencontre l'innovation. Parcourez notre catalogue pour découvrir des saveurs riches, des accessoires élégants et des machines qui transforment chaque tasse en une célébration de l'art du café.">
    <meta name="author" content="Noureddine DRIOUECH">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="inscription-connexion.css">
    <link rel="icon" href="Images/logoIcon.png" type="image/png">
    <title>DRCoffee</title>
</head>

<body>
    <?php
    require_once "nav.html";
    ?>
    <main>
        <section class="auth">
            <div class="auth-form login-form">
                <h2>Connexion</h2>
                <form action="#" method="post">
                    <label for="login-email">Email*</label>
                    <input type="email" id="login-email" name="login-email" required>

                    <label for="login-password">Mot de passe*</label>
                    <input type="password" id="login-password" name="login-password" required>

                    <button type="submit" name="se_connecter">Se Connecter</button>
                    <div class="inscrption" style="margin-top: 20px; ">
                        <p style="display: inline;">Avez-vous oublié le mot de passe. <a href="reset.php"
                                style="color: #D67F2E;">
                                <p style="display: inline; color: #FF7E12; font-weight: bold;">Rénitialiser le.
                                </p>
                            </a>
                        </p>
                        <p style="display: inline;">Vous n'avez pas encore inscris. <a href="inscription.php"
                                style="color: #D67F2E;">
                                <p style="display: inline; color: #FF7E12; font-weight: bold;">Inscrivez-vous.</p>
                            </a>
                        </p>
                    </div>
                </form>
                <?php
                $username = "root";
                $password = "";
                $database = new PDO("mysql:host=localhost;dbname=DRCoffee;", $username, $password);

                if (isset($_POST["se_connecter"])) {
                    $email = $_POST["login-email"];
                    $passworduser = sha1($_POST["login-password"]);
                    $connecteuser = $database->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
                    $connecteuser->bindParam("email", $email);
                    $connecteuser->bindParam("password", $passworduser);
                    $connecteuser->execute();
                    if ($connecteuser->rowCount() === 1) {
                        $user = $connecteuser->fetchObject();
                        if ($user->activated == false) {
                            echo '<p class="error-message">Votre compte n\'est pas activé. Veuillez vérifier votre email pour activer votre compte.</p>';
                        } else {
                            session_start();
                            $_SESSION["user"] = $user;
                            if ($user->role === 'user') {
                                header("location:user/index.php", true);
                            }
                            if ($user->role === 'admin') {
                                header("location:admin/index.php", true);
                            }
                        }
                    } else {
                        echo '<p class="error-message">Les informations d\'identification sont incorrectes. Veuillez réessayer.</p>';
                    }
                }
                ?>
            </div>
        </section>
        <?php
        require_once "footer.html";
        ?>
        <script src="home.js"></script>
</body>

</html>