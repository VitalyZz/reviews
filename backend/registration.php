<?php
require_once '../data/connectionFiles.php';

header('Content-type: application/json; charset=utf-8');

if (empty($_POST) && isset($_SESSION['user']['id'])) {
    switchingPage();
}

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

$patternName = '/^[а-я\-\s]+$/iu';
$patternEmail = '/^.+@.+\..+$/i';
$patternPassword = '/^(?=\w{6})\d*[a-z][a-z\d]*$/i';

$messageName = "Не верно введено поле name!\n Должны быть использованы только русские буквы, пробелы и дефисы.";
$messageEmail = "Не верно введено поле email!\n Поле должно содержать только корректный email.";
$messagePassword = "Не верно введено поле password!\n Поле должно содержать минимум 6 символов";

// Проверка на пустоту полей
checkEmptyFields([$name, $email, $password, $confirm_password]);

// Проверка поля name
checkField($patternName, $name, $messageName);

// Проверка поля email
checkField($patternEmail, $email, $messageEmail);

// Проверка поля password
checkField($patternPassword, $password, $messagePassword);

// Проверка на равность паролей
if (!($password === $confirm_password)) {
    header('HTTP/1.0 403 Error!');
    die (json_encode('Пароли не совпадают!'));
}

// Проверка на существующий аккаунт
$sqlCheckEmail = "SELECT email FROM users WHERE email = ?";
$statementEmail = $pdo->prepare($sqlCheckEmail);
$statementEmail->bindValue(1, $email);
$statementEmail->execute();
$count = $statementEmail->rowCount();

if ($count == 1) {
    header('HTTP/1.0 403 Error!');
    die (json_encode('Аккаунт с таким email уже существует!'));
}

// Проверка согласия на обработку данных
if ($_POST['consent'] === 'Yes') {
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

    die (json_encode([
        "message" => "Успешно зарегистрировались!",
        "url" => $_SERVER['HTTP_REFERER']
    ]));
} else {
    header('HTTP/1.0 403 Error!');
    die (json_encode('Нет согласия на обработку данных!'));
}