<?php
session_start();
require_once '../connectDB.php';

if (!isset($_SESSION['user'])) {
    header('location:connexion.php');
    exit();
}

if (isset($_GET['id'])) {
    $orderID = $_GET['id'];

    // Fetch order details
    $orderQuery = $database->prepare("SELECT * FROM commandes WHERE idCommande = :orderID AND idUser = :userID");
    $orderQuery->bindParam(":orderID", $orderID);
    $orderQuery->bindParam(":userID", $_SESSION['user']->id);
    $orderQuery->execute();
    $order = $orderQuery->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        // Redirect or display an error message
        header('location:utilisateur.php');
        exit();
    }

    // Fetch product details for the order
    $productsQuery = $database->prepare("SELECT produits.nomProduit, produits.prixProduit, commandeDetails.Quantite FROM commandeDetails INNER JOIN produits ON commandeDetails.IDProduit = produits.idProduit WHERE IDCommande = :orderID");
    $productsQuery->bindParam(":orderID", $orderID);
    $productsQuery->execute();
    $products = $productsQuery->fetchAll(PDO::FETCH_ASSOC);

    // Include the HTML and CSS for the invoice
    include 'invoice_template.php';
} else {
    // Redirect or display an error message
    header('location:utilisateur.php');
    exit();
}
