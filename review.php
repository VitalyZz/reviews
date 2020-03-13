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
    <link rel="stylesheet" href="styles/style2.css">
    <title>Document</title>
</head>
<body>
    <?php require_once 'header.php'?>
    <section class="review">
        <div class="review-container">
            <div class="review-up">
                <div class="title">Миссия невыполнима протокол фантом</div>
                <div class="date">05.03.2020</div>
            </div>
            <div class="block">
                <div class="trailer">
                    <iframe width="730" height="410" src="https://www.youtube.com/embed/_D2o8Gz81_o" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <div class="review_author">Автор: Виталий</div>
                </div>
                <div class="poster">
                    <img src="img/poster.jpg" alt="">
                </div>
            </div>
            <div class="review_text">В фильме Миссия невыполнима: Протокол Фантом после взрыва Московского Кремля подразделение МВФ закрывается и является главным подозреваемым по данному делу. Агенты вынуждены скрываться, и помощи им ждать уже не откуда. Итан Хант и его коллеги должны собраться с силами и очистить своё имя от необоснованных обвинений, выходя на след настоящих террористов.</div>

            <?php if(isset($_SESSION['user'])):?>
            <form action="" class="write_comment">
                <label for="text">Написать комментарий:</label>
                <textarea name="text" id="" rows="5"></textarea>
                <div class="review-btn">
                    <button type="submit" class="submit_comment">Отправить</button>
                </div>
            </form>
            <?php endif;?>
            <p class="commentsTitle">Комментарии:</p>
            <div class="comments">
                <div class="comment">
                    <div class="block-up">
                        <div class="comment_author">Андрей</div>
                        <div class="date_comment">03.05.2020</div>
                    </div>
                    <div class="text_comment">Сюжет построен вполне удачно для подобного кино; сценарий, делая акцент на зрелищности, тем не менее, не забывает и о логичности, но самое главное - есть уверенная динамика, которая скучать зрителя точно не заставит. Два часа пролетают незаметно, герои источают лучи харизмы и наполняют действие обилием юмора. 'Ghost Protocol' - это развлечение, но развлечение с большой буквы. Великолепный зимний блокбастер, которому оказалось под силу раскрыть весь свой потенциал.</div>
                </div>
                <div class="comment">
                    <div class="block-up">
                        <div class="comment_author">Олег</div>
                        <div class="date_comment">18.06.2020</div>
                    </div>
                    <div class="text_comment">Сюжет построен вполне удачно для подобного кино; сценарий, делая акцент на зрелищности, тем не менее, не забывает и о логичности, но самое главное - есть уверенная динамика, которая скучать зрителя точно не заставит. Два часа пролетают незаметно, герои источают лучи харизмы и наполняют действие обилием юмора. 'Ghost Protocol' - это развлечение, но развлечение с большой буквы. Великолепный зимний блокбастер, которому оказалось под силу раскрыть весь свой потенциал.</div>
                </div>
                <div class="comment">
                    <div class="block-up">
                        <div class="comment_author">Анна</div>
                        <div class="date_comment">09.07.2020</div>
                    </div>
                    <div class="text_comment">Сюжет построен вполне удачно для подобного кино; сценарий, делая акцент на зрелищности, тем не менее, не забывает и о логичности, но самое главное - есть уверенная динамика, которая скучать зрителя точно не заставит. Два часа пролетают незаметно, герои источают лучи харизмы и наполняют действие обилием юмора. 'Ghost Protocol' - это развлечение, но развлечение с большой буквы. Великолепный зимний блокбастер, которому оказалось под силу раскрыть весь свой потенциал.</div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>