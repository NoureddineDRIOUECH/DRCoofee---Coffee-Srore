<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));
if (isset($data->idProduit)) {
    require_once '../connectDB.php';
    $productId = $data->idProduit;
    $deleteProduct = $database->prepare("DELETE FROM produits WHERE idProduit = :idProduit ");
    $deleteProduct->bindParam(":idProduit", $productId);
    if ($deleteProduct->execute()) {
        echo json_encode(['success' => true, 'message' => 'Product removed  successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error removing product: ' . $addPanier->errorInfo()]);
    }
} elseif (isset($data->idUser)) {
    require_once '../connectDB.php';
    $idUser = $data->idUser;
    $deleteUser = $database->prepare("DELETE FROM users WHERE id = :idUser ");
    $deleteUser->bindParam(":idUser", $idUser);
    if ($deleteUser->execute()) {
        echo json_encode(['success' => true, 'message' => 'Product removed  successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error removing product: ' . $addPanier->errorInfo()]);
    }
}
