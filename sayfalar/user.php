<?php
include "inc/sidebar.php";
include "inc/header.php";

$yetkilist = [];

$usernames = htmlspecialchars($_GET["username"]);

$baglan = $db->prepare("SELECT * FROM `31cekusers` WHERE username = :username");
$baglan->bindParam(':username', $usernames);
$baglan->execute();



if ($veri = $baglan->fetch()) {
    $uyeliktip = $veri['rol'];
    $profil = $veri['profil'];
    $durum = $veri['banned'];
    $sorgusayisi = $veri['toplamsorgu'];
} else {
    header("Location: /dashboard");
    exit();
}


$uyeliktipsayi = $uyeliktip;

if ($uyeliktip === 0) {
    $uyeliktip = "Freemium";
    $yetkilist[] = "Kayıtlı üye:warning";
} elseif ($uyeliktip === 1) {
    $uyeliktip = "Premium";
    $yetkilist[] = "Premium:secondary";
} elseif ($uyeliktip === 2) {
    $uyeliktip = "Admin";
    $yetkilist[] = "Admin:primary";
    $yetkilist[] = "Satış yetkilisi:success";
} elseif ($uyeliktip === 3) {
    $uyeliktip = "Kurucu";
    $yetkilist[] = "Kurucu:info";
    $yetkilist[] = "Satış yetkilisi:success";
    $yetkilist[] = "Yönetici:dark";
}
if ($durum === 1) {
    $durum = "Evet";
    $yetkilist[] = "Banlı kullanıcı:danger";
} else {
    $durum = "Hayır";
}

function getnamecolorr($rol) {
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

function getarkaplancolor($rol) {
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

$isimcolor = getnamecolorr($uyeliktipsayi);
$backgroundpic = getarkaplancolor($uyeliktipsayi);
?>


<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <!-- User profile information -->
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <img src="<?= $profil ?>" alt="" style="border-radius: 10px;" width="100px"
                                                height="100px">
                                        </div>
                                        <div class="flex-grow-1 align-self-center">
                                            <div class="text-muted">
                                                <?php
                                                if($durum === "Evet"){
                                                ?>
                                                <h5 style="text-decoration:line-through;"><?= $usernames ?></h5>
                                                <p class="mb-0">Banlı kullanıcı</p>
                                                
                                                <?php
                                                }else{
                                                ?>
                                                <h5 style="background: url('<?= $backgroundpic ?>') center / contain no-repeat; color: <?= $isimcolor ?>; display: inline-block"><?= $usernames ?></h5>
                                                <p class="mb-0"><?= $uyeliktip ?></p>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 align-self-center">
                                    <!-- User stats -->
                                    <div class="text-lg-center mt-4 mt-lg-0">
                                        <div class="row">
                                            <div class="col-4">
                                                <div>
                                                    <p class="text-muted text-truncate mb-2">Sorgu sayısı</p>
                                                    <h5 class="mb-0"><?= $sorgusayisi ?></h5>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div>
                                                    <p class="text-muted text-truncate mb-2">Banlımı</p>
                                                    <h5 class="mb-0"><?= $durum ?></h5>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div>
                                                    <p class="text-muted text-truncate mb-2">Üyelik tipi</p>
                                                    <h5 class="mb-0"><?= $uyeliktip ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Badges -->
                            <div class="row mt-3">
								<div style="justify-content: left; display: flex;" class="col-12">
								<?php

								foreach($yetkilist as $veri){
									$veri = explode(":", $veri);
									$name = $veri[0];
									$color = $veri[1];
								?>
									<a><span class="badge rounded-pill bg-<?= $color ?> float-end"
											key="t-yetki" style="margin-right: 3px;"><?= $name ?></span></a>
								 <?php
								}
								 ?>
								</div>
							</div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
            <div class="mt-4">
                                                            
                       
                                                                <h5 class="font-size-15"><i class="bx bx-message-dots text-muted align-middle me-1"></i> Yorumlar :</h5>
                                                                <hr/>
                                                                <div id="message-container">
                                                            </div>

                                                            <script>
                                                                function getMessages() {
                                                                    $.ajax({
                                                                        url: '/sayfalar/getmessage.php',
                                                                        method: 'POST',
                                                                        headers: {
                                                                            'Content-Type': 'application/x-www-form-urlencoded',
                                                                        },
                                                                        data: { username: '<?= $usernames ?>' },
                                                                        dataType: 'json',
                                                                        success: function(data) {
                                                                            var messageContainer = $('#message-container');
                                                                            messageContainer.empty();

                                                                            $.each(data, function(index, message) {
                                                                                var newMessage = $('<div class="d-flex py-3"> ' +
                                                                                    '<div class="flex-shrink-0 me-3">' +
                                                                                    '<div class="avatar-xs">' +
                                                                                    '<div class="avatar-title rounded-circle bg-light text-primary">' +
                                                                                    '<img src="' + message.profil + '" alt="" class="avatar-md rounded-circle img-thumbnail" style="width: 45px; height:35px;">' +
                                                                                    '</div>' +
                                                                                    '</div>' +
                                                                                    '</div>' +
                                                                                    '<div class="flex-grow-1">' +
                                                                                    '<h5 class="font-size-14 mb-1"><a href="/user?username=' + message.username + '">' + message.username + '</a> <small class="text-muted float-end">' + message.tarih + '</small></h5>' +
                                                                                    '<p class="text-muted">' + message.text + '</p>' +
                                                                                    '</div>' +
                                                                                    '</div>');

                                                                                messageContainer.append(newMessage);
                                                                            });
                                                                        },
                
                                                                    });
                                                                }

                                                                setInterval(getMessages, 500);
                                                            </script>




                                                            </div>
                
                                                            <div class="mt-4">

                
                                                                <form id="sendmessageForm">
                                                               
                                                                    <div class="mb-3">
                                                                        <label for="commentmessage-input" class="form-label">Mesaj:</label>
                                                                        <textarea class="form-control" id="message" name="message" placeholder="Bir mesaj girin..." rows="3"></textarea>
                                                                    </div>
                
                                                                    <div class="text-end">
                                                                    <button type="button" onclick="sendmessage()" class="btn btn-info btn-rounded chat-send w-md waves-effect waves-light"><span class="d-none d-sm-inline-block me-2">Gönder</span> <i class="mdi mdi-send"></i></button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        </div>
                    </div>
   
            </div>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <?php
    include "inc/footer.php";
    ?>
</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->

<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/metismenu/metisMenu.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>

<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Saas dashboard init -->
<script src="assets/js/pages/saas-dashboard.init.js"></script>

<script src="assets/js/app.js"></script>

<script>
function sendmessage() {
    var message = $("#message").val();

    if (message === "") {
        toastr.error('Boş bırakılmaz');
    } else if (["discord", "telegram","@", "http", "ananı", "atanı", "atatürkünü", "bacını", "oc", "aq", "ameke", "salak", "mal", "sg", "aptal", "essek", "oç", "o.c", "amk", "sik", "oruspu"].some(keyword => message.includes(keyword))) {
        toastr.error('Özel karakterler ve url ve küfür yasak!');
    } else {
        $("#message").val('');

        fetch('/sayfalar/eklemessage.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'username=<?= $username ?>&date=<?= date("d.m.Y H:i") ?>&text=' + encodeURIComponent(message) + '&alan=<?= $usernames ?>',
        })
        .then(response => {
            if (response.ok) {
                toastr.success("Mesajınız gönderildi!");
            } else {
                throw new Error("Mesaj gönderilemedi!");
            }
        })

    }
}
</script>



</body>

</html>