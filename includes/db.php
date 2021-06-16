<?php
$dbHost = "";
$dbNAme = "";
$dbUsername = '';
$dbPassword = '';

if ($_ENV['APP_ENV'] === "dev") {
    global $dbHost, $dbNAme, $dbUsername, $dbPassword;
    $dbHost = "localhost";
    $dbNAme = "marketexchange";
    $dbUsername = 'root';
    $dbPassword = '';
}
if ($_ENV['APP_ENV'] === "prod") {
    global $dbHost, $dbNAme, $dbUsername, $dbPassword;
    $dbHost = "localhost";
    $dbNAme = $_ENV['DATABASE_NAME'];
    $dbUsername = $_ENV['DATABASE_USERNAME'];
    $dbPassword = $_ENV['DATABASE_PASSWORD'];
}
try {
    $pdo = new PDO('mysql:host=' . $dbHost . ';dbname=' . $dbNAme . ';charset=utf8', $dbUsername, $dbPassword);
} catch (PDOException $e) {
    die('Connection Error: ' . $e->getMessage());
}
