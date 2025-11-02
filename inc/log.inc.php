<?php

$dt = time();


$page = $_SERVER['REQUEST_URI'];


$ref = $_SERVER['HTTP_REFERER'] ?? '';


$path = $dt . "|" . $page . "|" . $ref . "\n";


$file = __DIR__ . "/../" . PATH_LOG;


file_put_contents($file, $path, FILE_APPEND);
?>
