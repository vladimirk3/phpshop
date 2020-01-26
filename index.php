<?php
include "config.php";
include "templates/header.php";

//берем только данные, необходимые для рендеринга галереи. Детальную информацию по товару запросим из карточки товара
$sql_sorted = "SELECT id, brand, model,available, pic_path, price  FROM goods ORDER BY view desc";

$query = mysqli_query($link, $sql_sorted);

while ($data = mysqli_fetch_assoc($query)) { ?>
    <div class="gal_card">
        <a href='goodscard.php?id=<?=$data["id"]?>'>
            <img class='img' src='/img<?=$data["pic_path"]?>'>
            <p><?=$data["brand"]?><?=$data["model"]?></p>
            <p><?=$data["price"]?> руб</p>
        </a>
    </div>
<?php
}

mysqli_close($link);
include "templates/footer.php";
?>

