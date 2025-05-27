<?php
include 'server/database.php';

session_start();
$record_username = htmlspecialchars($_SESSION['username']);
$recordsql = "INSERT INTO 31ceklogs (username, type, tarih) VALUES (:username, :type, :tarih)";
$record = $db->prepare($recordsql);
			
$record->bindValue(':username', $record_username);
$record->bindValue(':type', "2");
$record->bindValue(':tarih', date('d/m/Y H:i'));
$record->execute();

session_unset();
session_destroy();

header("Location: /login");
exit();
?>
