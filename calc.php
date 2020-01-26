<?php
$arg1 = (isset($_GET["argone"])) ? (integer)$_GET["argone"] : "";
$arg2 = (isset($_GET["argtwo"])) ? (integer)$_GET["argtwo"] : "";
$operation = $_GET["operation"];

function sum ($e = 0, $f = 0) {
    return $e+$f;
}
function deduct ($e = 0, $f = 0) {
    return $e-$f;
}
function multi ($e = 0, $f = 0) {
    return $e*$f;
}
function div ($e = 0, $f = 0)
{
    if (!$f) {
        echo "Деление на ноль";
        return false;
    } else {
        return $e / $f;
    }
}

function mathOperation($arg1 = 0, $arg2 = 0, $operation = '+')
{
    switch ($operation) {
        case ('+'):
            return sum($arg1, $arg2);
            break;
        case ('-'):
            return deduct($arg1, $arg2);
            break;
        case ('*'):
            return multi($arg1, $arg2);
            break;
        case ('/'):
            return div($arg1, $arg2);
            break;
    }
}

$res = mathOperation($arg1, $arg2, $operation);
?>

<p>Задание 1:</p>
<form action="calc.php" method="get">
    <input type="text" name="argone" width="30px" hight="30px" font-size="20px">
    <select name="operation" id="oper">
        <option value="+">+</option>
        <option value="-">-</option>
        <option value="*">*</option>
        <option value="/">/</option>
    </select>
    <input type="text" name="argtwo" width="30px" hight="30px" font-size="20px">
    <p><?=$arg1?> <?=$operation?> <?=$arg2?> = <?=$res?></p>
    <input type="submit">
    <input type="reset">
</form>

<p>Задание 2:</p>
<form action="calc.php" method="get">
    <input type="text" name="argone" width="30px" hight="30px" font-size="20px">
    <input type="text" name="argtwo" width="30px" hight="30px" font-size="20px">
    <input type="submit" name="operation" value="+">
    <input type="submit" name="operation" value="-">
    <input type="submit" name="operation" value="*">
    <input type="submit" name="operation" value="/">
    <p><?=$arg1?> <?=$operation?> <?=$arg2?> = <?=$res?></p>
    <input type="reset">
</form>
