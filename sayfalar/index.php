<?php
include "inc/sidebar.php";
include "inc/header.php";

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
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <img src="<?= $profil ?>" alt="" class="avatar-md rounded-circle img-thumbnail">
                                                    </div>
                                                    <div class="flex-grow-1 align-self-center">
                                                        <div class="text-muted">
                                                           

                                                            <h5 style="background: url('<?= $backgroundpic ?>') center / contain no-repeat; color: <?= $isimcolor ?>; display: inline-block"><?= $username ?></h5>


															
                                                            <p class="mb-0"><?php
															$mesajlar = [
																"Yinemi sen amk",
																"Hoş geldin la yarram",
																"Çok kalma git sorgunu at çık",
																"Biz yapay zekayız kardes gerizekalı değiliz",
																"Zoruna gidenin borusuna girsin.",
																"Göt adamsında özledim be seni",
																"afferin, gözüme giriyorsun"
																];
															$rastgeleIndex = array_rand($mesajlar);
															echo $mesajlar[$rastgeleIndex];
															?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                
                                            <div class="col-lg-4 align-self-center">
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
                                                                <p class="text-muted text-truncate mb-2">Kalan gün</p>
                                                                <h5 class="mb-0"><?= $süre ?></h5>
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
                                        <!-- end row -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                     
                            <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium">Kullanıcı sayısı</p>
                                                        <h4 class="mb-0"><?= $kullanicisayi["toplam"] ?></h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center ">
                                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                            <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bx-user font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									<div class="col-md-4">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium">Premium sayısı</p>
                                                        <h4 class="mb-0"><?= $kullanicisayi["premiumsayisi"] ?></h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center ">
                                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                            <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bx-user-check font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-muted fw-medium">Banlı kullanıcı sayısı</p>
                                                        <h4 class="mb-0"><?= $kullanicisayi["banlisayisi"] ?></h4>
                                                    </div>

                                                    <div class="flex-shrink-0 align-self-center ">
                                                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                            <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bxs-error-alt font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								
                                </div>
                                <!-- end row -->
                            </div>
                        </div>

                        <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Sancak log</h4>
										<?php
						
										$baglan = $db->query("SELECT * FROM `31ceklogs` WHERE username = '$username' ORDER BY `tarih` DESC LIMIT 5;");

										while ($veri = $baglan->fetch()) {
											$logstype = $veri['type'];
											$kullaniciadi = $veri['username'];
											$tarih = $veri['tarih'];
						

								
											if($logstype === 1){
												$titlelog = "Giriş logu";
												$icon = "bx bxs-log-in-circle";
											}elseif($logstype === 2){
												$titlelog = "Çıkış logu";
												$icon = "bx bxs-log-out-circle";
											}elseif($logstype === 3){
												$titlelog = "Sorgu logu";
												$icon = "bx bx-search-alt-2";
											}elseif($logstype === 4){
												$titlelog = "Multi Denemesi";
												$icon = "bx bx-no-entry";
											}
										?>
                                        <div data-simplebar style="max-height: 376px;">
										
                                            <ul class="verti-timeline list-unstyled">
											
                                                <li class="event-list">
												
                                                    <div class="event-timeline-dot">
                                                        <i class="bx bx-right-arrow-circle font-size-18"></i>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-xs">
                                                                <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                                                    <i class='<?= $icon ?> font-size-20'></i>
                                                                </div>
                                                            </div>
                                                        </div>
														
                                                        <div class="flex-grow-1">
                                                            <div>
                                                                <?= $titlelog ?> <a >
                                                                <p class="text-muted mb-0"><?= $tarih ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                               
                                            </ul>
                                         </div>
										 <?php
										}
										 ?>
                                    </div>
                                </div><!--end card-->
                            </div><!--end col-->

							
                        <!-- end row -->

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

    </body>

</html>
