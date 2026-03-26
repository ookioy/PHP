<?php
$filename = 'products.csv';
require 'logic/insert_data.php';

$pageTitle = 'Лабораторна робота №4: Стрічки';
require 'blocks/header.php'; 
?>

<main>
    <section id="view">
        <h2>Інформація про товари на складі</h2>
        
        <?php
        $products = [];
        if (file_exists($filename)) {
            $file = fopen($filename, 'r');
            if ($file) {
                while (($data = fgetcsv($file, 1000, ',')) !== false) {
                    if (count($data) >= 6) {
                        $products[] = $data;
                    }
                }
                fclose($file);
            }
        }

        usort($products, function($a, $b) {
            $priceA = (float)$a[1];
            $priceB = (float)$b[1];
            return $priceA <=> $priceB; 
        });

        $totalProducts = count($products);
        ?>

        <p><strong>Загальна кількість товарів:</strong> <?php echo $totalProducts; ?></p>
        
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
            if ($totalProducts > 0) {
                foreach ($products as $row) {
                    echo "<tr>";
                    foreach ($row as $cell) {
                        echo "<td>" . htmlspecialchars($cell) . "</td>";
                    }
                    echo "</tr>";
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