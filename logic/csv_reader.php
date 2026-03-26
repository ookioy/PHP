<?php

function readProducts(string $filename): array
{
    $products = [];

    if (!file_exists($filename)) {
        return $products;
    }

    $file = fopen($filename, 'r');
    if (!$file) {
        return $products;
    }

    while (($data = fgetcsv($file, 1000, ',')) !== false) {
        if (count($data) >= 6) {
            $products[] = $data;
        }
    }

    fclose($file);
    return $products;
}