<?php
session_start();

require_once '../connection.php';
require_once 'functions.php';

if (empty($_POST)) {
    switchingPage();
}

$name = $_POST['name'];
$text = $_POST['text'];
$trailer = $_POST['trailer'];
$idUser = $_SESSION['user']['id'];

$namePoster = $_FILES['poster']['name'];
$tmpNamePoster = $_FILES['poster']['tmp_name'];

$patternName = '/[a-zа-я]+/iu';
$patternText = '/[a-zа-я]+/iu';
$patternTrailer = '/\?v=/i';

$messageFields = "Не все поля заполнены.\n Обязательные поля: название, текст и постер!";
$messageName = "Не верно введено поле name!\n Поле должно иметь хотя бы одну букву!";
$messageText = "Не верно введено поле text!\n Поле должно иметь хотя бы одну букву!";
$messageTrailer = "Не верно введено поле trailer!\n Ссылка на трейлер должна быть корректна";

// Проверка на пустоту полей
checkEmptyFields([$name, $text, $namePoster], 'poster', $messageFields, "Location: ../create.php");

// Проверка поля name
checkField($patternName, $name, 'poster', $messageName, 'Location: ../create.php');

// Проверка поля text
checkField($patternText, $text, 'poster', $messageText, 'Location: ../create.php');

// Проверка поля trailer
checkField($patternTrailer, $trailer, 'poster', $messageTrailer, 'Location: ../create.php');

// Проверка на формат файла
if (exif_imagetype($_FILES['poster']['tmp_name']) == false) {
    $_SESSION['message']['poster'] = 'Постер должен быть картинкой!';
    switchingPage('Location: ../create.php');
}

// Удаляем лишнее из ссылки на трейлер
$regexp = "/.+\?v=/";
$trailer = preg_replace($regexp, '', $trailer);

if (strpos($trailer, "&")) {
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

$sql = "INSERT INTO reviews(id_user, film_title, poster, trailer, text_review) 
VALUES(:id_user, :film_title, :poster, :trailer, :text_review)";
$statement = $pdo->prepare($sql);
$statement->execute($arr);
switchingPage('Location: ../index.php');
