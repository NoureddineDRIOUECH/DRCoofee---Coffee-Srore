<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="keywords" content="coffee cupochino machine-coffee" />
  <meta name="description" content="Découvrez un univers de délices caféinés sur DRCoffee. Notre site vous invite à explorer une gamme exquise de cafés, des grains soigneusement sélectionnés aux machines à capsules de pointe. Plongez dans une expérience de magasinage unique où la passion pour le café rencontre l'innovation. Parcourez notre catalogue pour découvrir des saveurs riches, des accessoires élégants et des machines qui transforment chaque tasse en une célébration de l'art du café." />
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
    <section id="cart">
      <div class="cart-container">
        <h2>Mon Panier</h2>
        <div class="cart-item">
          <img src="path/to/product1.jpg" alt="Nom du Produit 1" />
          <div class="item-details">
            <h3>Nom du Produit 1</h3>
            <p class="item-price">$19.99</p>
            <div class="item-actions">
              <button class="remove-item">Retirer</button>
            </div>
          </div>
        </div>
        <div class="cart-item">
          <img src="path/to/product1.jpg" alt="Nom du Produit 1" />
          <div class="item-details">
            <h3>Nom du Produit 1</h3>
            <p class="item-price">$19.99</p>
            <div class="item-actions">
              <button class="remove-item">Retirer</button>
            </div>
          </div>
        </div>
        <div class="cart-item">
          <img src="path/to/product1.jpg" alt="Nom du Produit 1" />
          <div class="item-details">
            <h3>Nom du Produit 1</h3>
            <p class="item-price">$19.99</p>
            <div class="item-actions">
              <button class="remove-item">Retirer</button>
            </div>
          </div>
        </div>
        <div class="cart-total">
          <p>Total du Panier : <span class="total-price">$19.99</span></p>
        </div>

        <button class="checkout-btn">Commander</button>
      </div>
    </section>
  </main>
  <?php
  require_once "footer.html";
  ?>
  <script src="home.js"></script>
</body>

</html>