<?php

function renderProductsTableSimple(
    array  $products,
    string $emptyMsg = 'Файл бази даних ще порожній. Додайте перший товар.'
): void {
    if (empty($products)) {
        echo '<p>' . htmlspecialchars($emptyMsg) . '</p>';
        return;
    }
    ?>
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
    <?php
}

function renderProductsTable(
    array  $products,
    int    $total,
    string $emptyMsg   = 'Файл бази даних ще порожній. Додайте перший товар.',
    string $countLabel = 'Загальна кількість товарів'
): void {
    echo '<p><strong>' . htmlspecialchars($countLabel) . ':</strong> ' . $total . '</p>';

    if ($total === 0) {
        echo '<p>' . htmlspecialchars($emptyMsg) . '</p>';
        return;
    }
    ?>
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
    <?php
}