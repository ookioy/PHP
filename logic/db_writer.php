<?php
require_once __DIR__ . '/db.php';

function writeProduct(mysqli $mysqli, array $data): bool
{
    $stmt = $mysqli->prepare("INSERT INTO products (name, price, count, delivery_data, batch_number, responsible_person) VALUES (?, ?, ?, ?, ?, ?)");
    
    // Використовуємо ключі словника замість індексів
    $stmt->bind_param("sdisss", 
        $data['name'],
        $data['price'],
        $data['count'],
        $data['delivery_data'],
        $data['batch_number'],
        $data['responsible_person']
    );

    $success = $stmt->execute();
    $stmt->close();
    
    return $success;
}