<?php

function sortProductsByPrice(array $products): array
{
    usort($products, function (array $a, array $b): int {
        return (float)$a[1] <=> (float)$b[1];
    });

    return $products;
}


function countProducts(array $products): int
{
    return count($products);
}


function filterProductsByPerson(array $products, string $searchQuery): array
{
    if ($searchQuery === '') {
        return $products;
    }

    return array_values(array_filter($products, function (array $row) use ($searchQuery): bool {
        return mb_stripos($row[5], $searchQuery) !== false;
    }));
}