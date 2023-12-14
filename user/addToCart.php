<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));

if (isset($data->idProduit, $data->userID)) {
    require_once '../connectDB.php';

    $productId = $data->idProduit;
    $userId = $data->userID;
    $checkProductQuery = $database->prepare("SELECT * FROM paniers WHERE userID = :userID AND idProduit = :idProduit");
    $checkProductQuery->bindParam(":userID", $userId);
    $checkProductQuery->bindParam(":idProduit", $productId);
    $checkProductQuery->execute();

    if ($checkProductQuery->rowCount() > 0) {
        $updateQuantityQuery = $database->prepare("UPDATE paniers SET quantite = quantite + 1 WHERE userID = :userID AND idProduit = :idProduit");
        $updateQuantityQuery->bindParam(":userID", $userId);
        $updateQuantityQuery->bindParam(":idProduit", $productId);
        $updateQuantityQuery->execute();
    } else {
        $addPanier = $database->prepare("INSERT INTO paniers (userID, idProduit, quantite) VALUES (:userID, :idProduit, 1) ");
        $addPanier->bindParam(":idProduit", $productId);
        $addPanier->bindParam(":userID", $userId);
        $addPanier->execute();
    }

    echo json_encode(['success' => true, 'message' => 'Item added to cart successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
