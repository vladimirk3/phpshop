<?php

include "config.php";
include "./module/module.php";

if ($_GET['result_reg'] == 'success') {
    header("location: index.php?result=success");
    exit;
} else {
    include "templates/header.php";
    ?>

    <form action="auth_proc.php" method="post">
        <p>Логин:</p>
        <input type="text" name="login_reg" required>
        <p>Пароль:</p>
        <input type="password" name="password_reg" required><br><br>
        <p>Имя фамилия:</p>
        <input type="text" name="name">
        <p>email адрес:</p>
        <input type="email" name="email"><br>
        <input type="submit" value="Зарегистрироваться"><br><br>
    </form>

    <?php
    print_r($_GET['error']);
}
?>
