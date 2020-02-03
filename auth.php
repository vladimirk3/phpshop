<?php
$user_id = $_GET['user_id'];
//GET - для ответа обработчика

if ($_GET['result'] == 'success') {
    header("location: index.php?result=success");
    exit;
} else {
    include "templates/header.php";
    ?>

    <form action="auth_proc.php" method="post">
        <p>Логин:</p>
        <input type="text" name="login" required>
        <p>Пароль:</p>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Войти"><br><br>
    </form>

    <?php
        print_r($_GET['error']);
        }
    ?>
    <br><br>
    <a href="/reg.php">Зарегистрироваться</a>
