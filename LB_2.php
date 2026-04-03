<?php
require_once 'logic/db.php';
require_once 'logic/form_handler.php';
require_once 'logic/db_reader.php';
require_once 'logic/render_helpers.php';

handleProductForm($mysqli);

$products = readProducts($mysqli);

$pageTitle = 'Лабораторна робота №2: Робота з БД';
require 'blocks/header.php';
?>

<main>
    <section id="view">
        <h2>Інформація про товари на складі</h2>
        <?php renderProductsTableSimple($products); ?>
    </section>

    <section id="add">
        <h2>Додавання нового запису</h2>
        <form method="POST" action="">
            <p>Назва товару: <input type="text" name="name" required></p>
            <p>Ціна: <input type="number" step="0.01" name="price" required></p>
            <p>Кількість на складі: <input type="number" name="quantity" required></p>
            <p>Дата приходу: <input type="date" name="date" required></p>
            <p>Номер партії: <input type="text" name="batch" required></p>
            <p>Прізвище і ім'я відповідального: <input type="text" name="person" required></p>
            <button type="submit">Додати в БД</button>
        </form>
    </section>
</main>

<?php require 'blocks/footer.php'; ?>