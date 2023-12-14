<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));

if (isset($data->total) && isset($data->userId) && isset($data->idPanier)) {
    require_once '../connectDB.php';
    $total = $data->total;
    $userId = $data->userId;
    $idPanier = $data->idPanier;
    try {
        $commander = $database->prepare("INSERT INTO commandes(idUser,total,etat,date, verificationCode) VALUES (:idUser , :total , 'En attente la confiramtion', NOW() ,'1')");
        $commander->bindParam(":idUser", $userId);
        $commander->bindParam(":total", $total);
        $cmd = $commander->execute();

        $commandeId = $database->lastInsertId();

        $cartItemsQuery = $database->prepare("SELECT idProduit, quantite FROM paniers WHERE userID = :userId");
        $cartItemsQuery->bindParam(':userId', $userId, PDO::PARAM_INT);
        $cartItemsQuery->execute();
        $cartItems = $cartItemsQuery->fetchAll(PDO::FETCH_ASSOC);



        $insertOrderDetails = $database->prepare("INSERT INTO commandeDetails(IDCommande, IDProduit, Quantite) VALUES (:idCommande, :idProduit, :quantite)");


        foreach ($cartItems as $item) {
            $insertOrderDetails->bindParam(":idCommande", $commandeId);
            $insertOrderDetails->bindParam(":idProduit", $item['idProduit']);
            $insertOrderDetails->bindParam(":quantite", $item['quantite']);
            $insertOrderDetails->execute();
        }




        $removeItems = $database->prepare("DELETE FROM paniers WHERE userID = :idUser");
        $removeItems->bindParam(":idUser", $userId);
        if ($cmd && $removeItems->execute()) {
            print_r(json_encode(['success' => true, 'message' => 'Order placed successfully']));
        } else {
            throw new Exception('Error placing order.');
        }
    } catch (Exception $e) {
        error_log($e->getMessage(), 0);
        print_r(json_encode(['success' => false, 'message' => 'An error occurred while placing the order. Please try again.']));
    }
}
