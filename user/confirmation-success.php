<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location:../connexion.php');
} else {

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
        <style>
            main {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .success-container {
                background-color: #fff;
                border: 1px solid #ddd;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                padding: 30px;
                text-align: center;
                max-width: 400px;
            }

            main h2 {
                color: #4caf50;
                /* Green color for success message */
                margin-bottom: 20px;
            }

            main p {
                margin-bottom: 15px;
            }

            main a {
                display: inline-block;
                padding: 10px 20px;
                background-color: #4caf50;
                color: #fff;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s;
            }

            main a:hover {
                background-color: #45a049;
            }
        </style>
        <link rel="icon" href="Images/logoIcon.png" type="image/png" />
        <title>Confirmation avec succes</title>
    </head>

    <body>
        <?php require_once 'nav.html'; ?>

        <main>
            <div class="success-container">
                <h2>Votre commandes est confirmée avec succes!</h2>
                <p>Merci pour l'achat, votre commande serai delivre a ton addresse.</p>

                <p>Vous serez avec les mis a joure du votre commandes.</p>
                <p>Si vous avez des questions <a href="contact.php">Contacter nous</a>.</p>

                <a href="index.php">Achetez d'autre produits</a>
            </div>
        </main>

        <?php require_once 'footer.html'; ?>
    </body>

    </html>

<?php
}
?>