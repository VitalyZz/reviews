<?php
session_start();

require_once '../data/connection.php';
require_once '../data/functions.php';

if (empty($_POST) && isset($_SESSION['user']['id'])) {
    switchingPage();
}

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

$_SESSION['data'] = [
    'name' => $name,
    'email' => $email,
    'password' =>$password,
    'confirm_password' => $confirm_password,
    'consent' => $_POST['consent']
];

$patternName = '/^[а-я\-\s]+$/iu';
$patternEmail = '/^.+@.+\..+$/i';
$patternPassword = '/^(?=\w{6})\d*[a-z][a-z\d]*$/i';

$messageName = "Не верно введено поле name!\n Должны быть использованы только русские буквы, пробелы и дефисы.";
$messageEmail = "Не верно введено поле email!\n Поле должно содержать только корректный email.";
$messagePassword = "Не верно введено поле password!\n Поле должно содержать минимум 6 символов";

// Проверка на пустоту полей
checkEmptyFields([$name, $email, $password, $confirm_password], 'reg');

// Проверка поля name
checkField($patternName, $name, 'reg', $messageName);

// Проверка поля email
checkField($patternEmail, $email, 'reg', $messageEmail);

// Проверка поля password
checkField($patternPassword, $password, 'reg', $messagePassword);

// Проверка на равность паролей
if (!($password === $confirm_password)) {
    $_SESSION['message']['reg'] = 'Пароли не совпадают';
    switchingPage();
}

// Проверка на существующий аккаунт
$sqlCheckEmail = "SELECT email FROM users WHERE email = ?";
$statementEmail = $pdo->prepare($sqlCheckEmail);
$statementEmail->bindValue(1, $email);
$statementEmail->execute();
$count = $statementEmail->rowCount();

if ($count == 1) {
    $_SESSION['message']['reg'] = 'Аккаунт с таким email уже существует!';
    switchingPage();
}

// Проверка согласия на обработку данных
if (isset($_POST['consent'])) {
    // Хешируем пароль
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Заносим все переменные в массив
    $arr = [
        'name' => $name,
        'email' => $email,
        'password' => $password
    ];

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

    $_SESSION['message']['success'] = 'Успешно зарегистрировались!';
    switchingPage();
}

else {
    $_SESSION['message']['reg'] = 'Нет согласия на обработку данных';
    switchingPage();
}