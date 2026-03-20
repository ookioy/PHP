<?php
$filename = 'products.csv';

$pageTitle = 'Лабораторна робота №4: Стрічки';
require 'blocks/header.php';
?>

<main>
    <section id="search">
        <h2>Пошук за відповідальним</h2>
        <?php
        $searchQuery = isset($_GET['searchQuery']) ? trim($_GET['searchQuery']) : '';
        ?>
        <form method="GET" action="">
            <p>Введіть символи для пошуку (прізвище/ім'я):
                <input type="text" name="searchQuery" value="<?php echo htmlspecialchars($searchQuery); ?>">
            </p>
            <button type="submit">Шукати</button>
            <a href="<?php echo $_SERVER['PHP_SELF']; ?>"><button type="button">Скинути пошук</button></a>
        </form>
    </section>
    <hr>

    <section id="view">
        <h2>Інформація про товари на складі</h2>

        <?php
        $products = [];
        if (file_exists($filename)) {
            $file = fopen($filename, 'r');
            if ($file) {
                while (($data = fgetcsv($file, 1000, ',')) !== false) {
                    if (count($data) >= 6) {
                        if ($searchQuery !== '') {
                            if (mb_stripos($data[5], $searchQuery) !== false) {
                                $products[] = $data;
                            }
                        } else {
                            $products[] = $data;
                        }
                    }
                }
                fclose($file);
            }
        }

        usort($products, function ($a, $b) {
            $priceA = (float)$a[1];
            $priceB = (float)$b[1];
            return $priceA <=> $priceB;
        });

        $totalProducts = count($products);
        ?>

        <p><strong>Кількість знайдених товарів:</strong> <?php echo $totalProducts; ?></p>

        <?php if ($totalProducts > 0): ?>
            <table border="1">
                <tr>
                    <th>Назва товару</th>
                    <th>Ціна</th>
                    <th>Кількість на складі</th>
                    <th>Дата приходу</th>
                    <th>Номер партії</th>
                    <th>Відповідальний</th>
                </tr>

                <?php foreach ($products as $row): ?>
                    <tr>
                        <?php foreach ($row as $cell): ?>
                            <td><?php echo htmlspecialchars($cell); ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <?php if ($searchQuery !== ''): ?>
                <p>За вашим запитом "<strong><?php echo htmlspecialchars($searchQuery); ?></strong>" нічого не знайдено.</p>
            <?php else: ?>
                <p>Файл бази даних ще порожній. Додайте перший товар.</p>
            <?php endif; ?>
        <?php endif; ?>
        </table>
    </section>
    <hr>
</main>

<?php require 'blocks/footer.php';
