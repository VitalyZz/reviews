<?php
session_start();

if(empty($_POST) == true) {
    header('Location: ../index.php');
}

require_once '../connection.php';

$id_user = $_SESSION['user']['id'];
$id_review = $_POST['id_review'];
$comment_text = $_POST['text'];

$arr = [
    'id_user' => $id_user,
    'id_review' => $id_review,
    'comment_text' => $comment_text
];

$sql = "INSERT INTO comments(id_user, id_review, comment_text) VALUES(:id_user, :id_review, :comment_text)";
$statement = $pdo->prepare($sql);
$statement->execute($arr);
header('Location: ../index.php');