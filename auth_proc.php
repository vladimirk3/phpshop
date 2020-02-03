<?php
include "config.php";
include "./module/module.php";

if ($_GET['mode'] == 'logout') {
    setcookie("user_id", "",time()-60);
    header("location: /index.php");
    exit;
} elseif ((!empty($_POST['login'])) AND (!empty($_POST['password']))) {

    $verify_res = auth_verify($link, $_POST['login'], $_POST['password']);
    if ($verify_res[0]) {
        $user_id = (string)$verify_res[1];
        setcookie("user_id", $user_id, time() + 3600);
        header("location: /index.php?result=success");
    } else {
        if ($verify_res[1] == "no_user_pass") {
            header("location: /auth.php?result=fail&error=no such combination of user and password");
        } elseif ($verify_res[1] == "empty_user_pass") {
            header("location: /auth.php?result=fail&error=empty user or password");
        } else {
            header("location: /auth.php?result=fail&error=db error");
        }
    }
} elseif ((!empty($_POST['login_reg'])) AND (!empty($_POST['password_reg']))) {

    $reg_res = user_reg($link, $_POST['login_reg'], $_POST['password_reg'], $_POST['name'], $_POST['email']);

    if ($reg_res[0]) {
        $user_id = "$reg_res[1]";
        setcookie("user_id", $user_id, time() + 3600);
        header("location: /index.php?result=success");
    } else {
        if ($reg_res[1] == "user_exist") {
            header("location: /reg.php?result=fail&error=such name exist");
        } elseif ($reg_res[1] == "empty_user_pass") {
            header("location: /reg.php?result=fail&error=empty user or password");
        } else {
            header("location: /reg.php?result=fail&error=db error");
        }
    }
}
