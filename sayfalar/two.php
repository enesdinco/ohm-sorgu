<?php
include "server/database.php";

session_start();

?>

<!doctype html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Flash x 2 aşamalı</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
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
</head>

<body data-bs-theme="dark">
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <!-- end row -->
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">

                        <div class="card-body">

                            <div class="p-2">
                                <div class="text-center">

                                    <div class="avatar-md mx-auto">
                                        <div class="avatar-title rounded-circle bg-light">
                                            <i class="bx bxl-telegram h1 mb-0 text-info"></i>
                                        </div>
                                    </div>
                                    <div class="p-2 zmt-4">
									<h4>Hesabınızı doğrulayın</h4>
                                        <p class="mb-5">Telegram hesabınıza gelen kodu giriniz.</p>

                                        <form>
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit1-input" class="visually-hidden">Sayi 1</label>
                                                        <input type="text"
                                                            class="form-control form-control-lg text-center two-step"
                                                            maxLength="1"
                                                            data-value="1"
                                                            id="digit1-input">
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit2-input" class="visually-hidden">Sayi 2</label>
                                                        <input type="text"
                                                            class="form-control form-control-lg text-center two-step"
                                                            maxLength="1"
                                                            data-value="2"
                                                            id="digit2-input">
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit3-input" class="visually-hidden">Sayi 3</label>
                                                        <input type="text"
                                                            class="form-control form-control-lg text-center two-step"
                                                            maxLength="1"
                                                            data-value="3"
                                                            id="digit3-input">
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit4-input" class="visually-hidden">Sayi 4</label>
                                                        <input type="text"
                                                            class="form-control form-control-lg text-center two-step"
                                                            maxLength="1"
                                                            data-value="4"
                                                            id="digit4-input">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <div class="mt-4">
                                            <a href="index-2.html" class="btn btn-primary w-md">Onayla</a>
                                        </div>
										<div class="mt-5 text-center">
											<p>Kod gelmedimi ? <a href="#" class="fw-medium text-info"> Tekrar gönder </a> </p>
										</div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                

                </div>
            </div>
        </div>
    </div>
    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <!-- two-step-verification js -->
    <script src="assets/js/pages/two-step-verification.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>


</html>