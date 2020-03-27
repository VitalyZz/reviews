<?php
// Проверка на пустоту полей
function checkEmptyFields($arr, $message = "Не все поля заполнены") {
    if (in_array('', $arr)) {
        header('HTTP/1.0 403 Error!');
        die (json_encode($message));
    }
}

// Проверка поля регулярным выражением
function checkField($pattern, $data, $message) {
    if (preg_match($pattern, $data) == false) {
        header('HTTP/1.0 403 Error!');
        die (json_encode($message));
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
function formatText($element) {
    return htmlspecialchars($element);
}