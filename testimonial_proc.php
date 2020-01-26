<?php
include "config.php";

$name = (isset($_POST['name'])) ? $_POST['name'] : "";
$text = (isset($_POST['text'])) ? $_POST['text'] : "";
$date = date("Y-m-d H:i:s");

$sql_test = "INSERT INTO testim (name, text, date) values('".$name."', '".$text."', '".$date."')";
$query = mysqli_query($link, $sql_test);


$sql_fetch = "SELECT * FROM testim ORDER BY id desc LIMIT 5";
$query = mysqli_query($link, $sql_fetch);

$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data [] = $row;
}

mysqli_close($link);
echo json_encode ($data);
