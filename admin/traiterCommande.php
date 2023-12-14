<?php
if (isset($_GET['orderId'])) {
    require_once '../connectDB.php';
    $orderId = $_GET['orderId'];
    $updateStatus = $database->prepare("UPDATE commandes SET etat = 'Livrée' WHERE idCommande = :orderId");
    $updateStatus->bindParam(':orderId', $orderId);

    if ($updateStatus->execute()) {
        echo 'Order status updated successfully';
    } else {
        echo 'Failed to update order status';
    }
} else {
    echo 'Invalid request';
}
