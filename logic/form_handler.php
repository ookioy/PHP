<?php

require_once __DIR__ . '/csv_writer.php';


function handleProductForm(string $filename): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }

    $record = [
        $_POST['name']     ?? '',
        $_POST['price']    ?? '',
        $_POST['quantity'] ?? '',
        $_POST['date']     ?? '',
        $_POST['batch']    ?? '',
        $_POST['person']   ?? '',
    ];

    writeProduct($filename, $record);

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}