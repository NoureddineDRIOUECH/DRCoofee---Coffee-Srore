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
    <meta name="description"
        content="Découvrez un univers de délices caféinés sur DRCoffee. Notre site vous invite à explorer une gamme exquise de cafés, des grains soigneusement sélectionnés aux machines à capsules de pointe. Plongez dans une expérience de magasinage unique où la passion pour le café rencontre l'innovation. Parcourez notre catalogue pour découvrir des saveurs riches, des accessoires élégants et des machines qui transforment chaque tasse en une célébration de l'art du café." />
    <meta name="author" content="Noureddine DRIOUECH" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="home.css" />
    <link rel="stylesheet" href="utilisateur.css" />
    <link rel="icon" href="Images/logoIcon.png" type="image/png" />
    <link rel="stylesheet" href="about.css" />
    <title>Welcome To DRCoffee</title>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="home.html">
                    <img src="Images/logoIcon.png" alt="DRCoffee" />
                    <h1>DR</h1>
                    <h1 class="c">C</h1>
                    <h1>offee</h1>
                </a>
            </div>
            <ul class="nav-links">
                <li><a href="produit.html">Produits</a></li>
                <li><a href="about.html">À Propos</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li>
                    <a href="connexion-inscription.html">Connexion/Inscription</a>
                </li>
                <li>
                    <a href="utilisateur.html"><img src="Images/UserIcon.png" alt="Profile"
                            style="height: auto; width: 20px" /></a>
                </li>
                <li>
                    <a href="panier.html"><img src="Images/icons-shopping-cart-.png" alt="Panier"
                            style="height: auto; width: 20px" /></a>
                </li>
            </ul>
        </nav>
        <h5>Où chaque gorgée raconte une histoire d'excellence et de passion</h5>
    </header>
    <main>
        <section id="user-profile">
            <div class="profile-container">
                <h2>Mon Profil</h2>

                <!-- Informations du profil utilisateur -->
                <div class="user-info">
                    <h3><?php echo $_SESSION['user']->name; ?></h3>
                    <p>Adresse e-mail: <?php echo $_SESSION['user']->email; ?></p>
                    <p>Rôle: <?php echo $_SESSION['user']->role; ?></p>
                </div>

                <!-- Historique des achats -->
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
                <!-- Modifier les informations du profil -->
                <div class="edit-profile">
                    <h3>Modifier le Profil</h3>

                    <form action="#" method="post">
                        <label for="new-email">Nouvelle Adresse E-mail:</label>
                        <input type="email" id="new-email" name="new-email" required />

                        <label for="new-password">Nouveau Mot de Passe:</label>
                        <input type="password" id="new-password" name="new-password" required />

                        <button type="submit">Enregistrer les Modifications</button>
                    </form>
                </div>

                <div class="logout-btn">
                    <form method="get">
                        <button type="submit" name="logout">Déconnexion</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>Liens Utiles</h3>
                <ul>
                    <li><a href="home.html">Accueil</a></li>
                    <li><a href="produit.html">Produits</a></li>
                    <li><a href="about.html">À Propos</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact</h3>
                <a href="mailto:nourddinedriouech@gmail.com">Email: nourddinedriouech@gmail.com</a>
                <br />
                <br />
                <a href="tel:0660131889">Téléphone: +212 660 131 889</a>
            </div>
            <div class="footer-section">
                <h3>Suivez-nous</h3>
                <ul class="social-icons">
                    <li>
                        <a href="https://www.facebook.com/DRIOUECH.Noureddine" target="_blank"><img
                                src="Images/facebookIcon.png" alt="Facebook" /></a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/noureddine.driouech/" target="_blank"><img
                                src="Images/instagramIcon.png" alt="Instagram" /></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="copyright"></div>
    </footer>
    <script src="home.js"></script>
</body>

</html>