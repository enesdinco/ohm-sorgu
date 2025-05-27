<?php
include "inc/sidebar.php";
include "inc/header.php";
use flash\System;
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
                                        <p class="card-title-desc">Buradan T.C. kimlik numarası ile <code>Aile</code> sorgusu yapabilirsiniz</p>    
                                     
										
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
			<th>Yakınlık</th>
            <th>KimlikNumarası</th>
            <th>Adı</th>
            <th>Soyadı</th>
			<th>DoğumTarihi</th>
			<th>AnneAdı</th>
			<th>AnneTc</th>
			<th>BabaAdı</th>
			<th>BabaTc</th>
			<th>NufusIL</th>
			<th>NufusILCE</th>
			<th>Uyruk</th>
        </tr>
    </thead>
    <tbody>
        <?php
		if(isset($_POST["sorgu"])){
        $tc = System::filter(urlencode($_POST['tc']));
		if (strlen($tc) != 11) {
			echo '<script>toastr.error("Girilen tc bilgisi geçersiz!");</script>';
		}
		$url = "https://api.fearlest.icu/apiservices/sensey/temel/sulale.php?auth=sensey&Idenity=".$tc."";
		$istek = file_get_contents($url);
		$json = json_decode($istek, true);
		$sql = "UPDATE 31cekusers SET toplamsorgu = toplamsorgu + 1 WHERE username = :username";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
		if(empty($json["Soyagaci"])){
			echo '<script>toastr.error("Başarısız aradığınız kişi bulunamadı!");</script>';
		}else{
			echo '<script>toastr.success("Sonuçlar başarıyla getirildi!");</script>';
			foreach ($json["Soyagaci"] as $data) {

        ?>

            <tr>
            <td><?php echo isset($data['Yakinlik']) ? $data['Yakinlik'] : "-"; ?></td>
<td><?php echo isset($data['KimlikNo']) ? $data['KimlikNo'] : "-"; ?></td>
<td><?php echo isset($data['Isim']) ? $data['Isim'] : "-"; ?></td>
<td><?php echo isset($data['Soyisim']) ? $data['Soyisim'] : "-"; ?></td>
<td><?php echo isset($data['DogumTarihi']) ? $data['DogumTarihi'] : "-"; ?></td>
<td><?php echo isset($data['AnneIsim']) ? $data['AnneIsim'] : "-"; ?></td>
<td><?php echo isset($data['AnneKimlikNo']) ? $data['AnneKimlikNo'] : "-"; ?></td>
<td><?php echo isset($data['BabaIsim']) ? $data['BabaIsim'] : "-"; ?></td>
<td><?php echo isset($data['BabaKimlikNo']) ? $data['BabaKimlikNo'] : "-"; ?></td>
<td><?php echo isset($data['NufusIl']) ? $data['NufusIl'] : "-"; ?></td>
<td><?php echo isset($data['NufusIlce']) ? $data['NufusIlce'] : "-"; ?></td>
<td><?php echo isset($data['Uyruk']) ? $data['Uyruk'] : "-"; ?></td>

               
            </tr>
        <?php
        }
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
