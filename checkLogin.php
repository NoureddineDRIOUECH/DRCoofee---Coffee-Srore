<?php
$isLoggedIn = isset($_SESSION["user"]);
header('Content-Type: application/json');
echo json_encode(['isLoggedIn' => $isLoggedIn]);
