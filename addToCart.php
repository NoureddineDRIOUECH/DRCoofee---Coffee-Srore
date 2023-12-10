<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));
if (isset($data->idProduit)) {
    require_once 'connectDB.php';
    $productId = $data->idProduit;
    $addPanier = $database->prepare("INSERT INTO paniers (userID, idProduit, quantite) VALUES (1, :idProduit, 1) ");
    $addPanier->bindParam(":idProduit", $productId);
    if ($addPanier->execute()) {
        print_r(json_encode(['success' => true, 'message' => 'Item added to cart successfully']));
    } else {
        print_r(json_encode(['success' => false, 'message' => 'Error adding item to cart: ' . $addPanier->errorInfo()]));
    }
} else {
    print_r(json_encode(['success' => false, 'message' => 'Invalid request']));
}
