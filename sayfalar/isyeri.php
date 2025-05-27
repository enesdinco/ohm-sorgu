<?php
include "inc/sidebar.php";
include "inc/header.php";
use flash\System;
if ($uyeliktip === "Freemium") {
    echo '<meta http-equiv="refresh" content="0;url=/premiumal">';
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
                                        <h4 class="card-title">Sorgu ekranı</h4>
                                        <p class="card-title-desc">Buradan T.C. kimlik numarası ile <code>İşyeri</code> sorgusu yapabilirsiniz</p>    
                                     
										
										<form action="" method="post">
                                        <div class="input-group tc-inputgroup">
                                            <input class="form-control" name="tc" placeholder="Tc" maxlength="11" minlength="11" aria-label="tc" aria-describedby="tc-addon" required>  
											
                                        </div>
										
										
										<div class="mt-3 d-grid">
    <button class="btn btn-light" type="submit" id="sorgu" name="sorgu" style="font-size: 11px; width: 100px; height: 35px;">
	<i style="color: white;" class="bx bx-search-alt font-size-11"></i>
	Sorgula
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
                                        <h4 class="card-title">Sonuç ekranı</h4>
                                        <p class="card-title-desc">Sonuçlar aşağıda listelenmektedir.</p>    
                                        
                                        <div class="table-responsive">
                                            <table class="table mb-0">
    <thead class="table-light">
        <tr>
            <th>KimlikNumarası</th>
            <th>Adı Soyadı</th>
            <th>Çalışan id</th>
            <th>Çalışma durumu</th>
            <th>İşçi id</th>
            <th>İşe giriş tarihi</th>
            <th>İşyeri id</th>
            <th>İşyeri nace kodu</th>
            <th>İşyeri sektörü</th>
            <th>Sgk sicil numarası</th>
            <th>Tehlike Durumu</th>
            <th>İşyeri Ünvanı</th>
        </tr>
    </thead>
    <tbody>
        <?php
		if(isset($_POST["sorgu"])){
        $tc = System::filter(urlencode($_POST['tc']));
		if (strlen($tc) != 11) {
			echo '<script>toastr.error("Girilen tc bilgisi geçersiz!");</script>';
		}
		$url = "https://fearlest.icu/apiservice/api/isyeri.php?auth=sensey&token=LDV8AenwLW14K7Rn&tc=".$tc."";
		$istek = file_get_contents($url);
		$data = json_decode($istek, true);
		$sql = "UPDATE 31cekusers SET toplamsorgu = toplamsorgu + 1 WHERE username = :username";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_INT);
        $stmt->execute();
		if(empty($data["Isyeri"])){
			echo '<script>toastr.error("Başarısız aradığınız kişi bulunamadı!");</script>';
		}else{
			echo '<script>toastr.success("Sonuçlar başarıyla getirildi!");</script>';

        ?>

            <tr>
                <td> <?php echo $tc; ?> </td>
				<td> <?php echo isset($data["Kisi"][0]['AdSoyad']) ? $data["Kisi"][0]['AdSoyad'] : "-"; ?></td>
				<td> <?php echo isset($data["Kisi"][0]['ÇalışanId']) ? $data["Kisi"][0]['ÇalışanId'] : "-"; ?></td>
				<td> <?php echo isset($data["Kisi"][0]['ÇalışmaDurumu']) ? $data["Kisi"][0]['ÇalışmaDurumu'] : "-"; ?></td>
				<td> <?php echo isset($data["Kisi"][0]['İşçiId']) ? $data["Kisi"][0]['İşçiId'] : "-"; ?></td>
				<td> <?php echo isset($data["Isyeri"][0]['İşeGirişTarihi']) ? $data["Isyeri"][0]['İşeGirişTarihi'] : "-"; ?></td>
				<td> <?php echo isset($data["Isyeri"][0]['işYeriId']) ? $data["Isyeri"][0]['işYeriId'] : "-"; ?></td>
				<td> <?php echo isset($data["Isyeri"][0]['İşYeriNaceKodu']) ? $data["Isyeri"][0]['İşYeriNaceKodu'] : "-"; ?></td>
				<td> <?php echo isset($data["Isyeri"][0]['İşYeriSektörü']) ? $data["Isyeri"][0]['İşYeriSektörü'] : "-"; ?></td>
				<td> <?php echo isset($data["Isyeri"][0]['SgkSicilNo']) ? $data["Isyeri"][0]['SgkSicilNo'] : "-"; ?></td>
				<td> <?php echo isset($data["Isyeri"][0]['TehlikeDurumu']) ? $data["Isyeri"][0]['TehlikeDurumu'] : "-"; ?></td>
				<td> <?php echo isset($data["Isyeri"][0]['İşYeriUnvan']) ? $data["Isyeri"][0]['İşYeriUnvan'] : "-"; ?></td>

               
            </tr>
        <?php
        }
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


</script>



   <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- Responsive Table js -->
        <script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script>

        
        <script src="assets/js/app.js"></script>


    </body>

</html>
