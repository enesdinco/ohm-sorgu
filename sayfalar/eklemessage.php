<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "31cekenflashxx";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = htmlspecialchars($_POST["username"]);
        $text = htmlspecialchars($_POST["text"]);
        $tarih = htmlspecialchars($_POST["date"]);
        $alan = htmlspecialchars($_POST["alan"]);

        $sql = "INSERT INTO profilmessage (username, text, tarih, alan) VALUES (:username, :text, :tarih, :alan)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':tarih', $tarih);
        $stmt->bindParam(':alan', $alan);

        $stmt->execute();
    }
} catch (PDOException) {
    echo "Error: ";
}

$conn = null;
?>
