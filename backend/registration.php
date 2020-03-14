<?php
session_start();

if(empty($_POST) == true) {
    header('Location: ../index.php');
}

require_once '../connection.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Проверка на пустоту полей
if(in_array('', [$name, $email, $password, $confirm_password])) {
    $_SESSION['message'] = 'Не все поля заполнены!';
    header('Location: ../index.php');
}

// Проверка на согласие обработки данных
if(!isset($_POST['consent'])) {
    $_SESSION['message'] = 'Нет согласия на обработку данных';
    header('Location: ../index.php');
}

//^[а-яА-Я- ]{1,20}$ - для имени
//.+@.+\..+ - для email
//^[a-zA-Z0-9]{5,30}$ - для пароля - change

// Проверка на равность паролей
if(!($password === $confirm_password)) {
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
//
//// Проверка на согласие обработки данных
//if(isset($_POST['consent'])) {
//
//    // Проверка на равность паролей
//    if($password === $confirm_password) {
//        // Хешируем пароль
//        $password = password_hash($password, PASSWORD_DEFAULT);
//
//        // Заносим все переменные в массив
//        $arr = ['name' => $name, 'email' => $email, 'password' => $password];
//
//        // Отправляем данные
//        $sql = "INSERT INTO users(name, email, password) VALUES(:name, :email, :password)";
//        $statement = $pdo->prepare($sql);
//        $statement->execute($arr);
//
//        // Получаем данные для занесения в сессию
//        $sqlGetData = "SELECT id_user, name, access FROM users WHERE email = ?";
//        $statementGetData = $pdo->prepare($sqlGetData);
//        $statementGetData->bindValue(1, $email);
//        $statementGetData->execute();
//        $result = $statementGetData->fetch(PDO::FETCH_ASSOC);
//
//        // Заносим в сессию данные о пользователе
//        $_SESSION['user'] = [
//            'id' => $result['id_user'],
//            'name' => $result['name'],
//            'access' => $result['access']
//        ];
//
//        $_SESSION['message'] = 'Успешно зарегестрировались';
//        header('Location: ../index.php');
//    }
//
//    else {
//        $_SESSION['message'] = 'Пароли не совпадают';
//        header('Location: ../index.php');
//    }
//}
//
//else {
//    $_SESSION['message'] = 'Нет согласия на обработку данных';
//    header('Location: ../index.php');
//}