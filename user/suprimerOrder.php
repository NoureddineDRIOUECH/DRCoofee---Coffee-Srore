<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));

if (isset($data->idCommande)) {
    require_once '../connectDB.php';

    $idCommande = $data->idCommande;
    $supprimeOrderD = $database->prepare("DELETE FROM commandeDetails WHERE idCommande = :idCommande");
    $supprimeOrderD->bindParam(":idCommande", $idCommande);
    $supprimeOrderD->execute();
    $supprimeOrder = $database->prepare("DELETE FROM commandes WHERE idCommande = :idCommande");
    $supprimeOrder->bindParam(":idCommande", $idCommande);
    $supprimeOrder->execute();

    echo json_encode(['success' => true, 'message' => 'Item deleted successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}