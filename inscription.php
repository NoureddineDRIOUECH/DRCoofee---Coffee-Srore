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
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="home.html">
                    <img src="/Images/logoIcon.png" alt="DRCoffee">
                    <h1>DR</h1>
                    <h1 class="c">C</h1>
                    <h1>offee</h1>
                </a>
            </div>
            <ul class="nav-links">
                <li><a href="#">Produits</a></li>
                <li><a href="about.html">À Propos</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="#">Connexion/Inscription</a></li>
                <li><a href="#"><img src="Images/UserIcon.png" alt="Profile" style="height: auto; width: 20px;"></a>
                </li>
                <li><a href="#"><img src="Images/icons-shopping-cart-.png" alt="Panier"
                            style="height: auto; width: 20px;"></a></li>
            </ul>
        </nav>
        <h5>Où chaque gorgée raconte une histoire d'excellence et de passion</h5>
    </header>
    <main>
        <section class="Inscription-Form">
            <div class="auth-form inscri-form">
                <h2>Inscription</h2>
                <form method="post">
                    <label for="name">Nom Complet*</label>
                    <input type="text" id="name" name="name" required>
                    <label for="login-email">Email*</label>
                    <input type="email" id="login-email" name="email" required>
                    <label for="login-password">Mot de passe*</label>
                    <input type="password" id="login-password" name="password" required>
                    <!-- <label for="login-password">Confirmer le Mot de passe*</label>
                    <input type="password" id="login-password" name="password" required> -->
                    <button type="submit" name="s_incrire">S'incrire</button>
                </form>
                <?php                       
                        $username = 'root';
                        $password = "";
                        $database = new PDO("mysql:host=localhost;dbname=DRCoffee;",$username , $password);
                        if (isset($_POST["s_incrire"])) {
                            $checkmail = $database->prepare("SELECT * FROM users WHERE email = :email");
                            $email = $_POST["email"];
                            $checkmail->bindParam(":email",$email);
                            $checkmail->execute();
                            if($checkmail->rowCount() > 0 ){
                                echo "<div>Cet email adresse déja existe ):</div>";
                            }else{
                                $name = $_POST["name"];
                                $password = $_POST["password"];
                                $adduser = $database->prepare("INSERT INTO users (name, email, password,activated, security_code) VALUES (:name, :email, :password, false, :security_code)");
                                $adduser->bindParam(":email",$email);
                                $adduser->bindParam(":password",$password);
                                $adduser->bindParam(":name",$name);
                                $security_code = md5(date("h:m:s"));
                                $adduser->bindParam(":security_code",$security_code);
                                if ($adduser->execute()) {
                                    echo "<div>Compte est crée avec succées :)</div>";
                                    require_once "mail.php";
                                    $mail->addAddress($email);
                                    $mail->Subject = "Code de Verification DRCoffee";
                                    $mail->Body = '<body style="font-family: \'Roboto\', sans-serif; background-color: #f4f4f4; color: #333; margin: 0; padding: 20px;">
                                                        <div style="max-width: 600px; margin: 0 auto; background-color: #fff; border-radius: 5px; overflow: hidden; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                                                            <div style="background-color: #D67F2E; padding: 20px; text-align: center; color: #fff;">
                                                                <h1 style="margin: 0;">DRCoffee</h1>
                                                            </div>
                                                            <div style="padding: 20px;">
                                                                <h2 style="color: #D67F2E;">Confirmation d\'Inscription</h2>
                                                                <p>Merci de vous être inscrit sur DRCoffee. Veuillez cliquer sur le lien ci-dessous pour confirmer votre adresse e-mail :</p>
                                                                <p style="text-align: center;">
                                                                    <a href="http://localhost/DRCoffee/active.php?code='.$security_code.'". style="display: inline-block; background-color: #D67F2E; color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 5px;">Confirmer l\'Inscription</a>
                                                                </p>
                                                                <p>Si vous n\'avez pas tenté de vous inscrire sur DRCoffee, veuillez ignorer cet e-mail.</p>
                                                            </div>
                                                            <div style="background-color: #f4f4f4; padding: 10px; text-align: center;">
                                                                <p style="margin: 0; color: #666;">DRCoffee - Adresse, Ville, Pays</p>
                                                            </div>
                                                        </div>
                                                    </body>';
                                    $mail->setFrom("oyuncoyt@gmail.com", "DRCoffee");
                                    $mail->send();
                                    echo 'Merci de vérifier votre boite mail pour la verifaction du votre compte';
                                }else{
                                    echo "<div>Une erruer s'est prosuite, Veuillez ressayer ):</div>";
                                }
                            }
                        }
                    ?>
            </div>
        </section>
    </main>
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
                    <li><a href="https://www.facebook.com/DRIOUECH.Noureddine" target="_blank"><img
                                src="Images/facebookIcon.png" alt="Facebook"></a></li>
                    <li><a href="https://www.instagram.com/noureddine.driouech/" target="_blank"><img
                                src="Images/instagramIcon.png" alt="Instagram"></a></li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2023 DRCoffee. Tous droits réservés.</p>
        </div>
    </footer>
</body>

</html>