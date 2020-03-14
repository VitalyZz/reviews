<?php
if (strpos($_SERVER['SCRIPT_NAME'], 'header') == true) {
    header('Location: index.php');
}

session_start();
?>
<link rel="stylesheet" href="styles/formsLogReg.css">
<div class="blackLayer"></div>
<header>
    <div class="home_create">
        <a href="index.php" class="home">Главная</a>
        <?php if($_SESSION['user']['access'] == 1):?>
        <a href="create.php" class="createReview">Создать</a>
        <?php endif;?>
    </div>
    <div class="logreg">
        <?php if(!isset($_SESSION['user'])):?>
        <a href="#" class="sign_in">Вход</a>
        <div class="palka"></div>
        <a href="#" class="sign_up">Регистрация</a>
        <?php endif;?>

        <?php if(isset($_SESSION['user'])):?>
            <span class="nameOfUser">Привет <?=$_SESSION['user']['name']?>!</span>
            <a href="backend/exit.php" class="exitFromSite">Выход</a>
        <?php endif;?>
    </div>
</header>
<div class="layer">
    <div class="form-box">
        <p class="message"><?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </p>
        <div class="closeModal"></div>
        <div class="button-box">
            <div id="btn"></div>
            <button class="toggle-btn loginBtn"">Вход</button>
            <button class="toggle-btn registerBtn">Регистрация</button>
        </div>
        <form action="backend/authorization.php" method="POST" class="input-group" id="login">
            <label for="email">Почта:</label>
            <input type="text" name="email" class="input-field" required>

            <label for="password">Пароль:</label>
            <input type="password" name="password" class="input-field" required>

            <button type="submit" class="submit-btn">Войти</button>
        </form>
        <form action="backend/registration.php" method="POST" class="input-group" id="register">
            <label for="name">Имя:</label>
            <input type="text" name="name" class="input-field" required>

            <label for="email">Почта:</label>
            <input type="email" name="email" class="input-field" required>

            <label for="password">Пароль:</label>
            <input type="password" name="password" class="input-field" required>

            <label for="confirm_password">Повторный пароль:</label>
            <input type="password" name="confirm_password" class="input-field" required>

            <label for="consent" class="consent1">Согласие на обработку данных</label>
            <input type="checkbox" class="check-box" name="consent">

            <button type="submit" class="submit-btn">Зарегистрироваться</button>
        </form>
    </div>
</div>
<script src="scripts/script.js"></script>