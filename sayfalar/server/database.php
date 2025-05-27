<?php

error_reporting(0);

session_start();

date_default_timezone_set('Europe/Istanbul');

$userAgent = $_SERVER['HTTP_USER_AGENT'];
if (empty($userAgent)) {
    exit;
}

$serverName = "localhost";
$username = "root";
$password = "";
$dbName = "31cekenflashxx";

try {
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $db = new PDO("mysql:host=$serverName;dbname=$dbName;charset=utf8mb4", $username, $password, $options);
} catch (PDOException $ex) {
    echo "Database bağlanırken bir hata oluştu";
    exit;
}
?>
