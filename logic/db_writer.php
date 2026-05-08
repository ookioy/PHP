<?php
require_once __DIR__ . '/db.php';

function writeProduct(mysqli $mysqli, array $data): bool
{
    $personName = trim($data['responsible_person']);

    $stmt = $mysqli->prepare("SELECT id FROM persons WHERE name = ?");
    $stmt->bind_param("s", $personName);
    $stmt->execute();
    $result   = $stmt->get_result();
    $personId = $result->fetch_row()[0] ?? null;
    $stmt->close();

    if ($personId === null) {
        $stmt = $mysqli->prepare("INSERT INTO persons (name) VALUES (?)");
        $stmt->bind_param("s", $personName);
        $stmt->execute();
        $personId = $mysqli->insert_id;
        $stmt->close();
    }

    $batchNumber  = trim($data['batch_number']);
    $deliveryDate = $data['delivery_data'];

    $stmt = $mysqli->prepare("SELECT id FROM batches WHERE batch_number = ?");
    $stmt->bind_param("s", $batchNumber);
    $stmt->execute();
    $result  = $stmt->get_result();
    $batchId = $result->fetch_row()[0] ?? null;
    $stmt->close();

    if ($batchId === null) {
        $stmt = $mysqli->prepare(
            "INSERT INTO batches (batch_number, delivery_date, person_id) VALUES (?, ?, ?)"
        );
        $stmt->bind_param("ssi", $batchNumber, $deliveryDate, $personId);
        $stmt->execute();
        $batchId = $mysqli->insert_id;
        $stmt->close();
    }

    $stmt = $mysqli->prepare(
        "INSERT INTO products (name, price, count, batch_id) VALUES (?, ?, ?, ?)"
    );
    $count = (int)$data['count'];
    $stmt->bind_param("sdii", $data['name'], $data['price'], $count, $batchId);
    $success = $stmt->execute();
    $stmt->close();

    return $success;
}