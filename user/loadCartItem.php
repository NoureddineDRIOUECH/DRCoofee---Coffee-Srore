<?php
session_start();

require_once '../connectDB.php';

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']->id;

    $cartItemsQuery = $database->prepare("SELECT  produits.imageType, produits.image, produits.idProduit, produits.nomProduit, produits.prixProduit, paniers.quantite, paniers.idPanier FROM paniers
        INNER JOIN produits ON paniers.idProduit = produits.idProduit
        WHERE paniers.userID = :userId");
    $cartItemsQuery->bindParam(':userId', $userId, PDO::PARAM_INT);
    $cartItemsQuery->execute();
    $cartItems = $cartItemsQuery->fetchAll(PDO::FETCH_ASSOC);
    $total = 0;
    $items = [];
    $i = 0;
    if (empty($cartItems)) {
        echo '<div style ="display: flex; flex-direction : column; gap : 50px  padding-top : 20px">';
        echo '<img src= "Images/empty cart.svg" style = "width : 400px; margin : auto" />';
        echo '<div class="empty-cart-message" style = "margin: 20px 10px">Votre panier est vide.</div>';
        echo '</div>';
    } else {
        echo '<div class="cart-container">';
        foreach ($cartItems as $item) {
            $items[$i] = ['nomProduit' => $item['nomProduit']];
            $getFile = "data:" . $item['imageType'] . ";base64," . base64_encode($item["image"]);
            echo ' 
                <div class="cart-item" data-product-id="' . $item['idProduit'] . '">
                    <img src="' . $getFile . '" alt="produit dans votre panier" />
                    <div class="item-details">
                        <h3>' . $item['nomProduit'] . '</h3>
                        <p class="item-price">$' . $item['prixProduit'] . '</p>
                        <div class="item-actions">
                            <div class="qute">
                                <button onclick="moins(' . $item['idPanier'] . ' , ' . $item['quantite'] . ')">-</button>
                                <p style="display:inline">' . $item['quantite'] . '</p>
                                <button onclick="plus(' . $item['idPanier'] . ',' . $item['idProduit'] . ',' . $item['quantite'] . ')">+</button>
                            </div>
                            <button class="remove-item" onclick="removeItem(' . $item['idPanier'] . ')">Retirer</button>
                        </div>
                    </div>
                </div>
                <hr>';
            $total += $item['prixProduit'] * $item['quantite'];
            $i++;
        }
        echo '</div>
        </section>';
        echo '<section class="total">
            <p>Total du Panier : <span class="total-price">$' . $total . '</span></p>
            <button class="checkout-btn" onclick="commander(' . $total . ', ' . $userId . ',' . $item['idPanier'] . ')" >Commander</button>
          </section>';
    }
}