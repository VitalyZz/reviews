<?php
session_start();

if ($_SESSION['user']['access'] == 0) {
    header('Location: ../index.php');
    exit();
}

require_once 'data/connection.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/style3.css">
    <title>Document</title>
</head>
<body>
    <?php require_once 'header.php' ?>

    <section class="createReviewSection">
        <div class="container_createreview">
            <?php if(isset($_SESSION['message']['poster']) == true):?>
            <div class="errors_output1">
                <div class="errors_output_header1">Ошибка!</div>
                <div class="errors_output_text1">
                    <?=$_SESSION['message']['poster'];?>
                </div>
            </div>
            <?php endif; unset($_SESSION['message'])?>
            <h1 class="createReviewTitle">Создание обзора</h1>
            <form action="backend/createReview.php" method="POST" enctype="multipart/form-data" class="createReviewForm">
                <label for="name">Название:</label>
                <input type="text" name="name" placeholder="Введите название фильма"
                       value="<?php if (isset($_SESSION['data'])) echo $_SESSION['data']['name'];?>">

                <label for="text">Текст:</label>
                <textarea name="text" id="" cols="30" rows="10" placeholder="Напишите текст"><?php if (isset($_SESSION['data'])) echo $_SESSION['data']['text'];?></textarea>

                <label for="poster">Постер:</label>
                <div class="file-wrapper">
                    <input type="file" hidden="hidden" class="real-file" name="poster">
                    <button type="button" class="custom-button">Выбрать</button>
                    <span class="custom-text">Постер не выбран</span>
                </div>

                <label for="trailer">Трейлер:</label>
                <input type="text" name="trailer" placeholder="Вставьте ссылку на трейлер"
                       value="<?php if (isset($_SESSION['data'])) echo $_SESSION['data']['trailer'];?>">

                <input type="hidden" name="_token" value="<?=$_SESSION['_token']?>">
                <div class="wrapperForBtnForm">
                    <button type="submit" class="addReviewBtn">Добавить</button>
                </div>
            </form>
            <?php unset($_SESSION['data'])?>
        </div>
    </section>
    <script src="scripts/fileInput.js"></script>
</body>
</html>