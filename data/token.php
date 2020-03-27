<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!password_verify($_SESSION['token'], $_POST['_token'])) {
        die('ERROR!!!');
    }
}

if(!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
}
$_SESSION['_token'] = password_hash($_SESSION['token'], PASSWORD_DEFAULT);