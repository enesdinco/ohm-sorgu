<?php
include "inc/sidebar.php";
include "inc/header.php";
use flash\System;
if ($uyeliktip !== "Kurucu") {
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
                                        <h4 class="card-title">Bildirim yolla</h4>
                                        <p class="card-title-desc">Buradan bildirim yollayabilirsiniz</p>    
                                        <?php
										if (isset($_POST["gönder"])) {
											$baslik = System::filter($_POST["baslik"]);
											$aciklama = System::filter($_POST["aciklama"]);
											
											if (empty($baslik)) {
												echo '<script>toastr.error("Başlık gir!");</script>';
											} elseif (empty($aciklama)) {
												echo '<script>toastr.error("Açıklama gir!");</script>';
											} else {
												$db = new PDO("mysql:host=localhost;dbname=31cekenflashxx", "root", "");
												$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

												bildirimekle($db, $baslik, $aciklama);
											}
										}

										function bildirimekle($db, $baslik, $aciklama) {
											try {
												$insertStmt = $db->prepare("INSERT INTO `31cekbildirimler` (`baslik`, `aciklama`) VALUES (:baslik, :aciklama)");

												$insertStmt->bindParam(':baslik', $baslik, PDO::PARAM_STR);
												$insertStmt->bindParam(':aciklama', $aciklama, PDO::PARAM_STR);
												$insertStmt->execute();


												echo '<script>toastr.error("Gönderildi!");</script>';
											} catch (PDOException $e) {
												echo '<script>toastr.error("Hata oluştu");</script>';
											}
										}
										?>

										
										<form action="" method="post">
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="baslik" class="form-control" name="baslik"
                                                placeholder="Başlık" aria-label="baslik"
                                                aria-describedby="baslik-addon">  
											<input type="aciklama" class="form-control" name="aciklama"
                                                placeholder="Açıklama" aria-label="aciklama"
                                                aria-describedby="aciklama-addon">  												
                                        </div>
											
										<div class="mt-3 d-grid">
    <button class="btn btn-primary waves-effect waves-light" type="submit" id="gönder" name="gönder" style="font-size: 11px; width: 100px; height: 35px;">
	<i style="color: white;" class="bx bx-send font-size-10"></i>
	Gönder
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
                                        <h4 class="card-title">Bildirimler</h4>
                                        <p class="card-title-desc">Buradan bildirimleri görebilir düzenliyebilirsiniz</p>    
                                        
                                        <div class="table-responsive">
                                            <table class="table mb-0">
    <thead class="table-light">
        <tr>
            <th>id</th>
            <th>Başlık</th>
            <th>Açıklama</th>
			<th>İşlem</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $baglan = $db->query("SELECT * FROM `31cekbildirimler`");

        while ($veri = $baglan->fetch()) {
            

        ?>
            <tr>
                <td><?= $veri['id'] ?></td>
                <td><?= $veri['baslik'] ?></td>
                <td><?= $veri['aciklama'] ?></td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $veri['id'] ?>">

                        <button style="background: none; border: 1px;" type="submit" name="sil">
                            <i style="color: red;" class="bx bx-x font-size-20"></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php
        }


        if (isset($_POST["sil"])) {
            $id = System::filter($_POST["id"]);

            echo '<script>toastr.success("Bildirim başarıyla silindi!");</script>';
            $sql = "DELETE FROM 31cekbildirimler WHERE id = :id";

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

        <!-- apexcharts -->
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
		<script src="assets/libs/toastr/build/toastr.min.js"></script>
        
        <!-- Saas dashboard init -->
        <script src="assets/js/pages/saas-dashboard.init.js"></script>

        <script src="assets/js/app.js"></script>
		<script src="assets/js/pages/toastr.init.js"></script>

    </body>

</html>
