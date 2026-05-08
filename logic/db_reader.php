<?php
require_once __DIR__ . '/db.php';

/**
 * Читає всі товари через VIEW v_products.
 * Повертає масив рядків із тими самими ключами, що й раніше —
 * решта коду (render_helpers, products_sort) не потребує змін.
 */
function readProducts(mysqli $mysqli): array
{
    $products = [];
    $sql = "SELECT name, price, count, delivery_data, batch_number, responsible_person
            FROM v_products
            ORDER BY id";

    $result = $mysqli->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    return $products;
}

/**
 * Повертає список унікальних партій (для форм вибору / ЛР5+).
 */
function readBatches(mysqli $mysqli): array
{
    $batches = [];
    $sql = "SELECT b.id, b.batch_number, b.delivery_date, p.name AS responsible_person
            FROM batches b
            JOIN persons p ON b.person_id = p.id
            ORDER BY b.delivery_date DESC";

    $result = $mysqli->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $batches[] = $row;
        }
    }

    return $batches;
}

/**
 * Повертає список відповідальних осіб (для форм вибору).
 */
function readPersons(mysqli $mysqli): array
{
    $persons = [];
    $result  = $mysqli->query("SELECT id, name FROM persons ORDER BY name");

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $persons[] = $row;
        }
    }

    return $persons;
}