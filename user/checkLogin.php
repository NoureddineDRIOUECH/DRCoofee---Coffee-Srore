<?php

session_start();
$isLoggedIn = isset($_SESSION["user"]);
$userId = isset($_SESSION["user"]) ? $_SESSION["user"]->id : null;
header('Content-Type: application/json');
echo json_encode(['isLoggedIn' => $isLoggedIn, 'userID' => $userId]);
