<?php
if (file_exists($filename)) {
    $file = fopen($filename, 'r');
    if ($file) {
        while (($data = fgetcsv($file, 1000, ',')) !== false) {
            echo "<tr>";
            foreach ($data as $cell) {
                echo "<td>" . $cell . "</td>";
            }
            echo "</tr>";
        }
        fclose($file);
    }
} else {
    echo "<tr><td colspan='6'>Файл бази даних ще порожній. Додайте перший товар.</td></tr>";
}
