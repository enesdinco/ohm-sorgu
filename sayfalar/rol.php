<?php
include "inc/sidebar.php";
include "inc/header.php";
use flash\System;
if ($uyeliktip !== "Kurucu" && $uyeliktip !== "Admin") {
    echo '<meta http-equiv="refresh" content="0;url=/dashboard">';
    exit;
}
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
						 <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">Rol değiştir</h4>
                                        <p class="card-title-desc">Buradan kullanıcı rolünü değiştirebilirsiniz</p>    
                                        <?php
										if (isset($_POST["degistir"])) {
											$username = System::filter(urlencode($_POST["username"]));
											$rol = System::filter(urlencode($_POST["rol"]));
											$keysure = System::filter(urlencode($_POST["keysure"]));

											if (empty($username)) {
												echo '<script>toastr.error("Kullanıcı adı gir!");</script>';
											} elseif (new DateTime($keysure) <= new DateTime()) {
												echo '<script>toastr.error("Key süresini düzgün seç!");</script>';
											} else {
												$db = new PDO("mysql:host=localhost;dbname=31cekenflashxx", "root", "");
												$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

												roldegis($db, $username, $rol, $keysure);
											}
										}

										function roldegis($db, $username, $rol, $keysure) {
											try {
												$selectUserStmt = $db->prepare("SELECT * FROM `31cekusers` WHERE `username` = :username");
												$selectUserStmt->bindParam(':username', $username, PDO::PARAM_STR);
												$selectUserStmt->execute();
												$user = $selectUserStmt->fetch(PDO::FETCH_ASSOC);
												
												if ($user['rol'] == $rol) {
													echo '<script>toastr.error("Kullanıcının rolü zaten bu!");</script>';
												}else{
													if ($user) {
														$updateStmt = $db->prepare("UPDATE `31cekusers` SET `rol` = :rol, `bitistarih` = :keysure WHERE `username` = :username");
														$updateStmt->bindParam(':username', $username, PDO::PARAM_STR);
														$updateStmt->bindParam(':rol', $rol, PDO::PARAM_INT);
														$updateStmt->bindParam(':keysure', $keysure, PDO::PARAM_STR);
														$updateStmt->execute();

														echo '<script>toastr.success("Rol değiştirildi!");</script>';
													} elseif (!$user) {
														echo '<script>toastr.error("Kullanıcı bulunamadı!");</script>';
													}

												}
											} catch (PDOException $e) {
												echo '<script>toastr.error("Hata oluştu");</script>';
											}
										}
?>


										
										<form action="" method="post">
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="username" class="form-control" name="username"
                                                placeholder="Kullanici adı" aria-label="username"
                                                aria-describedby="username-addon">
											
                                        </div>
										<div class="mt-3 d-grid">
										<label for="keysure">Key bitiş tarihi:</label>
										<input style="font-size: 11px; background: none; border: 1px solid #353D55;" type="date" id="keysure" name="keysure">
										
										</div>
										<div class="mt-3 d-grid">
										<label for="rol">Rol:</label>
										<select style="font-size: 11px; background-color: #2A3042; border: 1px solid #353D55;" id="rol" name="rol">
											<option value="0">Freemium</option>
											<option value="1">Premium</option>
											<?php
											if ($uyeliktip === "Kurucu") {
											?>
											<option value="2">Admin</option>
											<?php
											}
											?>
										</select>
                                               
                                            </div>
											
										<div class="mt-3 d-grid">
    <button class="btn btn-primary waves-effect waves-light" type="submit" id="degistir" name="degistir" style="font-size: 11px; width: 100px; height: 35px;">
	<i style="color: white;" class="bx bx-revision font-size-10"></i>
	Değiştir
    </button>
			
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

<script>

$(document).ready(function () {
    toastr.options = {
        "positionClass": "toast-top-right",
        "progressBar": true,
        "preventDuplicates": true,
        "timeOut": "5000",
    };
});
</script>



        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- apexcharts -->
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
		<script src="assets/libs/toastr/build/toastr.min.js"></script>
        
        <!-- Saas dashboard init -->
        <script src="assets/js/pages/saas-dashboard.init.js"></script>

        <script src="assets/js/app.js"></script>
		<script src="assets/js/pages/toastr.init.js"></script>

    </body>

</html>
