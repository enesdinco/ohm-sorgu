<?php
error_reporting(0);

include "server/database.php";

session_start();

if (isset($_SESSION['username'])) {
    header("Location: /anasayfa");
    exit();
}

$hata = false;
$type = "";
$message = "";
$gif = "assets/images/eze.png";

if (isset($_POST['giris'])) {
    $key = htmlspecialchars(base64_encode($_POST['key']));

    if (empty($key)) {
        $hata = true;
        $type = "danger";
        $message = "Key boş bırakılamaz!";
    } else {
        $stmt = $db->prepare("SELECT * FROM 31cekusers WHERE kkey = :key");
        $stmt->bindParam(':key', $key);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($user)) {
            $hata = true;
            $type = "danger";
            $message = "Girdiğiniz anahtar yanlış!";
			$gif = "https://media.tenor.com/1tiw8R6eitkAAAAi/orangutan-orang.gif";
        } elseif ($user['banned'] == "1") {
            $hata = true;
            $type = "danger";
            $message = "Hesabınız yasaklanmış!";
			$gif = "https://media.tenor.com/CnJXNjoDdQwAAAAi/orangutan-telegram-orangutan.gif";
        } elseif (new DateTime($user['bitistarih']) <= new DateTime()) {
            $hata = true;
            $type = "danger";
            $message = "Hesabınızın süresi dolmuş!";
			$gif = "https://media.tenor.com/0CZI7rh4O0QAAAAi/orangutan-telegram-orangutan.gif";
        } else {
			$record_username = $user['username'];
			$recordsql = "INSERT INTO 31ceklogs (username, type, tarih) VALUES (:username, :type, :tarih)";
			$record = $db->prepare($recordsql);
			
			$record->bindValue(':username', $record_username);
			$record->bindValue(':type', "1");
			$record->bindValue(':tarih', date('d/m/Y H:i'));
			$record->execute();
            $_SESSION['username'] = $record_username;
            session_write_close();
            header("Location: /anasayfa");
            exit;
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <style>
	body {
      margin: 0;
      overflow: hidden;
     
    }

    .snowflake {
      position: absolute;
      font-size: 2em;
      color: #fff;
      pointer-events: none;
      user-select: none;
      animation: fall linear infinite;
    }

    @keyframes fall {
      to {
        transform: translateY(100vh);
      }
    }
    


  </style>
 
<head>
    <meta charset="utf-8" />
    <title>SancakXlogin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- App js -->
    <script src="assets/js/plugin.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

</head>

<body data-bs-theme="dark">
    <div class="account-pages my-5 pt-sm-5">
	
        <div class="container">
		
            <div class="row justify-content-center">
			
                <div class="col-md-8 col-lg-6 col-xl-5">
				
                    <div class="card overflow-hidden">
					
                        <div class="bg-primary-subtle">
						
                            <div class="row">
							
                                <div class="col-7">
								
                                    <div class="text-primary p-4">
									
                                        <h5 class="text-primary">Hoş geldin!</h5>
                                        <p>Size verilen anahtarı girin.</p>
                                    </div>
                                </div>
								
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="auth-logo">
                                <a  class="auth-logo-light">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="<?= $gif ?>" id="maymun-image" alt="" class="rounded-circle" height="50">
                                        </span>
                                    </div>
                                </a>
								

                                <a href="index-2.html" class="auth-logo-dark">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="assets/images/logo.svg" alt="" class="rounded-circle" height="34">
                                        </span>
                                    </div>
                                </a>
                            </div>
							
                            <div class="p-2">
                                <form class="form-horizontal" action="" method="post">
                                    <div class="mb-3">
                                        <label class="form-label">Key</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" id="key" name="key"
                                                placeholder="Key gir" aria-label="Password"
                                                aria-describedby="password-addon">
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember-check">
                                        <label class="form-check-label" for="remember-check">
                                            Beni hatırla
                                        </label>
                                    </div>

                                    <div class="mt-3 d-grid">
                                        <button class="btn btn-primary waves-effect waves-light" name="giris"
										
                                            type="submit">Giriş</button>
                                    </div>

                                    <div class="mt-5 text-center">
                                        <div>Hesabın yok mu? <a href="https://t.me/mernis_sorgu_panelim"
                                                class="fw-medium text-primary"> Kayıt ol </a> </p>
                                    </div>
<?php if ($hata == true) : ?>
                                    <div class="alert alert-<?= $type ?>" role="alert">
                                        <?= $message ?>
                                    </div>
                                    <?php endif; ?>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const container = document.body;
      const numberOfSnowflakes = 50;

      for (let i = 0; i < numberOfSnowflakes; i++) {
        createSnowflake();
      }

      function createSnowflake() {
        const snowflake = document.createElement("div");
        snowflake.className = "snowflake";
        snowflake.innerHTML = "❄"; 
        snowflake.style.left = `${Math.random() * 100}vw`;
        snowflake.style.top = "0";
        snowflake.style.animationDuration = `${Math.random() * 2 + 1}s`;
        container.appendChild(snowflake);

        snowflake.addEventListener("animationiteration", () => {
          snowflake.style.left = `${Math.random() * 100}vw`;
        });
      }
    });

  </script>
    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
	<script src="assets/libs/toastr/build/toastr.min.js"></script>
    <!-- App js -->

    <script src="assets/js/app.js"></script>
	<script src="assets/js/pages/toastr.init.js"></script>
</body>

</html>
