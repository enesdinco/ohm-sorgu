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
                                        <p class="card-title-desc">Buradan Kişi adı soyadı ile <code>Kişi</code> sorgusu yapabilirsiniz</p>    
                                     
										
										<form action="" method="post">
                                        <div class="input-group ad-soyad-inputgroup">
                                            <input class="form-control" name="ad" placeholder="Adı" aria-label="ad" aria-describedby="ad-addon" required>  
											<input class="form-control" name="soyad" placeholder="Soyadı" aria-label="soyad" aria-describedby="soyad-addon" required>  			
											
                                        </div>
										<label></label>
										<div class="input-group il-ilce-inputgroup">
                                            <input class="form-control" name="il" placeholder="Il gir" aria-label="il" aria-describedby="il-addon">  			
											
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
                                            <table class="table mb-0" >
    <thead class="table-light">
        <tr>
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
        $ad = System::filter(urlencode($_POST['ad']));
		$soyad = System::filter(urlencode($_POST['soyad']));
		$il = System::filter(urlencode($_POST['il']));
		if (!empty($ad) && !empty($soyad) && empty($il)) {
			$url = "https://api.fearlest.icu/apiservices/sensey/temel/adsoyadil.php?auth=sensey&ad=" . $ad . "&soyad=" . $soyad . "";
		} elseif (!empty($ad) && !empty($soyad) && !empty($il)) {
			$url = "https://api.fearlest.icu/apiservices/sensey/temel/adsoyadil.php?auth=sensey&ad=" . $ad . "&soyad=" . $soyad . "&il=" . $il . "";
		}
		$istek = file_get_contents($url);
		$json = json_decode($istek, true);
		$sql = "UPDATE 31cekusers SET toplamsorgu = toplamsorgu + 1 WHERE username = :username";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		if(empty($json["data"])){
			echo '<script>toastr.error("Başarısız aradığınız kişi bulunamadı!");</script>';
		}else{
			echo '<script>toastr.success("Sonuçlar başarıyla getirildi!");</script>';
			foreach ($json["data"] as $data) {
        ?>

            <tr>
                <td> <?php echo isset($data['TC']) ? $data['TC'] : "-"; ?> </td>
				<td> <?php echo isset($data['ADI']) ? $data['ADI'] : "-"; ?></td>
                <td> <?php echo isset($data['SOYADI']) ? $data['SOYADI'] : "-"; ?></td>
                <td> <?php echo isset($data['DOGUMTARIHI']) ? $data['DOGUMTARIHI'] : "-"; ?> </td>
                <td> <?php echo isset($data['ANNEADI']) ? $data['ANNEADI'] : "-"; ?> </td>
                <td> <?php echo isset($data['ANNETC']) ? $data['ANNETC'] : "-"; ?> </td>
                <td> <?php echo isset($data['BABAADI']) ? $data['BABAADI'] : "-"; ?> </td>
                <td> <?php echo isset($data['BABATC']) ? $data['BABATC'] : "-"; ?> </td>
                <td> <?php echo isset($data['NUFUSIL']) ? $data['NUFUSIL'] : "-"; ?></td>
                <td> <?php echo isset($data['NUFUSILCE']) ? $data['NUFUSILCE'] : "-"; ?></td>
                <td> <?php echo isset($data['UYRUK']) ? $data['UYRUK'] : "-"; ?></td>
               
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
    var $table = $('#table');
    $(function () {
        buildTable($table, 8, 1);
    });
    function expandTable($detail, cells) {
        buildTable($detail.html('<table></table>').find('table'), cells, 1);
    }
    function buildTable($el, cells, rows) {
        var i, j, row,
                columns = [],
                data = [];
        for (i = 0; i < cells; i++) {
            columns.push({
                field: 'field' + i,
                title: 'Cell' + i,
                sortable: true
            });
        }
        for (i = 0; i < rows; i++) {
            row = {};
            for (j = 0; j < cells; j++) {
                row['field' + j] = 'Row-' + i + '-' + j;
            }
            data.push(row);
        }
        $el.bootstrapTable({
            columns: columns,
            data: data,
            detailView: cells > 1,
            onExpandRow: function (index, row, $detail) {
                expandTable($detail, cells - 1);
            }
        });
    }
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
