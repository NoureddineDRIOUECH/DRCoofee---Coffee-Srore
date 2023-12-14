<?php
session_start();
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']->role === 'admin') {
        require_once 'adminPanel.php';
        echo ' <script src="admin.js"></script>';
    } else {
        header("location:http://localhost/DRCoffee/inscription.php", true);
        die("");
    }
} else {
    header("location:http://localhost/DRCoffee/inscription.php", true);
    die("");
}
