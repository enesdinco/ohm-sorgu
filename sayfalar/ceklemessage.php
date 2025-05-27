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

        $sql = "INSERT INTO 31cekchat (username, text, tarih) VALUES (:username, :text, :tarih)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':tarih', $tarih);

        $stmt->execute();
    }
} catch (PDOException) {
    echo "Error: ";
}

$conn = null;
?>
