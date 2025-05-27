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
                                    <div class="card-body">
                                        <h4 class="card-title">Kullanıcı ekle</h4>
                                        <p class="card-title-desc">Buradan kullanıcı oluşturabilirsiniz</p>    
                                        <?php
										if (isset($_POST["olustur"])) {
											$username = System::filter($_POST["username"]);
											$rol = System::filter($_POST["rol"]);
											$sure = System::filter($_POST["keysure"]);
											
											if (empty($username)) {
												echo '<script>toastr.error("Kullanıcı adı gir!");</script>';
											}elseif(new DateTime($sure) <= new DateTime()){
												echo '<script>toastr.error("Key süresini düzgün seç!");</script>';
											} else {
												function adduser($username, $key, $rol, $sure, $db)
												{
													try {
														$kontroletkullanıcı = $db->prepare("SELECT COUNT(*) FROM `31cekusers` WHERE `username` = :username");
														$kontroletkullanıcı->bindParam(':username', $username, PDO::PARAM_STR);
														$kontroletkullanıcı->execute();
														$user = $kontroletkullanıcı->fetchColumn();

														if ($user > 0) {
															echo '<script>toastr.error("Bu kullanıcı adı zaten mevcut!");</script>';
														} else {
															$insertStmt = $db->prepare("INSERT INTO `31cekusers` (`username`, `kkey`, `rol`, `profil`, `banned`, `bitistarih`, `toplamsorgu`) 
																					 VALUES (:username, :key, :rol, :profil, :durum, :sure, :toplamsorgu)");
															
															$profil = "data:image/jpeg;base64,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";
															$insertStmt->bindParam(':username', $username, PDO::PARAM_STR);
															$insertStmt->bindParam(':key', base64_encode($key), PDO::PARAM_STR);
															$insertStmt->bindParam(':rol', $rol, PDO::PARAM_STR);
															$insertStmt->bindParam(':profil', $profil, PDO::PARAM_STR);
															$insertStmt->bindValue(':durum', 0, PDO::PARAM_INT);
															$insertStmt->bindParam(':sure', $sure, PDO::PARAM_STR);
															$insertStmt->bindValue(':toplamsorgu', 0, PDO::PARAM_INT);
															$insertStmt->execute();

															echo '<div class="alert alert-success" role="alert"><strong>Başarılı!</strong> Anahtar: ' . $key . ' Kullanıcı Adı: ' . $username . '</div>';
														}
													} catch (PDOException $error) {
														echo "Hata: " . $error->getMessage();
													}
												}


												function generateRandomKey()
												{
													$characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
													$key = "sancak-";
													for ($i = 0; $i < 7; $i++) {
														$key .= $characters[rand(0, strlen($characters) - 1)];
													}
													return $key;
												}

												$key = generateRandomKey();
												adduser($username, $key, $rol, $sure, $db);
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
    <button class="btn btn-primary waves-effect waves-light" type="submit" id="olustur" name="olustur" style="font-size: 11px; width: 100px; height: 35px;">
	<i style="color: white;" class="bx bx-add-to-queue font-size-10"></i>
	Oluştur
    </button>
			
</div>
</form>

                                    </div>
        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Kullanıcılar</h4>
                                        <p class="card-title-desc">Buradan kullanıcıları görebilir düzenliyebilirsiniz</p>    
                                        
                                        <div class="table-responsive">
                                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
    <thead class="table-light">
        <tr>
            <th>id</th>
            <th>Username</th>
            <th>Key</th>
            <th>Rol</th>
            <th>Profil</th>
            <th>Durum</th>
            <th>Bitiş tarihi</th>
			<?php
			if ($uyeliktip === "Kurucu") {
			?>
            <th>İşlem</th>
			<?php
			}	
			?>
        </tr>
    </thead>
    <tbody>
        <?php
        $baglan = $db->query("SELECT * FROM `31cekusers`");

        while ($veri = $baglan->fetch()) {
			$key = base64_decode($veri['kkey']);
            if ($veri["rol"] === 0) {
                $rol = "Freemium";
            } elseif ($veri["rol"] === 1) {
                $rol = "Premium";
            } elseif ($veri["rol"] === 2) {
                $rol = "Admin";
            } elseif ($veri["rol"] === 3) {
                $rol = "Kurucu";
				$key = System::sansür($key);
            }
			
	
            if ($veri["banned"] === 0) {
                $durum = "Banlı değil";
                $durumicon = "bx bx-block";
                $durumcolor = "red";
            } elseif ($veri["banned"] === 1) {
                $durum = "Banlı";
                $durumicon = "bx bx-block";
                $durumcolor = "green";
            }

        ?>
            <tr>
                <td><?= $veri['id'] ?></td>
                <td><?= $veri['username'] ?></td>
                <td><?= $key ?></td>
                <td><?= $rol ?></td>
                <td><img class="rounded-circle header-profile-user" src="<?= $veri["profil"] ?>" /></td>
                <td><?= $durum ?></td>
                <td><?= $veri['bitistarih'] ?></td>
				<?php
				if ($uyeliktip === "Kurucu") {
				?>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $veri['id'] ?>">
                        <input type="hidden" name="durum" value="<?= $veri['banned'] ?>">
                        <button style="background: none; border: 1px;" type="submit" name="engelle">
                            <i style="color: <?= $durumcolor ?>;" class="<?= $durumicon ?> font-size-20"></i>
                        </button>

                        <button style="background: none; border: 1px;" type="submit" name="sil">
                            <i style="color: red;" class="bx bx-x font-size-20"></i>
                        </button>
                    </form>
                </td>
				<?php
				}
				?>
            </tr>
        <?php
        }

        if (isset($_POST["engelle"])) {
            $id = System::filter(urlencode($_POST["id"]));
            $durum = System::filter(urlencode($_POST["durum"]));

            if ($durum === '0') {
                echo '<script>toastr.success("Kullanıcı başarıyla banlandı!");</script>';
                $sql = "UPDATE 31cekusers SET banned = '1' WHERE id = :id";
            } elseif ($durum === '1') {
                echo '<script>toastr.success("Kullanıcının banı kaldırıldı!");</script>';
                $sql = "UPDATE 31cekusers SET banned = '0' WHERE id = :id";
            }

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }

        if (isset($_POST["sil"])) {
            $id = System::filter(urlencode($_POST["id"]));

            echo '<script>toastr.success("Kullanıcı başarıyla silindi!");</script>';
            $sql = "DELETE FROM 31cekusers WHERE id = :id";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }
        ?>
    </tbody>
</table>

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
		<!-- Required datatable js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
		
        <!-- apexcharts -->
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
		<script src="assets/libs/toastr/build/toastr.min.js"></script>
        
		<!-- Responsive examples -->
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/js/pages/datatables.init.js"></script>  
		
        <!-- Saas dashboard init -->
        <script src="assets/js/pages/saas-dashboard.init.js"></script>

        <script src="assets/js/app.js"></script>
		<script src="assets/js/pages/toastr.init.js"></script>


    </body>

</html>
