<?php
require_once '../data/connectionFiles.php';

header('Content-type: application/json; charset=utf-8');

$sqlComments = "SELECT c.date_added_comment, c.comment_text, u.name FROM comments c LEFT JOIN users u ON c.id_user = u.id_user WHERE c.id_review = ? ORDER BY c.id_comment DESC";
$statementComment = $pdo->prepare($sqlComments);
$statementComment->bindValue(1, $_GET['id_review'], PDO::PARAM_INT);
$statementComment->execute();
$resultComments = $statementComment->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultComments as $el) {
    $name = $el['name'];
    $date_added_comment = $el['date_added_comment'];
    $comment_text = $el['comment_text'];
    echo
    "
        <div class=\"comment\">
            <div class=\"block-up\">
                <div class=\"comment_author\">$name</div>
                <div class=\"date_comment\">$date_added_comment</div>
            </div>
            <div class=\"text_comment\">$comment_text</div>
        </div>
    ";
}