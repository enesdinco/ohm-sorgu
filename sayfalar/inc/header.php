     <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="#" class="logo logo-light">
                             
                                    <img src="assets/images/eze.png" alt="" height="45">
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>



                     
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
        
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                      
                       

                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                                <i class="bx bx-fullscreen"></i>
                            </button>
                        </div>
						<?php
						$bildirimsayisi = $db->prepare("SELECT COUNT(*) AS count FROM 31cekbildirimler");
						$bildirimsayisi->execute();
						$bildirimsayisi = $bildirimsayisi->fetch(PDO::FETCH_ASSOC);
						$bildirimcount = $bildirimsayisi["count"];

						?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-bell bx-tada"></i>
                                <span class="badge bg-danger rounded-pill"><?= $bildirimcount ?></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0" key="t-notifications"> Bildirimler </h6>
                                        </div>
                                     
                                    </div>
                                </div>
							
								
								<?php
								if($bildirimcount === 0){
								?>
								<div class="dropdown-divider"></div>
								<div data-simplebar style="max-height: 230px;">
                                    <a href="javascript: void(0);" class="text-reset notification-item">
                                        <div class="d-flex">
                                            
                                            <div class="flex-grow-1">
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1" key="t-grammer">Burada bildirim yok</p>
                                                    
                                                </div>
												
                                            </div>
											
                                        </div>
                                    </a>
                           
                            </div>
								<?php
									
								}else{
								?>
								<?php
						
										$baglan = $db->prepare("SELECT * FROM `31cekbildirimler`");
										$baglan->execute();

										while ($veri = $baglan->fetch(PDO::FETCH_ASSOC)) {
											$id = $veri['id'];
											$notype = $veri['type'];
											$baslik = $veri['baslik'];
											$aciklama = $veri['aciklama'];
	
										
										?>
										
								<div class="dropdown-divider"></div>
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="javascript: void(0);" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="bx bxs-user-voice"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1" key="t-your-order"><?= $baslik ?></h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1" key="t-grammer"><?= $aciklama ?></p>
                                                    
                                                </div>
												
                                            </div>
											
                                        </div>
                                    </a>
                           
                            </div>
							<?php
										}
										}
							?>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="<?= $profil ?>"
                                    alt="yok">
                                <span style="background: url('<?= $backgroundpic ?>') center / contain no-repeat; color: <?= $isimcolor ?>; display: inline-block;" class="d-none d-xl-inline-block ms-1" key="t-henry"><?= $username ?></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a style="color: <?= $isimcolor ?>;" class="dropdown-item"  <span><?= $username ?></span></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="/logout"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Çıkış yap</span></a>
                            </div>
                        </div>

                        

                    </div>
                </div>
            </header>
