<?php

include "server/database.php";

$messages = [];
$usernames = htmlspecialchars($_POST["username"]);

$baglan = $db->prepare("SELECT * FROM `profilmessage` WHERE alan = :username ORDER BY tarih ASC LIMIT 6");
$baglan->bindParam(':username', $usernames);
$baglan->execute();

while ($veri = $baglan->fetch()) {
    $tarih = $veri["tarih"];

    $dateTime = DateTime::createFromFormat('d.m.Y H:i', $tarih);

    $now = new DateTime();

    $diff = $now->diff($dateTime);

    if ($diff->d == 0) {
        if ($diff->h >= 1) {
            $tarih = $diff->h . ' saat önce';
        } elseif ($diff->i >= 1) {
            $tarih = $diff->i . ' dakika önce';
        } else {
            $tarih = 'şimdi';
        }
    } elseif ($diff->d == 1) {
        $tarih = '1 gün önce';
    } elseif ($diff->d == 2) {
        $tarih = '2 gün önce';
    } else {
        $tarih = $dateTime->format('d M H:i');
    }

    $baglanUser = $db->prepare("SELECT * FROM `31cekusers` WHERE username = :username");
    $baglanUser->bindParam(':username', $veri["username"]);
    $baglanUser->execute();

    while ($veriUser = $baglanUser->fetch()) {
        $profil = $veriUser['profil'];
    }

    $messages[] = [
        "username" => $veri["username"],
        "profil" => $profil,
        "text" => $veri["text"],
        "tarih" => $tarih,
        "alan" => $veri["alan"]
    ];
}

header('Content-Type: application/json');
echo json_encode($messages);
?>
