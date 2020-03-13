<?php
session_start();

// Проверка на существование сессии
if(isset($_SESSION['user'])) {
    header('Location: ../index.php');
}

require_once '../connection.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT id_user, name, access, password FROM users WHERE email = ?";
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $email);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);

if(password_verify($password, $result['password'])) {
    // Заносим в сессию данные о пользователе
    $_SESSION['user'] = [
        'id' => $result['id_user'],
        'name' => $result['name'],
        'access' => $result['access']
    ];

    $_SESSION['message'] = 'Вы авторизовались';
    header('Location: ../index.php');
}