<?php

include "config.php";
include "templates/header.php";

$id = $_GET['id'];

//echo $id;

$sql_view_plus = "UPDATE goods SET view=view+1 WHERE id='".$id."'";
$query = mysqli_query($link, $sql_view_plus);

$sql_good_data = "SELECT * FROM goods WHERE id='".$id."'";
$query = mysqli_query($link, $sql_good_data);

//так как запрос по id, а он уникален и это конролируется на уровне БД, то выводим не в цикле
$good_data = mysqli_fetch_assoc($query);
?>

<div class="card_pic_desc">
    <div class="card_pic">
        <a class='img_click' href='#' data-imglink='/img<?=$good_data["full_pic_path"]?>'>
            <img class="card_img" src="/img<?=$good_data['full_pic_path']?>" alt="фото <?=$good_data['brand']?> <?=$good_data['model']?>">
        </a>
    </div>
    <div class="card_desc">
        <h1><?=$good_data['brand']?> <?=$good_data['model']?></h1>
        <p>Арикул: </p>
        <p>Цена: <span class="card_price"><?=$good_data['price']?></span></p>
        <button>Купить</button>
        <p>Количество просмотров: <?=$good_data['view']?></p>
        <p>Количество товаров на складе: <?=$good_data['available']?></p>
    </div>
</div>
<div class="card_details">
    <h2>Описание: </h2>
    <p><?=$good_data['description']?></p>
    <h3>Характеристики:</h3>
    <h4>Общие характеристики:</h4>
    <ul>
        <li>Тип: <?=$good_data['category']?></li>
        <li>Модель: <?=$good_data['model']?></li>
        <li>Цвет: <?=$good_data['color']?></li>
    </ul>
    <h4>Дополнительные характеристики:</h4>
    <ul>
        <li>Обслуживаемая прощадь:   <?=$good_data['square']?></li>
        <li>Потребляемая мощность:   <?=$good_data['power']?></li>
        <li>Расход воды:   <?=$good_data['wat_consume']?></li>
        <li>Тип фильтра:   <?=$good_data['filter']?></li>
        <li>Продолдительность увлажнения:   <?=$good_data['hyd_duration']?></li>
        <li>Ширина:   <?=$good_data['wide']?></li>
        <li>Высота:   <?=$good_data['hight']?></li>
        <li>Глубина:   <?=$good_data['longt']?></li>
        <li>Вес:   <?=$good_data['weight']?></li>
    </ul>
</div>

    <div class="win">
        <div class="frame">
            <button class="close_win">
                <svg viewBox="0 0 32 32"><path d="M10,10 L22,22 M22,10 L10,22"></path></svg>
            </button>
            <div class="img_win">
                <img class="pic" src="" alt="big">
            </div>
        </div>
    </div>

<?php
mysqli_close($link);
include "templates/footer.php";
?>