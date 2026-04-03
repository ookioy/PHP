<?php

function renderProductsTableSimple(
    array  $products,
    string $emptyMsg = 'База даних ще порожня. Додайте перший товар.'
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
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['price']); ?></td>
                <td><?php echo htmlspecialchars($row['count']); ?></td>
                <td><?php echo htmlspecialchars(date('d.m.Y', strtotime($row['delivery_data']))); ?></td>
                <td><?php echo htmlspecialchars($row['batch_number']); ?></td>
                <td><?php echo htmlspecialchars($row['responsible_person']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php
}

function renderProductsTable(
    array  $products,
    int    $total,
    string $emptyMsg   = 'База даних ще порожня. Додайте перший товар.',
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
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['price']); ?></td>
                <td><?php echo htmlspecialchars($row['count']); ?></td>
                <td><?php echo htmlspecialchars(date('d.m.Y', strtotime($row['delivery_data']))); ?></td>
                <td><?php echo htmlspecialchars($row['batch_number']); ?></td>
                <td><?php echo htmlspecialchars($row['responsible_person']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php
}