<?php

    /*
     * Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL)
     */

    require_once 'config/connect.php';

    /*
     * Получаем ID продукта из адресной строки - /product.php?id=1
     */

    $product_id = $_GET['id'];

    /*
     * Делаем выборку строки с полученным ID выше
     */

    $product = mysqli_query($connect, "SELECT * FROM `products` WHERE `id` = '$product_id'");

    /*
     * Преобразовывем полученные данные в нормальный массив
     * Используя функцию mysqli_fetch_assoc массив будет иметь ключи равные названиям столбцов в таблице
     */

    $product = mysqli_fetch_assoc($product);
?>

<!doctype html>
<html lang="en">
<head>
<link rel="stylesheet" href="style1.css">
    <meta charset="UTF-8">
    <title>Update Product</title>
</head>
<body>
    <h3>Update Product</h3>
    <form action="vendor/update.php" method="post">
        <input class="inp_form" type="hidden" name="id" value="<?= $product['id'] ?>">
        <p>Title</p>
        <input class="inp_form" type="text" name="title" value="<?= $product['title'] ?>">
        <p>Description</p>
        <textarea class="inp_form" name="description"><?= $product['description'] ?></textarea>
        <p>Price</p>
        <input class="inp_form" type="number" name="price" value="<?= $product['price'] ?>"> <br> <br>
        <button type="submit">Update</button>
    </form>
    <script src='ajax.js'></script>
</body>
</html>