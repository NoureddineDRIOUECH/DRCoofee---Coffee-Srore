<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location:../connexion.php');
} else {

?>
    <?php
    if (isset($_GET['search'])) {
        require_once '../connectDB.php';
        $search = $database->prepare("SELECT * FROM produits WHERE nomProduit LIKE :value");
        $searchValue = "%" . $_GET['value'] . "%";
        $search->bindParam(":value", $searchValue, PDO::PARAM_STR);
        $search->execute();
        $searchProduct = $search->fetchAll(PDO::FETCH_ASSOC);
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
        <link rel="icon" href="Images/logoIcon.png" type="image/png" />
        <link rel="stylesheet" href="cherch_result.css">
        <title>DRCoffee</title>
    </head>

    <body>
        <?php
        require_once "nav.html";
        ?>

        <section id="product">
            <div class="products-container">

                <?php foreach ($searchProduct as $product) : ?>
                    <?php $getFile = "data:" . $product['imageType'] . ";base64," . base64_encode($product["image"]); ?>

                    <div class="container-product">
                        <div class="images">
                            <img src="<?php echo $getFile; ?> " alt="Image Produits" />
                            <p class="stock">Quantité : <?php echo $product['stock']; ?></p>
                            <button class="add">Ajouter au Panier</button>
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
            <?php
            if (empty($searchProduct)) {
                echo '<p class="error-message">Aucune résultats trouvé pour le term : ' . $_GET["value"] . '.</p>';
                echo '<p class="error-message">Veuillez réessayer avec d\'autres termes de recherche… .</p>';
            }
            ?>
        </section>
        <?php
        require_once "footer.html";
        ?>
        <script src="home.js"></script>
    </body>

    </html>
<?php
}
?>