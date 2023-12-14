<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'connectDB.php';

try {
    $getData = $database->prepare("SELECT * FROM produits");
    $getData->execute();
    $getData = $getData->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json'); // Set the content type to JSON
    echo json_encode($getData);
} catch (Exception $e) {
    echo json_encode(array("error" => $e->getMessage()));
}
