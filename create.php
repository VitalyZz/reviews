<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/style3.css">
    <title>Document</title>
</head>
<body>
    <?php require_once 'header.php' ?>

    <section class="createReviewSection">
        <div class="container_createreview">
            <h1 class="createReviewTitle">Создание обзора</h1>
            <form action="" class="createReviewForm">
                <label for="name">Название:</label>
                <input type="text" name="name" placeholder="Введите ваше имя">

                <label for="text">Текст:</label>
                <textarea name="text" id="" cols="30" rows="10" placeholder="Напишите текст"></textarea>

                <label for="poster">Постер:</label>
                <input type="file" name="poster">

                <label for="trailer">Трейлер:</label>
                <input type="text" name="trailer" placeholder="Вставьте ссылку на трейлер">

                <div class="wrapperForBtnForm">
                    <button type="submit" class="addReviewBtn">Добавить</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>