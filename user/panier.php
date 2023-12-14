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
    <meta name="description"
        content="Découvrez un univers de délices caféinés sur DRCoffee. Notre site vous invite à explorer une gamme exquise de cafés, des grains soigneusement sélectionnés aux machines à capsules de pointe. Plongez dans une expérience de magasinage unique où la passion pour le café rencontre l'innovation. Parcourez notre catalogue pour découvrir des saveurs riches, des accessoires élégants et des machines qui transforment chaque tasse en une célébration de l'art du café." />
    <meta name="author" content="Noureddine DRIOUECH" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="home.css" />
    <link rel="stylesheet" href="panier.css" />
    <link rel="icon" href="Images/logoIcon.png" type="image/png" />
    <title>DRCoffee</title>
</head>

<body>
    <?php
        require_once "nav.html";
        ?>
    <main>
        <h2>Mon Panier</h2>
        <section id="cart">


            <?php include "loadCartItem.php"; ?>


            <div id="toastS"></div>
            <div id="toastF"></div>
    </main>
    <?php
        require_once "footer.html";
        ?>
    <script src="home.js"></script>
    <script src="panier.js"></script>
</body>

</html>
<?php
}
?>