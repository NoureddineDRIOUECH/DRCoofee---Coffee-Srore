<?php
session_start();

require_once '../connectDB.php';

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']->id;

    $cartItemsQuery = $database->prepare("SELECT  produits.imageType, produits.image, produits.idProduit, produits.nomProduit, produits.prixProduit, paniers.quantite FROM paniers
        INNER JOIN produits ON paniers.idProduit = produits.idProduit
        WHERE paniers.userID = :userId");
    $cartItemsQuery->bindParam(':userId', $userId, PDO::PARAM_INT);
    $cartItemsQuery->execute();
    $cartItems = $cartItemsQuery->fetchAll(PDO::FETCH_ASSOC);
    $total = 0;
    foreach ($cartItems as $item) {
        $getFile = "data:" . $item['imageType'] . ";base64," . base64_encode($item["image"]);
        echo ' 
                <div class="cart-item" data-product-id="' . $item['idProduit'] . '">
                    <img src="' . $getFile . '" alt="produit dans votre panier" />
                    <div class="item-details">
                        <h3>' . $item['nomProduit'] . '</h3>
                        <p class="item-price">$' . $item['prixProduit'] . '</p>
                        <div class="item-actions">
                            <div class="qute">
                                <button>-</button>
                                <p style="display:inline">' . $item['quantite'] . '</p>
                                <button>+</button>
                            </div>
                            <button class="remove-item" onclick="removeItem(' . $item['idProduit'] . ')">Retirer</button>
                        </div>
                    </div>
                </div>
                <hr>';
        $total += $item['prixProduit'] * $item['quantite'];
    }
    echo '</div>
        </section>';
    echo '<section class="total">
            <p>Total du Panier : <span class="total-price">$' . $total . '</span></p>
            <button class="checkout-btn">Commander</button>
          </section>';
}
