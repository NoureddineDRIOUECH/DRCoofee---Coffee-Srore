<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));
if (isset($data->idProduit)) {
    require_once '../connectDB.php';
    $productId = $data->idProduit;
    $userId = $data->userID;
    $addPanier = $database->prepare("INSERT INTO paniers (userID, idProduit, quantite) VALUES (:userID, :idProduit, 1) ");
    $addPanier->bindParam(":idProduit", $productId);
    $addPanier->bindParam(":userID", $userId);
    if ($addPanier->execute()) {
        echo json_encode(['success' => true, 'message' => 'Item added to cart successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error adding item to cart: ' . $addPanier->errorInfo()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
