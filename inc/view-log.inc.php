<?php
$file = __DIR__ . "/../" . PATH_LOG;

if (file_exists($file)) {
    $lines = file($file);
    echo "<ul>";
    foreach ($lines as $line) {
        list($dt, $page, $ref) = explode("|", trim($line));
        $date = date("d-m-Y H:i:s", $dt);
        echo "<li>$date - $page -> $ref</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Журнал пока пуст.</p>";
}
?>
