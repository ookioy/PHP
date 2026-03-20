<?php
$filename = 'products.csv';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = $_POST['name'];
    $price    = $_POST['price'];
    $quantity = $_POST['quantity'];
    $date     = $_POST['date'];
    $batch    = $_POST['batch'];
    $person   = $_POST['person'];

    $record = [$name, $price, $quantity, $date, $batch, $person];

    $file = fopen($filename, 'a');
    
    fputcsv($file, $record);
    fclose($file);

    header("Location: " . $_SERVER['PHP_SELF']);
}
?>

<?php 
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
        
            if (file_exists($filename)) {
                $file = fopen($filename, 'r');
                if ($file) {
                    while (($data = fgetcsv($file, 1000, ',')) !== false) {
                        echo "<tr>";
                        foreach ($data as $cell) {
                            echo "<td>" . $cell . "</td>";
                        }
                        echo "</tr>";
                    }
                    fclose($file);
                }
            } else {
                echo "<tr><td colspan='6'>Файл бази даних ще порожній. Додайте перший товар.</td></tr>";
            }
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