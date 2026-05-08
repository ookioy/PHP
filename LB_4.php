<?php
require_once 'logic/db.php';
require_once 'logic/form_handler.php';
require_once 'logic/db_reader.php';
require_once 'logic/render_helpers.php';

handleProductForm($mysqli);
$searchQuery = isset($_GET['searchQuery']) ? trim($_GET['searchQuery']) : '';

// Фільтрація за відповідальним і сортування за ціною — все в одному SQL-запиті
$products      = readProductsSorted($mysqli, $searchQuery);
$totalProducts = count($products);

$pageTitle = 'Лабораторна робота №4: Стрічки та Пошук (БД)';
require 'blocks/header.php';
?>

<main>
    <section id="search">
        <h2>Пошук за відповідальним</h2>
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
        $emptyMsg = $searchQuery !== ''
            ? 'За вашим запитом "' . htmlspecialchars($searchQuery) . '" нічого не знайдено.'
            : 'База даних ще порожня. Додайте перший товар.';

        renderProductsTable($products, $totalProducts, $emptyMsg, 'Кількість знайдених товарів');
        ?>
    </section>
    <hr>

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