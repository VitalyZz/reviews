<?php
session_start();

require_once '../data/connection.php';
require_once '../data/functions.php';

if (empty($_POST) && !isset($_SESSION['user']['id'])) {
    switchingPage();
}

$email = $_POST['email'];
$password = $_POST['password'];

$_SESSION['data'] = [
    'email' => $email,
    'password' => $password
];

// Проверка на пустоту полей
checkEmptyFields([$email, $password], 'auth');

$sql = "SELECT id_user, name, access, password FROM users WHERE email = ?";
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $email);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);
$count = $statement->rowCount();

if ($count == 0) {
    $_SESSION['message']['auth'] = 'Неправильный логин!';
    switchingPage();
}

if (password_verify($password, $result['password'])) {
    // Заносим в сессию данные о пользователе
    $_SESSION['user'] = [
        'id' => $result['id_user'],
        'name' => $result['name'],
        'access' => $result['access']
    ];

    $_SESSION['message']['success'] = 'Вы авторизовались!';
    switchingPage();
} else {
    $_SESSION['message']['auth'] = 'Неправильный пароль!';
    switchingPage();
}