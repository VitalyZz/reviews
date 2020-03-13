<?php
session_start();

// Проверка на существование сессии
if(isset($_SESSION['user'])) {
    header('Location: ../index.php');
}

require_once '../connection.php';

// Проверка на согласие обработки данных
if(isset($_POST['consent'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Проверка на равность паролей
    if($password === $confirm_password) {
        // Хешируем пароль
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Заносим все переменные в массив
        $arr = ['name' => $name, 'email' => $email, 'password' => $password];

        // Отправляем данные
        $sql = "INSERT INTO users(name, email, password) VALUES(:name, :email, :password)";
        $statement = $pdo->prepare($sql);
        $statement->execute($arr);

        // Получаем данные для занесения в сессию
        $sqlGetData = "SELECT id_user, name, access FROM users WHERE email = ?";
        $statementGetData = $pdo->prepare($sqlGetData);
        $statementGetData->bindValue(1, $email);
        $statementGetData->execute();
        $result = $statementGetData->fetch(PDO::FETCH_ASSOC);

        // Заносим в сессию данные о пользователе
        $_SESSION['user'] = [
            'id' => $result['id_user'],
            'name' => $result['name'],
            'access' => $result['access']
        ];

        $_SESSION['message'] = 'Успешно зарегестрировались';
        header('Location: ../index.php');
    }

    else {
        $_SESSION['message'] = 'Пароли не совпадают';
        header('Location: ../index.php');
    }
}

else {
    $_SESSION['message'] = 'Нет подверждения';
    header('Location: ../index.php');
}