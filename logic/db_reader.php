<?php
require_once __DIR__ . '/db.php';

function readProducts(mysqli $mysqli): array
{
    $products = [];
    $sql = "SELECT name, price, count, delivery_data, batch_number, responsible_person FROM products";
    
    $result = $mysqli->query($sql);
    
    if ($result) {
        while ($row = $result->fetch_assoc()) { 
            $products[] = $row; 
        }
    }
    
    return $products;
}