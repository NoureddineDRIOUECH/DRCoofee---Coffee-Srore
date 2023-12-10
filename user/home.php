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
    <title>DRCoffee</title>
</head>

<body>
    <?php
    require_once "nav.html";
    ?>
    <main>
        <section id="featured-products">
            <div class="product-container">
                <h2>Produits Recommandés</h2>

                <!-- Exemple de produit -->
                <div class="product">
                    <img src="path/to/product1.jpg" alt="Nom du Produit 1" />
                    <h3>Nom du Produit 1</h3>
                    <p>Description courte du produit. Lorem ipsum dolor sit amet.</p>
                    <p class="product-price">$19.99</p>
                    <button class="add-to-cart">Ajouter au Panier</button>
                </div>

                <!-- Ajoutez d'autres produits recommandés ici -->
            </div>
        </section>

        <section id="special-offers">
            <div class="offer-container">
                <h2>Offres Spéciales</h2>

                <!-- Exemple d'offre spéciale -->
                <div class="offer">
                    <img src="path/to/offer1.jpg" alt="Offre Spéciale 1" />
                    <p class="offer-description">
                        Profitez de notre offre spéciale de la semaine !
                    </p>
                </div>

                <!-- Ajoutez d'autres offres spéciales ici -->
            </div>
        </section>
    </main>
    <?php
    require_once "footer.html";
    ?>
    <script src="home.js"></script>
</body>

</html>