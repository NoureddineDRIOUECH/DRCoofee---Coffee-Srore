<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));



if (isset($data->idPanier) && isset($data->moins)) {
    require_once '../connectDB.php';
    $idPanier = $data->idPanier;
    $removeItem = $database->prepare("UPDATE paniers SET quantite = quantite - 1 WHERE idPanier = :idPanier ");
    $removeItem->bindParam(":idPanier", $idPanier);
    if ($removeItem->execute()) {
        print_r(json_encode(['success' => true, 'message' => 'Item decrement from cart successfully']));
    } else {
        print_r(json_encode(['success' => false, 'message' => 'Error removing item from cart: ' . $removeItem->errorInfo()]));
    }
} elseif (isset($data->idPanier) && isset($data->idProduit)) {
    require_once '../connectDB.php';
    $stock = $database->prepare("SELECT stock FROM produits where idProduit = :idProduit");
    $idProduit = $data->idProduit;
    $stock->bindParam(":idProduit", $idProduit);
    $stock->execute();
    $stockNumber = $stock->fetch(PDO::FETCH_ASSOC);
    if ($stockNumber["stock"] > $data->quantite) {
        $idPanier = $data->idPanier;
        $removeItem = $database->prepare("UPDATE paniers SET quantite = quantite + 1 WHERE idPanier = :idPanier ");
        $removeItem->bindParam(":idPanier", $idPanier);
        if ($removeItem->execute()) {
            print_r(json_encode(['success' => true, 'message' => 'Item increment from cart successfully']));
        } else {
            print_r(json_encode(['success' => false, 'message' => 'Error adding quantite "out of stock": ' . $removeItem->errorInfo()]));
        }
    } else {
        print_r(json_encode(['success' => false, 'message' => 'Error incrementing  item from cart: ' . $removeItem->errorInfo()]));
    }
} elseif (isset($data->idPanier)) {
    require_once '../connectDB.php';
    $idPanier = $data->idPanier;
    $removeItem = $database->prepare("DELETE FROM paniers WHERE idPanier = :idPanier ");
    $removeItem->bindParam(":idPanier", $idPanier);
    if ($removeItem->execute()) {
        print_r(json_encode(['success' => true, 'message' => 'Item removed from cart successfully']));
    } else {
        print_r(json_encode(['success' => false, 'message' => 'Error removing item from cart: ' . $removeItem->errorInfo()]));
    }
}
