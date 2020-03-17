<?php
session_start();

$driver = 'pgsql';
$host = 'localhost';
$db_name = 'reviews';
$db_user = 'postgres';
$db_password = 'pass';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

$dsn = "$driver:host=$host;dbname=$db_name";

$pdo = new PDO($dsn, $db_user, $db_password, $options);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!password_verify($_SESSION['token'], $_POST['_token'])) {
        die('ERROR!');
    }
}

if(!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
}
$_SESSION['_token'] = password_hash($_SESSION['token'], PASSWORD_DEFAULT);