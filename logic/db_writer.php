<?php
require_once __DIR__ . '/db.php';

/**
 * Записує товар у нормалізовану БД.
 * Якщо особа або партія ще не існує — створює їх.
 *
 * @param mysqli $mysqli
 * @param array  $data  Ключі: name, price, count, delivery_data, batch_number, responsible_person
 * @return bool
 */
function writeProduct(mysqli $mysqli, array $data): bool
{
    // ── 1. Отримати або створити особу ──────────────────────────
    $personName = trim($data['responsible_person']);

    $stmt = $mysqli->prepare("SELECT id FROM persons WHERE name = ?");
    $stmt->bind_param("s", $personName);
    $stmt->execute();
    $result = $stmt->get_result();
    $personId = $result->fetch_row()[0] ?? null;
    $stmt->close();

    if ($personId === null) {
        $stmt = $mysqli->prepare("INSERT INTO persons (name) VALUES (?)");
        $stmt->bind_param("s", $personName);
        $stmt->execute();
        $personId = $mysqli->insert_id;
        $stmt->close();
    }

    // ── 2. Отримати або створити партію ──────────────────────────
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

    // ── 3. Вставити товар ────────────────────────────────────────
    $stmt = $mysqli->prepare(
        "INSERT INTO products (name, price, count, batch_id) VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("sdii", $data['name'], $data['price'], $data['count'], $batchId);
    $success = $stmt->execute();
    $stmt->close();

    return $success;
}