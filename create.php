<?php
require_once 'data/connectionFiles.php';

if ($_SESSION['user']['access'] == 0) {
    header('Location: ../index.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/global.css">
    <title>Document</title>
</head>
<body>
    <?php require_once 'header.php' ?>

    <section class="createReviewSection">
        <div class="container_createreview">
            <div class="errors_output1">
                <div class="errors_output_header1">Ошибка!</div>
                <div class="errors_output_text1"></div>
            </div>
            <h1 class="createReviewTitle">Создание обзора</h1>
            <form enctype="multipart/form-data" class="createReviewForm">
                <label for="name">Название:</label>
                <input type="text" name="name" class="createReview_name" placeholder="Введите название фильма">

                <label for="text">Текст:</label>
                <textarea name="text" id="" cols="30" rows="10" class="createReview_text" placeholder="Напишите текст"></textarea>

                <label for="poster">Постер:</label>
                <div class="file-wrapper">
                    <input type="file" hidden="hidden" name="poster" class="real-file createReview_poster">
                    <button type="button" class="custom-button">Выбрать</button>
                    <span class="custom-text">Постер не выбран</span>
                </div>

                <label for="trailer">Трейлер:</label>
                <input type="text" name="trailer" class="createReview_trailer" placeholder="Вставьте ссылку на трейлер">

                <input type="hidden" name="_token" class="createReview_token" value="<?=$_SESSION['_token']?>">
                <div class="wrapperForBtnForm">
                    <button type="submit" class="addReviewBtn">Добавить</button>
                </div>
            </form>
        </div>
    </section>
    <script src="scripts/fileInput.js"></script>
</body>
</html>