<?php
session_start();
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']->role === 'user') {
        require_once "home.php";
    } else {
        header("location:http://localhost/DRCoffee/inscription.php", true);
        die("");
    }
} else {
    header("location:http://localhost/DRCoffee/inscription.php", true);
    die("");
}
