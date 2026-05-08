<?php

function readProductsSorted(mysqli $mysqli, string $searchQuery = ''): array
{
    $products = [];

    if ($searchQuery !== '') {
        $stmt = $mysqli->prepare(
            "SELECT p.name, p.price, p.count,
                    b.delivery_date AS delivery_data,
                    b.batch_number,
                    pr.name         AS responsible_person
             FROM products p
             JOIN batches  b  ON p.batch_id  = b.id
             JOIN persons  pr ON b.person_id = pr.id
             WHERE pr.name LIKE ?
             ORDER BY p.price ASC"
        );
        $like = '%' . $searchQuery . '%';
        $stmt->bind_param('s', $like);
        $stmt->execute();
        $stmt->bind_result($name, $price, $count, $delivery_data, $batch_number, $responsible_person);

        while ($stmt->fetch()) {
            $products[] = [
                'name'               => $name,
                'price'              => $price,
                'count'              => $count,
                'delivery_data'      => $delivery_data,
                'batch_number'       => $batch_number,
                'responsible_person' => $responsible_person,
            ];
        }

        $stmt->close();
    } else {
        $result = $mysqli->query(
            "SELECT p.name, p.price, p.count,
                    b.delivery_date AS delivery_data,
                    b.batch_number,
                    pr.name         AS responsible_person
             FROM products p
             JOIN batches  b  ON p.batch_id  = b.id
             JOIN persons  pr ON b.person_id = pr.id
             ORDER BY p.price ASC"
        );

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
    }

    return $products;
}