<?php

function auth_verify($link, $log = "", $pass = "") {
    $login = (isset($log)) ? strip_tags($log): "";
    $password = (isset($pass)) ? strip_tags($pass) : "";

    if (($login == "") AND ($password == "")) {
        return [False , "empty_user_pass"];
    }
    $password = md5($password);
    $sql_auth_req = "SELECT * FROM users WHERE user_name='$login' and password='$password'";

    $sql_query_auth = mysqli_query($link, $sql_auth_req) or die("Error: ".mysqli_error($link));

    $data = mysqli_fetch_assoc($sql_query_auth);

    if (mysqli_num_rows($sql_query_auth) == 1) {
        return [True , $data['user_id']];
    }
    elseif (mysqli_fetch_row($sql_query_auth) > 1) {
        return [False , "db_error"];
    } else {
        return [False , "no_user_pass"];
    }
}

function user_reg($link, $log, $pass, $uname, $umail) {
    $login = (isset($log)) ? strip_tags($log): "";
    $password = (isset($pass)) ? strip_tags($pass) : "";
    $name = (isset($uname)) ? strip_tags($uname): "";
    $email = (isset($umail)) ? strip_tags($umail): "";
    if (($login == "") AND ($password == "")) {
        return [False , "empty_user_pass"];
    }
    $password = md5($password);
    //предполагаем, что имя (не login) и почта могу быть не уникальными
    $sql_user = "SELECT * FROM users WHERE user_name='$login'";

    $sql_query_user = mysqli_query($link, $sql_user) or die([False, "db_error"]);

    if (mysqli_num_rows($sql_query_user) == 0) {
        //будем добавлять в БД только имя пользователя и пароль
        $sql_add_user = "INSERT INTO users (user_name, password) VALUES ('".$login."', '".$password."')";
        $sql_au_result = mysqli_query($link, $sql_add_user);
        if ($sql_au_result == True) {
            $res_get_uid = mysqli_query($link, $sql_user) or die("Error: ".mysqli_error($link));
            $data = mysqli_fetch_assoc($res_get_uid);
            return [True, $data['user_id']];
        } else {
            return [False, "Error: ".mysqli_error($link)];
        }
    } else {
        return [False, "user_exist"];
    }
}

function addto_basket ($link, $good_id, $user_id) {
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
                if ($query_update_basket == True) {
                    return [True, "success"];
                } else {
                    return [False, "cannot_edit_data"];
                }
            } elseif (mysqli_num_rows($query_get_basket) == 0) {
                $sql_addto_basket = "INSERT INTO basket (user_id, count, good_id) VALUES('" . $user_id . "', 1, '" . $good_id . "')";
                $query_update_basket = mysqli_query($link, $sql_addto_basket);
                if ($query_update_basket == True) {
                    return [True, "success"];
                } else {
                    return [False, "cannot_edit_data"];
                }
            }
        } else {
            return [False, "No_available_good"];
        }
    } elseif ((mysqli_num_rows($query_get_good) != 1) AND (mysqli_num_rows($query_get_user) != 1)) {
        return [False, "No_good_no_user"];
    } elseif (mysqli_num_rows($query_get_good) != 1) {
        return [False, "No_good"];
    } elseif (mysqli_num_rows($query_get_user) != 1) {
        return [False, "No_user"];
    }
}


function rem_basket ($link, $basket_id, $user_id) {
    $sql_get_user = "SELECT * FROM users WHERE user_id='".$user_id."'";
    $query_get_user = mysqli_query($link, $sql_get_user);
    $data_user = mysqli_fetch_assoc($query_get_user);

    $sql_get_basket = "SELECT * FROM basket WHERE user_id='".$user_id."' AND basket_id='".$basket_id."'";
    $query_get_basket = mysqli_query($link, $sql_get_basket);
    $data_basket = mysqli_fetch_assoc($query_get_basket);
    while ($row = mysqli_fetch_assoc($query_get_basket)) {
        $data_basket [] = $row;
    }
    if (mysqli_num_rows($query_get_basket) == 1) {
        if ($data_basket['count'] > 1) { //проверить count>1 то count-- иначе remove запись
            $sql_update_basket = "UPDATE basket SET count=count-1 WHERE user_id='" . $user_id . "' AND basket_id='" . $basket_id . "'";
            $query_update_basket = mysqli_query($link, $sql_update_basket);
            if ($query_update_basket == True) {
                return [True, "success"];
            } else {
                return [False, "cannot_edit_data"];
            }
        } elseif ($data_basket['count'] <= 1) {
            $sql_rem_basket = "DELETE FROM basket WHERE user_id='".$user_id."' AND basket_id='". $basket_id ."'";
            $query_update_basket = mysqli_query($link, $sql_rem_basket);
            if ($query_update_basket == True) {
                return [True, "success"];
            } else {
                return [False, "cannot_edit_data"];
            }
        }
    } elseif ((mysqli_num_rows($query_get_basket) != 1) AND (mysqli_num_rows($query_get_user) != 1)) {
        return [False, "No_good_no_user"];
    } elseif (mysqli_num_rows($query_get_basket) != 1) {
        return [False, "No_good_in_basket"];
    } elseif (mysqli_num_rows($query_get_user) != 1) {
        return [False, "No_user"];
    }
}