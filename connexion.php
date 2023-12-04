<?php
    $username = "root";
    $password = "";
    $database = new PDO("mysql:host=localhost;dbname=DRCoffee;",$username , $password);
    if(isset($_POST["se_connecter"])){
        $email = $_POST["login-email"];
        $password = $_POST["login-password"];
        $connecteuser = $database->prepare("select * from users where email = :email");
        $connecteuser->bindParam("email",$email);
        
        if($connecteuser){

        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="coffee cupochino machine-coffee">
    <meta name="description" content="Découvrez un univers de délices caféinés sur DRCoffee. Notre site vous invite à explorer une gamme exquise de cafés, des grains soigneusement sélectionnés aux machines à capsules de pointe. Plongez dans une expérience de magasinage unique où la passion pour le café rencontre l'innovation. Parcourez notre catalogue pour découvrir des saveurs riches, des accessoires élégants et des machines qui transforment chaque tasse en une célébration de l'art du café.">
    <meta name="author" content="Noureddine DRIOUECH">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="inscription-connexion.css">
    <link rel="icon" href="Images/logoIcon.png" type="image/png">
    <title>DRCoffee</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="home.html">
                    <img src="/Images/logoIcon.png" alt="DRCoffee" >
                    <h1>DR</h1><h1 class="c">C</h1><h1>offee</h1>
                </a>
            </div>
            <ul class="nav-links">
                <li><a href="#">Produits</a></li>
                <li><a href="about.html">À Propos</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="#">Connexion/Inscription</a></li>
                <li><a href="#"><img src="Images/UserIcon.png" alt="Profile" style="height: auto; width: 20px;"></a></li>
                <li><a href="#"><img src="Images/icons-shopping-cart-.png" alt="Panier" style="height: auto; width: 20px;"></a></li>
            </ul>
        </nav>
        <h5>Où chaque gorgée raconte une histoire d'excellence et de passion</h5>
    </header>
    <main>
        <section class="auth">
                <div class="auth-form login-form">
                    <h2>Connexion</h2>
                    <form action="#" method="post">
                        <label for="login-email">Email*</label>
                        <input type="email" id="login-email" name="login-email" required>
        
                        <label for="login-password">Mot de passe*</label>
                        <input type="password" id="login-password" name="login-password" required>
        
                        <button type="submit" name = "se_connecter">Se Connecter</button>
                        <div class="inscrption" style="margin-top: 20px; ">
                            <p style="display: inline;">Vous n'avez pas encore inscris. <a href="connexion-inscription.html" style="color: #D67F2E;"><p style="display: inline; color: #D67F2E;">Inscrivez-vous.</p></a></p>
                        </div> 
                    </form>
                </div>
        </section>
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>Liens Utiles</h3>
                <ul>
                    <li><a href="home.html">Accueil</a></li>
                    <li><a href="#">Produits</a></li>
                    <li><a href="about.html">À Propos</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact</h3>
                <p>Email: nourddinedriouech@gmail.com</p>
                <p>Téléphone: +212 660 131 889</p>
            </div>
            <div class="footer-section">
                <h3>Suivez-nous</h3>
                <ul class="social-icons">
                    <li><a href="https://www.facebook.com/DRIOUECH.Noureddine" target="_blank"><img src="Images/facebookIcon.png" alt="Facebook"></a></li>
                    <li><a href="https://www.instagram.com/noureddine.driouech/" target="_blank"><img src="Images/instagramIcon.png" alt="Instagram"></a></li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2023 DRCoffee. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>