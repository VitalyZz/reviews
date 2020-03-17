<?php
session_start();

require_once '../data/connection.php';
require_once '../data/functions.php';

if (empty($_POST) && !isset($_SESSION['user']['id'])) {
    switchingPage();
}

$id_user = $_SESSION['user']['id'];
$id_review = $_POST['id_review'];
$comment_text = $_POST['text'];

$_SESSION['data'] = [
    'text' => $comment_text
];

$patternCommentText = '/[a-zа-я]+/iu';

$messageCommentText = "Поле должно иметь хотя бы одну букву!";

$page = "Location: ../review.php?id_review=$id_review#anchorComment";

// Проверка на пустоту полей
if ($comment_text == '') {
    $_SESSION['message']['comment'] = "ОШИБКА! Поле пустое!";
    switchingPage($page);
}

// Проверка поля text
checkField($patternCommentText, $comment_text, 'comment', $messageCommentText, $page);

$arr = [
    'id_user' => $id_user,
    'id_review' => $id_review,
    'comment_text' => $comment_text
];

$sql = "INSERT INTO comments(id_user, id_review, comment_text) VALUES(:id_user, :id_review, :comment_text)";
$statement = $pdo->prepare($sql);
$statement->execute($arr);
switchingPage($page);