<?php
session_start();

function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

$_SESSION['captcha_string'] = generateRandomString();

$imageWidth = 100;
$imageHeight = 40;
$image = imagecreate($imageWidth, $imageHeight);
$bgColor = imagecolorallocate($image, 255, 255, 255);

for ($i = 0; $i < strlen($_SESSION['captcha_string']); $i++) {
    $textColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
    
    imagestring($image, 5, $i * ($imageWidth / strlen($_SESSION['captcha_string'])) + 10, 10, $_SESSION['captcha_string'][$i], $textColor);
}

header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
?>
