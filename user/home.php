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
    <link rel="icon" href="Images/logoIcon.png" type="image/png" />
    <title>DRCoffee</title>
</head>

<body>
    <?php
        require_once "nav.html";
        ?>
    <main class="home">
        <div class='bg'>
            <div class="p">
                <div class="c">
                    <h2>Un bon </h2>
                    <h2 style="color: #FF7E12;">café</h2>
                    <h2> fait </h2>
                </div>
                <div>
                    <h2>une <h2>
                            <h2 style="color: #FF7E12;">belle</h2>
                            <h2> journée</h2>
                </div>
                <p>le café est une boisson préparée à partir de grains de café torréfiés, qui sont les graines de la
                    plante</p>
            </div>
            <button class="shop-now-button" onclick="window.location.href='produit.php'">Acheter Maintenant</button>

            <h2 class="action">Acheter du café en ligne au meilleur prix du web</h2>
        </div>

        <section id="featured-products">
            <div class="product-container">
                <h2 style="margin:20px">Produits Recommandés</h2>
                <?php
                    require_once '../connectDB.php';
                    $productsQuery = $database->prepare("SELECT * FROM produits ORDER BY idProduit DESC LIMIT 3");
                    $productsQuery->execute();
                    $lastThreeProducts = $productsQuery->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                <div class="homeproducts-container">
                    <?php foreach ($lastThreeProducts as $product) : ?>
                    <?php $getFile = "data:" . $product['imageType'] . ";base64," . base64_encode($product["image"]); ?>

                    <div class="homecontainer-product">
                        <div class="images">
                            <img src="<?php echo $getFile; ?> " alt="Image Produits" />
                            <p class="stock">Quantité : <?php echo $product['stock']; ?></p>
                        </div>
                        <div class="homeproduct">
                            <h2><?php echo $product['nomProduit']; ?></h2>
                            <h3><?php echo $product['prixProduit']; ?> MAD</h3>
                            <p class="desc">
                                <?php echo $product['description']; ?>
                            </p>
                            <button type="submit" class="add-to-cart" name="add"
                                data-product-id="<?php echo $product['idProduit']; ?>">Ajouter au Panier</button>

                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <div class="homeContainer">
            <img src="Images/about.png" style="max-width : 100%;" alt="about">
            <img src="Images/nos services.png" style="max-width : 100%;" alt="ourServercis">
            <img src="Images/infos.png" style="max-width : 100%;" alt="infos">
            <img src="Images/nos marques.png" alt="nos marques" style="max-width : 100%;" />
            <img src="Images/laivraison.png" style="max-width : 100%; margin-left : 90px" alt="livraison">
        </div>
    </main>
    <?php
        require_once "footer.html";
        ?>
    <script src="produit.js"></script>
</body>

</html>
<?php
}
?>