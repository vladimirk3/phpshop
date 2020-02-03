<?php
include "config.php";
include "./module/module.php";

$user_id = isset($_GET['user_id']) ? strip_tags($_GET['user_id']) : "";
$good_id = isset($_GET['good_id']) ? strip_tags($_GET['good_id']): "";
$action = isset($_GET['action']) ? strip_tags($_GET['action']): "";
$basket_id = isset($_GET['basket_id']) ? strip_tags($_GET['basket_id']): "";


if ($action == "add") {
    if (($user_id == "") AND ($good_id == "")) {
        echo "empty_product_user"; //header location
        exit();
    }
    $res = addto_basket($link, $good_id, $user_id);
    if ($res[0] == True ) {
        header("location: /basket.php?result=success");
        exit();
    } else {
        header("location: /basket.php?result=error&detail=$res[1]");
        exit();
    }
} elseif ($action == "rem") {
    if (($user_id == "") AND ($basket_id == "")) {
        echo "empty_busket_user"; //header location
        exit();
    }
    $res = rem_basket ($link, $basket_id, $user_id);
    if ($res[0] == True ) {
        header("location: /basket.php?result=success");
        exit();
    } else {
        header("location: /basket.php?result=error&detail=$res[1]");
        exit();
    }
}

/*
$sql_get_good = "SELECT * FROM goods WHERE id='".$good_id."'";
$query_get_good = mysqli_query($link, $sql_get_good);
while ($row = mysqli_fetch_assoc($query_get_good)) {
    $data_good [] = $row;
}

$sql_get_user = "SELECT * FROM users WHERE user_id='".$user_id."'";
$query_get_user = mysqli_query($link, $sql_get_user);
$data_user = mysqli_fetch_assoc($query_get_user);

$sql_get_basket = "SELECT * FROM basket WHERE user_id='".$user_id."' AND good_id='".$good_id."'";
$query_get_basket = mysqli_query($link, $sql_get_basket);
$data_basket = mysqli_fetch_assoc($query_get_basket);

if ((mysqli_num_rows($query_get_good) == 1) AND (mysqli_num_rows($query_get_user) == 1)) {
    if ($data_good[0]['available'] > 0) {
        if (mysqli_num_rows($query_get_basket) == 1) {
            $sql_update_basket = "UPDATE basket SET count=count+1 WHERE user_id='" . $user_id . "' AND good_id='" . $good_id . "'";
            $query_update_basket = mysqli_query($link, $sql_update_basket);
        } elseif (mysqli_num_rows($query_get_basket) == 0) {
            $sql_addto_basket = "INSERT INTO basket (user_id, count, good_id) VALUES('" . $user_id . "', 1, '" . $good_id . "')";
            $query_update_basket = mysqli_query($link, $sql_addto_basket);
        }
        header("location: /basket.php?result=success");
        exit();
    } else {
        echo "No_available_good";
    }
} elseif ((mysqli_num_rows($query_get_good) != 1) AND (mysqli_num_rows($query_get_user) != 1)) {
    echo "No_good_no_user";
} elseif (mysqli_num_rows($query_get_good) != 1) {
    echo "No_good";
} elseif (mysqli_num_rows($query_get_user) != 1) {
    echo "No_user";
}
*/