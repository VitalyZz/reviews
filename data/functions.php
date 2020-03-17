<?php
// Проверка на пустоту полей
function checkEmptyFields($arr, $sessionSecond, $message = "Не все поля заполнены", $page = 1) {
    if (in_array('', $arr)) {
        $_SESSION['message'][$sessionSecond] = $message;
        switchingPage($page);
    }
}

// Проверка поля регулярным выражением
function checkField($pattern, $data, $sessionSecond, $message, $page = 1) {
    if (preg_match($pattern, $data) == false) {
        $_SESSION['message'][$sessionSecond] = $message;
        switchingPage($page);
    }
}

// Редирект на другую страницу
function switchingPage($page = 1) {
    if ($page != 1) {
        header($page);
    } else {
        if (isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            header("Location: ../index.php");
        }
    }
    exit();
}

// Преобразование специальных символов в html сущности
function HSC($element) {
    return htmlspecialchars($element);
}