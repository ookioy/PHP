<?php
require_once __DIR__ . '/db_writer.php';

function handleProductForm(mysqli $mysqli): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }

    $productData = [
        'name'               => trim($_POST['name']        ?? ''),
        'price'              => $_POST['price']             ?? 0,
        'count'              => $_POST['quantity']          ?? 0,
        'delivery_data'      => $_POST['date']              ?? '',
        'batch_number'       => trim($_POST['batch']        ?? ''),
        'responsible_person' => trim($_POST['person']       ?? ''),
    ];

    if ($productData['name'] === '' || $productData['batch_number'] === '' || $productData['responsible_person'] === '') {
        return;
    }

    writeProduct($mysqli, $productData);

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}