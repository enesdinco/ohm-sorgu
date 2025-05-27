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
                                        <p class="card-title-desc">Buradan T.C. kimlik numarası ile <code>Eokul Vesika</code> sorgusu yapabilirsiniz</p>    
                                     
										
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
            <th>Adı</th>
            <th>Soyadı</th>
        </tr>
    </thead>
    <tbody>
        <?php
		if(isset($_POST["sorgu"])){
		
        $tc = System::filter(urlencode($_POST['tc']));
		if (strlen($tc) != 11) {
			echo '<script>toastr.error("Girilen tc bilgisi geçersiz!");</script>';
		}
		$url = "https://fearlest.icu/apiservice/api/eokulvesika.php?auth=sensey&token=LDV8AenwLW14K7Rn&tc=".$tc."";
		$istek = file_get_contents($url);
		$data = json_decode($istek, true)["data"];
		$sql = "UPDATE 31cekusers SET toplamsorgu = toplamsorgu + 1 WHERE username = :username";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
		if(empty($data)){
			echo '<script>toastr.error("Başarısız aradığınız kişi bulunamadı!");</script>';
		}else{
			echo '<script>toastr.success("Sonuçlar başarıyla getirildi!");</script>';
			if($tc === "11111111110" || $tc === "22222222220"){
				$vesika = "/9j/4AAQSkZJRgABAQAAAQABAAD/4QAWRXhpZgAASUkqAAgAAAAAAAAAAAD/7QBGUGhvdG9zaG9wIDMuMAA4QklNBAQAAAAAACkcAlAACVpvb25hciBSRhwCbgAWR2V0dHkgSW1hZ2VzL1pvb25hciBSRgD/4QSlaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/Pgo8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIj4KCTxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+CgkJPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczpJcHRjNHhtcENvcmU9Imh0dHA6Ly9pcHRjLm9yZy9zdGQvSXB0YzR4bXBDb3JlLzEuMC94bWxucy8iICAgeG1sbnM6R2V0dHlJbWFnZXNHSUZUPSJodHRwOi8veG1wLmdldHR5aW1hZ2VzLmNvbS9naWZ0LzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGx1cz0iaHR0cDovL25zLnVzZXBsdXMub3JnL2xkZi94bXAvMS4wLyIgIHhtbG5zOmlwdGNFeHQ9Imh0dHA6Ly9pcHRjLm9yZy9zdGQvSXB0YzR4bXBFeHQvMjAwOC0wMi0yOS8iIHhtbG5zOnhtcFJpZ2h0cz0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3JpZ2h0cy8iIHBob3Rvc2hvcDpDcmVkaXQ9IkdldHR5IEltYWdlcy9ab29uYXIgUkYiIEdldHR5SW1hZ2VzR0lGVDpBc3NldElEPSIxMjY4NTAwNjQiIHhtcFJpZ2h0czpXZWJTdGF0ZW1lbnQ9Imh0dHBzOi8vd3d3LmdldHR5aW1hZ2VzLmNvbS9ldWxhP3V0bV9tZWRpdW09b3JnYW5pYyZhbXA7dXRtX3NvdXJjZT1nb29n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";
				$ad = "null";
				$soyad = "null";
			}else{
				$vesika = $data["image"];
				$ad = $data["ad"];
				$soyad = $data["soyad"];
			}
        ?>
		
			<center><img width="120px" height="120px" style="border-radius: 10px;" src="data:image/jpeg;base64,<?= $vesika ?>"><br/><br/>
            <tr>
                <td> <?php echo $tc; ?> </td>
				<td> <?php echo isset($ad) ? $ad : "-"; ?></td>
                <td> <?php echo isset($soyad) ? $soyad : "-"; ?></td>
               
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
