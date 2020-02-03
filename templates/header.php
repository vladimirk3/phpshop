<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/normalize.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="./script/jquery.js"></script>
    <script type="text/javascript" src="./script/script.js"></script>
    <script type="text/javascript" src="./script/main.js"></script>
    <title>Gallery</title>
</head>
<?php
    if (!empty($_COOKIE['user_id'])) {
        $inout = "Выйти";
        $inout_ref = "/auth_proc.php?mode=logout";
    } else {
        $inout = "Вход";
        $inout_ref = "/auth.php";
    }
?>

<body>
<div class="site_container">
    <header>
        <div class="logo">E-shop</div>
        <div class="cart">
            <a href="/basket.php">
                <button class="btn-cart" type="button">
                    <i class="fa fa-shopping-bag fa-2x"></i>
                </button>
            </a>
            <div class="cart-block invisible"></div>
        </div>
        <div class="right_menu"><a style="font-size: 20px; text-decoration: none; color: black;" href="<?=$inout_ref?>"><?=$inout?></a></div>
        <div><a style="font-size: 20px; text-decoration: none; color: black;" href="/">Каталог</a></div>
    </header>
    <main>


