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
    <title>Document</title>
</head>
<body>
    <?php require_once 'header.php'?>

    <section class="sect_cards">
        <div class="container">
            <div class="row boy">
                <div class="card-moy">
                    <div class="card" style="width: 18rem;">
                        <img src="img/poster.jpg" class="card-img-top" alt="img">
                        <div class="card-body">
                            <a href="review.php?id=1" class="film_title">Миссия невыполнима протокол фантом</a>
                            <div class="under_panel">
                                <span class="author">Виталий</span>
                                <span class="date">05.03.2020</span>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <img src="img/avatar.jpg" class="card-img-top" alt="img">
                        <div class="card-body">
                            <a href="#" class="film_title">Аватар</a>
                            <div class="under_panel">
                                <span class="author">Анна</span>
                                <span class="date">25.02.2020</span>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <img src="img/vikings.jpg" class="card-img-top" alt="img">
                        <div class="card-body">
                            <a href="#" class="film_title">Викинги</a>
                            <div class="under_panel">
                                <span class="author">Анна</span>
                                <span class="date">25.02.2020</span>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <img src="img/poster.jpg" class="card-img-top" alt="img">
                        <div class="card-body">
                            <a href="#" class="film_title">Миссия невыполнима протокол фантом</a>
                            <div class="under_panel">
                                <span class="author">Виталий</span>
                                <span class="date">05.03.2020</span>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <img src="img/avatar.jpg" class="card-img-top" alt="img">
                        <div class="card-body">
                            <a href="#" class="film_title">Аватар</a>
                            <div class="under_panel">
                                <span class="author">Анна</span>
                                <span class="date">25.02.2020</span>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <img src="img/vikings.jpg" class="card-img-top" alt="img">
                        <div class="card-body">
                            <a href="#" class="film_title">Викинги</a>
                            <div class="under_panel">
                                <span class="author">Анна</span>
                                <span class="date">25.02.2020</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>