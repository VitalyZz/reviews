<?php
session_start();

if(empty($_POST) == true) {
    header('Location: ../index.php');
}

require_once '../connection.php';

$name = $_POST['name'];
$text = $_POST['text'];
$trailer = $_POST['trailer'];
$idUser = $_SESSION['user']['id'];

$namePoster = $_FILES['poster']['name'];
$tmpNamePoster = $_FILES['poster']['tmp_name'];

// Удаляем лишнее из ссылки на трейлер

$regexp = "/.+\?v=/";
$trailer = preg_replace($regexp, '', $trailer);

if(strpos($trailer, "&")) {
    $regexp = "/\&.+$/";
    $trailer = preg_replace($regexp, '', $trailer);
}

// Генерируем рандомное название для постера с проверкой на существование
do {
    $path = "../uploads/" . substr(md5(microtime() . rand(0, 1000)), 0, 15) . $namePoster;
} while (file_exists($path));

move_uploaded_file($tmpNamePoster, $path);

$path = substr($path, 3);

$arr = [
    'id_user' => $idUser,
    'film_title' => $name,
    'poster' => $path,
    'trailer' => $trailer,
    'text_review' => $text
];

$sql = "INSERT INTO reviews(id_user, film_title, poster, trailer, text_review) VALUES(:id_user, :film_title, :poster, :trailer, :text_review)";
$statement = $pdo->prepare($sql);
$statement->execute($arr);

header('Location: ../index.php');
