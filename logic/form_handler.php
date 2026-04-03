<?php
require_once __DIR__ . '/db_writer.php';

function handleProductForm(mysqli $mysqli): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }

    // Створюємо асоціативний масив (словник)
    $productData = [
        'name'               => $_POST['name'],
        'price'              => $_POST['price'],
        'count'              => $_POST['quantity'],
        'delivery_data'      => $_POST['date'],
        'batch_number'       => $_POST['batch'],
        'responsible_person' => $_POST['person'],
    ];

    writeProduct($mysqli, $productData);

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}