<?php
require_once '../connectDB.php';
$productsQuery = $database->prepare("SELECT * FROM produits");
$productsQuery->execute();
$products = $productsQuery->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="produit.css" />
    <link rel="icon" href="Images/logoIcon.png" type="image/png" />
    <title>DRCoffee</title>
</head>

<body>
    <?php
    require_once "nav.html";
    ?>
    <main>
        <section id="product">
            <?php foreach ($products as $product) : ?>
                <div class="products-container">
                    <div class="container-product">
                        <div class="images">
                            <img src="Images/suchard-intense.jpg" />
                            <p class="stock">Quantité : <?php echo $product['stock']; ?></p>
                            <button class="add">Ajouter au Panier</button>
                        </div>

                        <div class="product">
                            <p><?php echo $product['categoriesProduis']; ?></p>
                            <h2><?php echo $product['nomProduit']; ?></h2>
                            <h3><?php echo $product['prixProduit']; ?> MAD</h3>
                            <p class="desc">
                                <?php echo $product['description']; ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>

                </div>
        </section>
    </main>
    <?php
    require_once "footer.html";
    ?>
    <script src="home.js"></script>
</body>

</html>