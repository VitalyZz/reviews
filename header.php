<?php
if (strpos($_SERVER['SCRIPT_NAME'], 'header') == true) {
    header('Location: index.php');
    exit();
}
?>
<link rel="stylesheet" href="styles/formsLogReg.css">
<div class="blackLayer"></div>
<header id="header">
    <div class="home_create">
        <a href="index.php" class="home">Главная</a>
        <?php if ($_SESSION['user']['access'] == 1):?>
            <a href="create.php" class="createReview">Создать</a>
        <?php endif;?>
    </div>
    <div class="logreg">
        <?php if (!isset($_SESSION['user'])):?>
            <a href="#" class="sign_in">Вход</a>
            <a href="#" class="sign_up">Регистрация</a>
        <?php endif;?>

        <?php if (isset($_SESSION['user'])):?>
            <span class="nameOfUser">Привет <?=$_SESSION['user']['name']?>!</span>
            <a href="backend/exit.php" class="exitFromSite">Выход</a>
        <?php endif;?>
    </div>
</header>
<div class="layer">
    <div class="errors_output">
        <div class="errors_output_header">Ошибка!</div>
        <div class="errors_output_text"></div>
    </div>
    <div class="form-box">
        <div class="closeModal"></div>
        <div class="button-box">
            <div id="btn"></div>
            <button class="toggle-btn loginBtn"">Вход</button>
            <button class="toggle-btn registerBtn">Регистрация</button>
        </div>
        <form class="input-group" id="login">
            <label for="email">Почта:</label>
            <input type="text" name="email" class="input-field authorization_email">

            <label for="password">Пароль:</label>
            <input type="password" name="password" class="input-field authorization_password">

            <input type="hidden" name="_token" value="<?=$_SESSION['_token']?>" class="authorization_token">
            <button type="submit" class="submit-btn authorization_submit">Войти</button>
        </form>
        <form class="input-group" id="register">
            <label for="name">Имя:</label>
            <input type="text" name="name" class="input-field registration_name">

            <label for="email">Почта:</label>
            <input type="email" name="email" class="input-field registration_email">

            <label for="password">Пароль:</label>
            <input type="password" name="password" class="input-field registration_password">

            <label for="confirm_password">Повторный пароль:</label>
            <input type="password" name="confirm_password" class="input-field registration_confirm_password">

            <div class="consent-data-wrapper">
                <label for="consent" class="consent_data">Согласие на обработку данных</label>
                <input type="checkbox" class="check-box registration_consent" name="consent">
            </div>

            <input type="hidden" name="_token" value="<?=$_SESSION['_token']?>" class="registration_token">
            <button type="submit" class="submit-btn registration_submit">Зарегистрироваться</button>
        </form>
    </div>
</div>

<script src="scripts/script.js"></script>
<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
</script>
<script src="scripts/functions.js"></script>
<script src="scripts/scriptAjax.js"></script>
