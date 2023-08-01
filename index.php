<?php

/*
 * Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL)
 */

require_once 'config/connect.php';

?>

<!doctype html>
<html lang="en">
<head>
<link rel="stylesheet" href="style1.css">
    <meta charset="UTF-8">
    <title>Products</title>
    <script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
        </tr>

        <?php

            /*
             * Делаем выборку всех строк из таблицы "products"
             */

            $products = mysqli_query($connect, "SELECT * FROM `products`");

            /*
             * Преобразовываем полученные данные в нормальный массив
             */

            $products = mysqli_fetch_all($products);

            /*
             * Перебираем массив и рендерим HTML с данными из массива
             * Ключ 0 - id
             * Ключ 1 - title
             * Ключ 2 - price
             * Ключ 3 - description
             */

            foreach ($products as $product) {
                ?>
                    <tr>
                        <td><?= $product[0] ?></td>
                        <td><?= $product[1] ?></td>
                        <td><?= $product[3] ?></td>
                        <td><?= $product[2] ?>$</td>
                        <td><a href="product.php?id=<?= $product[0] ?>">View</a></td>
                        <td><a href="update.php?id=<?= $product[0] ?>">Update</a></td>
                        <td><a style="color: red;" href="vendor/delete.php?id=<?= $product[0] ?>">Delete</a></td>
                    </tr>
                <?php
            }
        ?>
    </table>
    <h3>Add new product</h3>
    <form id="productForm" action="vendor/create.php" method="post">
        <p>Title</p>
        <input type="text" name="title" class="inp_form">
        <p>Description</p>
        <textarea class="inp_form" name="description"></textarea>
        <p>Price</p>
        <input type="number" name="price" class="inp_form"> <br> <br>
        <button type="submit">Add new product</button>
    </form>

    <script>
        $(document).ready(function(){
            $('#productForm').on('submit', function(e) {
                e.preventDefault(); // Предотвращаем отправку формы

                var titleValue = $('input[name="title"]').val();
                var descriptionValue = $('textarea[name="description"]').val();
                var priceValue = $('input[name="price"]').val();

                $.ajax({
                    type: "POST",
                    url: "vendor/create.php",
                    data: { title: titleValue, description: descriptionValue, price: priceValue },
                    success: function(response) {
                        alert("You have successfully registered a new product.");
                        $('#productForm')[0].reset();
                    }
                });
            });
        });
    </script>
</body>
</html>