<?php
$driver = 'pgsql';
$host = 'localhost';
$db_name = 'reviews';
$db_user = 'postgres';
$db_password = 'pass';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

$dsn = "$driver:host=$host;dbname=$db_name";

$pdo = new PDO($dsn, $db_user, $db_password, $options);