<?php
error_reporting(0);

include 'server/database.php';
require_once 'functions.php';

$username = $_SESSION['username'];

$title = "SancakXPanel";

if(!isset($username)){
	header("Location: /login");
	exit();
}

$baglan = $db->prepare("SELECT * FROM `31cekusers` WHERE username = :username");
$baglan->bindParam(':username', $username);
$baglan->execute();

while ($veri = $baglan->fetch()) {
    $uyeliktip = $veri['rol'];
	$profil = $veri['profil'];
	$süres = $veri['bitistarih'];
	$sorgusayisi = $veri['toplamsorgu'];
}

$tarih1 = new DateTime($süres);
$tarih2 = new DateTime();

$süre = $tarih1->diff($tarih2)->days;

$kullanicisayi = $db->query("SELECT
        (SELECT COUNT(*) FROM 31cekusers) AS toplam,
		(SELECT COUNT(*) FROM 31cekusers where banned = 1) AS banlisayisi,
        (SELECT COUNT(*) FROM 31cekusers WHERE rol = 1) AS premiumsayisi"
)->fetch(PDO::FETCH_ASSOC);

$uyeliktipsayi = $uyeliktip;
if($uyeliktip === 0){
	$uyeliktip = "Freemium";
}elseif($uyeliktip === 1){
	$uyeliktip = "Premium";
}elseif($uyeliktip === 2){
	$uyeliktip = "Admin";
}elseif($uyeliktip === 3){
	$uyeliktip = "Kurucu";
}
function getnamecolor($rol) {
    switch ($rol) {
        case 1:
            $color = "#66FF66";
            break;
        case 2:
            $color = "#FF8000";
            break;
        case 3:
            $color = "#00FFFF";
            break;
        default:
            $color = "white";
            break;
    }
    return $color;
}

function getarkaplan($rol) {
    switch ($rol) {
        case 1:
            $background = "https://xenforo.gen.tr/attachments/fire_green-gif.11061/";
            break;
        case 2:
            $background = "https://xenforo.gen.tr/attachments/fire_orange-gif.11057/";
            break;
        case 3:
            $background = "https://xenforo.gen.tr/attachments/fire_blue-gif.11059/";
            break;
        default:
            $background = "";
            break;
    }
    return $background;
}

$isimcolor = getnamecolor($uyeliktipsayi);
$backgroundpic = getarkaplan($uyeliktipsayi);

?>

<!doctype html>
<html lang="en">


