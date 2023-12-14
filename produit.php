<?php
require_once 'connectDB.php';
$categoriesQuery = $database->prepare("SELECT DISTINCT categoriesProduis FROM produits");
$categoriesQuery->execute();
$categories = $categoriesQuery->fetchAll(PDO::FETCH_COLUMN);
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
    <link rel="stylesheet" href="produit.css" />
    <link rel="icon" href="Images/logoIcon.png" type="image/png" />
    <title>DRCoffee</title>
</head>

<body>
    <?php
    require_once "nav.php";
    ?>
    <main>
        <?php foreach ($categories as $category) : ?>
        <section id="product">
            <h2><?php echo $category; ?></h2>
            <?php
                $productsQuery = $database->prepare("SELECT * FROM produits WHERE categoriesProduis = :category");
                $productsQuery->bindParam(':category', $category, PDO::PARAM_STR);
                $productsQuery->execute();
                $categoryProducts = $productsQuery->fetchAll(PDO::FETCH_ASSOC);
                ?>
            <div class="products-container">
                <?php foreach ($categoryProducts as $product) : ?>
                <?php $getFile = "data:" . $product['imageType'] . ";base64," . base64_encode($product["image"]); ?>

                <div class="container-product">
                    <div class="images">
                        <img src="<?php echo $getFile; ?> " alt="Image Produits" />
                        <p class="stock">Quantité : <?php echo $product['stock']; ?></p>
                        <button type="submit" class="add-to-cart" name="add"
                            data-product-id="<?php echo $product['idProduit']; ?>">Ajouter au
                            Panier</button>
                    </div>
                    <div class="product">
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
        <?php endforeach; ?>
    </main>
    <?php
    require_once "footer.html";
    ?>
    <script src="produit.js"></script>
</body>

</html>