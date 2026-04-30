<?php
function readProductsSorted(mysqli $mysqli, string $searchQuery = ''): array
{
    $products = [];

    if ($searchQuery !== '') {
        $stmt = $mysqli->prepare(
            "SELECT name, price, count, delivery_data, batch_number, responsible_person
             FROM products
             WHERE responsible_person LIKE ?
             ORDER BY price ASC"
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
        return $products;
    } else {
        $result = $mysqli->query(
            "SELECT name, price, count, delivery_data, batch_number, responsible_person
             FROM products
             ORDER BY price ASC"
        );
    }

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    return $products;
}