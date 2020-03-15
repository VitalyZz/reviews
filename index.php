<?php
session_start();
require_once 'connection.php';
$sql = "SELECT r.id_review, r.film_title, r.poster, r.date_added_review, u.name FROM reviews r LEFT JOIN users u ON r.id_user = u.id_user ORDER BY r.id_review DESC";
$statement = $pdo->query($sql);
$reviews = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <title>Document</title>
</head>
<body>
    <?php require_once 'header.php'?>
    <section class="sect_cards">
        <div class="container">
            <div class="row boy">
                <div class="card-moy">
                    <?php foreach ($reviews as $review):?>
                        <div class="card" style="width: 18rem;">
                            <img src="<?=$review['poster']?>" class="card-img-top" alt="img">
                            <div class="card-body">
                                <a href="review.php?id_review=<?=$review['id_review']?>" class="film_title"><?=$review['film_title']?></a>
                                <div class="under_panel">
                                    <span class="author"><?=$review['name']?></span>
                                    <span class="date"><?=$review['date_added_review']?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </section>
</body>
</html>