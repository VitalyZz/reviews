<?php
require_once '../data/connectionFiles.php';

header('Content-type: application/json; charset=utf-8');

if (empty($_POST) && isset($_SESSION['user']['id'])) {
    switchingPage();
}

$email = $_POST['email'];
$password = $_POST['password'];

// Проверка на пустоту полей
checkEmptyFields([$email, $password]);

$sql = "SELECT id_user, name, access, password FROM users WHERE email = ?";
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $email);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);
$count = $statement->rowCount();

if ($count == 0) {
    header('HTTP/1.0 403 Error!');
    die (json_encode("Неправильный логин!"));
}

if (password_verify($password, $result['password'])) {
    // Заносим в сессию данные о пользователе
    $_SESSION['user'] = [
        'id' => $result['id_user'],
        'name' => $result['name'],
        'access' => $result['access']
    ];

    die (json_encode([
        "message" => "Вы авторизовались!",
        "url" => $_SERVER['HTTP_REFERER']
    ]));
} else {
    header('HTTP/1.0 403 Error!');
    die (json_encode("Неправильный пароль!"));
}