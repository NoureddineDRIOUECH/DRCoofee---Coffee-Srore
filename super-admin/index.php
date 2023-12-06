<?php
session_start();
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']->role === 'super-admin') {
        echo "hello boss " . $_SESSION['user']->name . " :)";
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
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("location:http://localhost/DRCoffee/inscription.php", true);
}
