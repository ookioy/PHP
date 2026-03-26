<?php
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
