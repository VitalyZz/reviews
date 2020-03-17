<?php
if (strpos($_SERVER['SCRIPT_NAME'], 'header') == true) {
    header('Location: index.php');
    exit();
}
session_start();
?>
<link rel="stylesheet" href="styles/formsLogReg.css">
<div class="blackLayer"></div>
<header>
    <div class="home_create">
        <a href="index.php" class="home">Главная</a>
        <?php if ($_SESSION['user']['access'] == 1):?>
            <a href="create.php" class="createReview">Создать</a>
        <?php endif;?>

        <?php if (isset($_SESSION['message']['success']) == true):?>
            <div class="success"><?=$_SESSION['message']['success']?></div>
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
        <div class="errors_output_text">
            <?php if (isset($_SESSION['message']['reg']) == true):?>
                <?php echo $_SESSION['message']['reg'];?>
            <?php elseif (isset($_SESSION['message']['auth']) == true):?>
                <?php echo $_SESSION['message']['auth'];?>
            <?php endif;?>
        </div>
    </div>
    <div class="form-box">
        <div class="closeModal"></div>
        <div class="button-box">
            <div id="btn"></div>
            <button class="toggle-btn loginBtn"">Вход</button>
            <button class="toggle-btn registerBtn">Регистрация</button>
        </div>
        <form action="backend/authorization.php" method="POST" class="input-group" id="login">
            <label for="email">Почта:</label>
            <input type="text" name="email" class="input-field"
                   value="<?php if (isset($_SESSION['data'])) echo $_SESSION['data']['email'];?>">

            <label for="password">Пароль:</label>
            <input type="password" name="password" class="input-field"
                   value="<?php if (isset($_SESSION['data'])) echo $_SESSION['data']['password'];?>">

            <input type="hidden" name="_token" value="<?=$_SESSION['_token']?>">
            <button type="submit" class="submit-btn">Войти</button>
        </form>
        <form action="backend/registration.php" method="POST" class="input-group" id="register">
            <label for="name">Имя:</label>
            <input type="text" name="name" class="input-field"
                   value="<?php if (isset($_SESSION['data'])) echo $_SESSION['data']['name'];?>">

            <label for="email">Почта:</label>
            <input type="email" name="email" class="input-field"
                   value="<?php if (isset($_SESSION['data'])) echo $_SESSION['data']['email'];?>">

            <label for="password">Пароль:</label>
            <input type="password" name="password" class="input-field"
                   value="<?php if (isset($_SESSION['data'])) echo $_SESSION['data']['password'];?>">

            <label for="confirm_password">Повторный пароль:</label>
            <input type="password" name="confirm_password" class="input-field"
                   value="<?php if (isset($_SESSION['data'])) echo $_SESSION['data']['confirm_password'];?>">

            <div class="consent-data-wrapper">
                <label for="consent" class="consent_data">Согласие на обработку данных</label>
                <input type="checkbox" class="check-box" name="consent"
                    <?php if (isset($_SESSION['data']['consent'])):?> checked <?php endif;?>>
            </div>

            <input type="hidden" name="_token" value="<?=$_SESSION['_token']?>">
            <button type="submit" class="submit-btn">Зарегистрироваться</button>
        </form>
        <?php if(isset($_SESSION['data']['email'])) unset($_SESSION['data'])?>
    </div>
</div>
<script src="scripts/script.js"></script>
<?php if (isset($_SESSION['message']['reg']) == true):?>
    <script>
        register();
        openModalWindow();
        document.querySelector('.errors_output').style.display = 'block';
    </script>
<?php elseif (isset($_SESSION['message']['auth']) == true):?>
    <script>
        login();
        openModalWindow();
        document.querySelector('.errors_output').style.display = 'block';
    </script>
<?php endif;?>
<?php
if (isset($_SESSION['message']['reg']) == true) unset($_SESSION['message']['reg']);
if (isset($_SESSION['message']['auth']) == true) unset($_SESSION['message']['auth']);
if (isset($_SESSION['message']['success']) == true) unset($_SESSION['message']['success']);
?>