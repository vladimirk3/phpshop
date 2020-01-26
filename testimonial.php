<?php
include "templates/header.php";
include "config.php";
$sql_fetch = "SELECT * FROM testim ORDER BY id desc LIMIT 5";
$query = mysqli_query($link, $sql_fetch);
?>

    <div>
        <input type="text" class="name" name="name" placeholder="Введите имя" required>
    </div>
    <div>
        <textarea name="text" class="text" cols="80" rows="10" placeholder="Оставьте отзыв" required></textarea>
    </div>
    <button type="submit" class="testim_button">Отправить</button>
    <p style="margin-top: 20px; font-size: 20px">Отзывы:</p>

    <div class="testim_rec">
        <?php
            while ($row = mysqli_fetch_assoc($query)) {
        ?>
            <div>
                <p class="t_bold"><?=$row['name']?> писал <?=$row['date']?>:</p>
                <p><?=$row['text']?></p>
            </div>
        <?php
            }
        ?>
    </div>

<?php
mysqli_close($link);
include "templates/footer.php";
?>