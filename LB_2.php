<?php
$filename = 'products.csv';
require 'logic/insert_data.php';

$pageTitle = 'Лабораторна робота №2: Обробка файлів';
require 'blocks/header.php'; 
?>

<main>
    <section id="view">
        <h2>Інформація про товари на складі</h2>
        
        <table border="1">
            <tr>
                <th>Назва товару</th>
                <th>Ціна</th>
                <th>Кількість на складі</th>
                <th>Дата приходу</th>
                <th>Номер партії</th>
                <th>Відповідальний</th>
            </tr>
            
            <?php
                require 'logic/show_data.php';
            ?>
        </table>
    </section>

    <section id="add">
        <h2>Додавання нового запису</h2>
        
        <form method="POST" action="">
            <p>Назва товару: <input type="text" name="name" required></p>
            <p>Ціна: <input type="number" step="0.01" name="price" required></p>
            <p>Кількість на складі: <input type="number" name="quantity" required></p>
            <p>Дата приходу: <input type="date" name="date" required></p>
            <p>Номер партії: <input type="text" name="batch" required></p>
            <p>Прізвище і ім’я відповідального: <input type="text" name="person" required></p>
            
            <button type="submit">Додати у файл</button>
        </form>
    </section>
</main>

<?php require 'blocks/footer.php';