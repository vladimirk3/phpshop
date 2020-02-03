<?php
include "config.php";

if (empty($_COOKIE['user_id'])) {
    header("location: /auth.php");
    exit();
}
$user_id = $_COOKIE['user_id'];

include "templates/header.php";
?>
    <div><a style="font-size: 20px; text-decoration: none; color: black; margin-left: 20px" href="/">Вернуться в каталог</a></div>
    <div class="basket">
        <h1>Корзина</h1>
        <table>
            <tbody>
                <tr>
                    <th class="basket_product">Наименование</th>
                    <th class="basket_qty">Количество</th>
                    <th class="basket_price">Цена за ед</th>
                </tr>


<?php
    $sql_basket = "SELECT user_id, user_name, good_id, count, brand, model, pic_path, price, basket_id  FROM basket inner JOIN users USING(user_id) inner JOIN goods on basket.good_id=goods.id WHERE user_id='".$user_id."'";
    $query_basket = mysqli_query($link, $sql_basket);
    $data = [];
    while ($row = mysqli_fetch_assoc($query_basket)) {
        $data [] = $row;
?>
                <tr>
                    <td class="basket_product"><?=$row['brand']?> <?=$row['model']?></td>
                    <td class="basket_qty"><?=$row['count']?></td>
                    <td class="basket_price"><?=$row['price']?> рублей</td>
                    <td class="basket_del"><a href="/basket_proc.php?action=rem&basket_id=<?=$row['basket_id']?>&user_id=<?=$row['user_id']?>"><button class="basket_button_del">Удалить</button></a></td>
                </tr>

<?php
}
mysqli_close($link);
?>
            </tbody>
        </table>
        <button class="basket_button">Перейти к оплате</button>
    </div>
<?php
include "templates/footer.php";
?>