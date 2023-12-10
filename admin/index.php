<?php
session_start();
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("location:http://localhost/DRCoffee/inscription.php", true);
}
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']->role === 'admin') {
        echo "hello admin " . $_SESSION['user']->name . " :)";
        require_once 'html.html';
        echo "<div class=\"logout-btn\">
        <form method=\"get\">
            <button type=\"submit\" name=\"logout\">Déconnexion</button>
        </form>
    </div>";
    } else {
        header("location:http://localhost/DRCoffee/inscription.php", true);
        die("");
    }
} else {
    header("location:http://localhost/DRCoffee/inscription.php", true);
    die("");
}