<head>
        
        <meta charset="utf-8" />
        <title>Sancak Checker</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
		
		<!-- DataTables -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />  


        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <!-- App js -->
        <script src="assets/js/plugin.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

	<script>
		toastr.options = {
		  "closebutton": false,
		  "debug": false,
		  "newestontop": false,
		  "progressbar": false,
		  "positionclass": "toast-top-right",
		  "preventduplicates": false,
		  "onclick": null,
		  "showduration": "300",
		  "hideduration": "1000",
		  "timeout": "5000",
		  "extendedtimeout": "1000",
		  "showeasing": "swing",
		  "hideeasing": "linear",
		  "showmethod": "fadein",
		  "hidemethod": "fadeout"
		};
	
		
    </script>
	
	

    <body data-sidebar="dark" data-bs-theme="dark">



        <!-- Begin page -->
        <div id="layout-wrapper">

            
           
            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" key="t-menu">Menu</li>

                            <li>
                                <a href="/anasayfa" class="waves-effect">
                                    <i class="bx bx-home"></i>
                                    <span key="t-home">Ana sayfa</span>
                                </a>
                            </li>

                            <li>
                                <a href="/chat" class="waves-effect">
                                    <i class="bx bx-chat"></i>
                                    <span key="t-chat">Sohbet</span>
                                </a>
                            </li>
							<li>
                                <a href="https://t.me/mernis_sorgu_panelim" class="waves-effect">
                                    <i class="bx bxl-telegram"></i>
                                    <span key="t-premium">Telegram</span>
                                </a>
                            </li>
							<li>
                                <a href="/premiumal" class="waves-effect">
                                    <i class="bx bx-store-alt"></i>
                                    <span key="t-premium">Premium satın al</span>
                                </a>
                            </li>
							<?php
							if($uyeliktip === "Kurucu"){
								$panelad = "Yönetici";
							}elseif($uyeliktip === "Admin"){
								$panelad = "Admin";
							}
							?>
							
							<?php
							if($uyeliktip === "Admin" || $uyeliktip === "Kurucu"){
							?>
							<li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
								
                                    <i class="bx bxs-user-detail"></i>
                                    <span key="t-admin"><?= $panelad ?></span>
									
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/kullanici" key="t-kullanıcı">Kullanıcılar</a></li>
									<li><a href="/rol" key="t-rol">Rol değiştir</a></li>
									<?php
									if($uyeliktip === "Kurucu"){
									?>
                                    <li><a href="/bildirim" key="t-bildirim">Bildirimler</a></li>
									<?php
									}
									?>
                                </ul>
                            </li>
							
                          <?php
							}
							?>
                            <li class="menu-title" key="t-database">Kişi</li>

             


                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
								
                                    <i class="bx bx-id-card"></i>
                                    <span key="t-kisi">Kişi</span>
									
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/adsoyad" key="t-adsoyad">Ad Soyad</a></li>
                                    <li><a href="/tcsorgu" key="t-tcsorgu">Tc Sorgu</a></li>
									<li><a href="/aile" key="t-aile">Aile Sorgu</a></li>
                                    <li><a href="/sülale" key="t-sülale">Sülale Sorgu</a></li>
                                </ul>
                            </li>
							
							<li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
								
                                    <i class="bx bx-phone"></i>
                                    <span key="t-gsmcozum">Gsm Çözümleri</span>
									
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/tcgsm" key="t-tcgsm">Tc gsm</a></li>
                                    <li><a href="/gsmtc" key="t-gsmtc">Gsm tc</a></li>
                                </ul>
                            </li>


							
							<li class="menu-title" key="t-egitim">Eğitim</li>

             


                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
								
                                    <i class="bx bxs-school"></i>
                                    <span key="t-eokul">Eokul</span>
									
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/eokulvesika" key="t-eokulvesika">Vesika</a></li>
                                    <li><a href="/eokulnumarası" key="t-eokulnumarası">Okul numarası</a></li>
                                    <li><a href="/belge" key="t-belge">Belge</a></li>
                                    <li><a href="/devamsizlik" key="t-devamsizlik">Devamsızlık</a></li>
                                    <li><a href="/yilsonu" key="t-yilsonu">Yılsonu not</a></li>
                                    <li><a href="/sinavtarih" key="t-sinavt">Sınav Tarihleri</a></li>
                                </ul>
                            </li>

						
							
							<li class="menu-title" key="t-egitim">Gelişmiş çözümler</li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
								
                                    <i class="bx bx-car"></i>
                                    <span key="t-arac">Araç Çözümleri</span>
									
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/tcarac" key="t-tcarac">Tcden araç</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
								
                                    <i class="bx bx-map-pin"></i>
                                    <span key="t-ikametgah">Ikametgah</span>
									
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/adres" key="t-adres">Adres sorgu</a></li>
                                </ul>
                            </li>
							
							<li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
								
                                    <i class="bx bxs-user-detail"></i>
                                    <span key="t-detay">Detaylı kişi işlemleri</span>
									
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/tcpro" key="t-tcpro">Tcpro</a></li>
                                </ul>
                            </li>
							
							<li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
								
                                    <i class="bx bxs-user-detail"></i>
                                    <span key="t-detay">İşyeri (Bakım)</span>
									
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/isyeri" key="t-isyeri">İşyeri sorgu (Bakım)</a></li>
                                    <li><a href="/yisyeri" key="t-aisyeri">İşyeri Yetkili sorgu (Bakım)</a></li>
                                    <li><a href="/aisyeri" key="t-aisyeri">İşyeri Arkadaşı sorgu (Bakım)</a></li>
                                </ul>
                            </li>
							
							<li class="menu-title" key="t-egitim">Sağlık</li>

             


                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
								
                                    <i class="fas fa-syringe"></i>
                                    <span key="t-saglik">Sağlık</span>
									
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/ilac" key="t-ilac">İlaç sorgu</a></li>
                                    <li><a href="/muayene" key="t-muayene">Muayene sorgu</a></li>
                                </ul>
                            </li>
							
							
                           

                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
			<div id="preloader">
            <div id="status">
                <div class="spinner-chase">
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                </div>
            </div>
        </div>