<?php

function writeProduct(string $filename, array $record): bool
{
    $file = fopen($filename, 'a');
    if (!$file) {
        return false;
    }

    fputcsv($file, $record);
    fclose($file);
    return true;
}