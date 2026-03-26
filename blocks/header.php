<?php
$title = $pageTitle ?? 'Головна сторінка'; 
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <h1><?php echo htmlspecialchars($title); ?></h1>
    </header>

    <nav>
        <ul>
            <li><a href="LB_1.php">Лабораторна 1</a></li>
            <li><a href="LB_2.php">Лабораторна 2</a></li>
            <li><a href="LB_3.php">Лабораторна 3</a></li>
            <li><a href="LB_4.php">Лабораторна 4</a></li>
            <li><a href="#">Лабораторна 5</a></li>
            <li><a href="#">Лабораторна 6</a></li>
            <li><a href="#">Лабораторна 7</a></li>
            <li><a href="#">Лабораторна 8</a></li>
            <li><a href="#">Лабораторна 9</a></li>
        </ul>
    </nav>
