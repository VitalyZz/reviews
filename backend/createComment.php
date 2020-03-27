<?php
require_once '../data/connectionFiles.php';

header('Content-type: application/json; charset=utf-8');

if (empty($_POST) && !isset($_SESSION['user']['id'])) {
    switchingPage();
}

$id_user = $_SESSION['user']['id'];
$id_review = $_POST['id_review'];
$comment_text = $_POST['text'];

$patternCommentText = '/[a-zа-я]+/iu';

$messageCommentText = "Поле должно иметь хотя бы одну букву!";

// Проверка на пустоту полей
if ($comment_text == '') {
    header('HTTP/1.0 403 Error!');
    die (json_encode("ОШИБКА! Поле пустое!"));
}

// Проверка поля text
checkField($patternCommentText, $comment_text, $messageCommentText);

$arr = [
    'id_user' => $id_user,
    'id_review' => $id_review,
    'comment_text' => $comment_text
];

$sql = "INSERT INTO comments(id_user, id_review, comment_text) VALUES(:id_user, :id_review, :comment_text)";
$statement = $pdo->prepare($sql);
$statement->execute($arr);

$sqlUser = "SELECT c.date_added_comment, u.name FROM comments c JOIN users u ON c.id_user = u.id_user 
WHERE c.id_user = ? ORDER BY date_added_comment DESC";
$statementUser = $pdo->prepare($sqlUser);
$statementUser->bindValue(1, $id_user, PDO::PARAM_INT);
$statementUser->execute();
$result = $statementUser->fetch(PDO::FETCH_ASSOC);

die (json_encode([
    "message" => "Комментарий добавлен!",
    "comment_author" => $result['name'],
    "date_comment" => $result['date_added_comment'],
    "text_comment" => $comment_text
]));