<body class="sb-nav-fixed">
	<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
		<!-- Navbar Brand-->
		<a class="navbar-brand ps-3" id="sidebarLogo" href="#" style="font-size: 18px;">
			<img src="<?php echo base_url(); ?>assets/img/logoSaja.png"
				alt="" height="40px"> <b>Intranet Infly Networks</b></a>
		<!-- Sidebar Toggle-->
		<button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
				class="fas fa-bars"></i></button>

		<!-- Navbar-->
		<ul class="navbar-nav ms-auto ms-md-6 me-3 me-lg-4">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
					aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
				<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="#!">Akun</a></li>
					<!-- <li><a class="dropdown-item" href="#!">Activity Log</a></li> -->
					<li>
						<hr class="dropdown-divider" />
					</li>
					<li><a class="dropdown-item"
							href="<?php echo base_url('Welcome/logout') ?>">Logout</a>
					</li>
				</ul>
			</li>
		</ul>
	</nav>
	<div id="layoutSidenav">
		<div id="layoutSidenav_nav">
			<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
				<div class="sb-sidenav-menu">
					<div class="nav">
						<div class="sb-sidenav-menu-heading">Home page</div>
						<a class="nav-link"
							href="<?php echo base_url('admin/DashboardAdmin')?>">
							<div class="sb-nav-link-icon"><img
									src="<?php echo base_url(); ?>assets/img/dashboard.gif"
									alt="" width="20px"></div>
							Dashboard
						</a>

						<!-- Data Master -->
						<div class="sb-sidenav-menu-heading">Data Master</div>
						<a class="nav-link" href="#" data-bs-toggle="collapse"
							data-bs-target="#collapseLayoutsPelanggan" aria-expanded="false"
							aria-controls="collapseLayoutsPelanggan">
							<div class="sb-nav-link-icon"><img
									src="<?php echo base_url(); ?>assets/img/AvatarPelanggan.gif"
									alt="" width="20px"> </div>
							Data Pegawai
							<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
						</a>
						<div class="collapse" id="collapseLayoutsPelanggan" aria-labelledby="headingOne"
							data-bs-parent="#sidenavAccordion">
							<nav class="sb-sidenav-menu-nested nav">
								<a class="nav-link"
									href="<?php echo base_url('admin/DataPegawai/DataPegawai') ?>"><i
										class="bi bi-person-circle"> Data Pegawai</i></a>
							</nav>
						</div>

						<a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
							aria-expanded="false" aria-controls="collapseLayouts">
							<div class="sb-nav-link-icon"><img
									src="<?php echo base_url(); ?>assets/img/AvatarPelanggan.gif"
									alt="" width="20px">
							</div>
							Data Customer
							<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
						</a>
						<div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
							data-bs-parent="#sidenavAccordion">
							<nav class="sb-sidenav-menu-nested nav">
								<a class="nav-link"
									href="<?php echo base_url('admin/DataCustomer/DataCustomerPusat') ?>"><i
										class="bi bi-person-circle"> Customer Aktif</i></a>
								<a class="nav-link"
									href="<?php echo base_url('admin/DataBarangV2/Data_Aktivasi') ?>"><i
										class="bi bi-list-ol"> Data Aktivasi</i></a>
								<a class="nav-link"
									href="<?php echo base_url('admin/DataCustomer/DataCustomerTerminate') ?>"><i
										class="bi bi-wifi-off"> Terminate</i></a>
							</nav>
						</div>

						<!-- Data Barang -->
						<div class="sb-sidenav-menu-heading">Data Barang</div>
						<a class="nav-link" href="#" data-bs-toggle="collapse"
							data-bs-target="#collapseLayoutsDataBarang" aria-expanded="false"
							aria-controls="collapseLayoutsDataBarang">
							<div class="sb-nav-link-icon"><i class="bi bi-bookmark-check"></i></div>
							Data Barang
							<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
						</a>
						<div class="collapse" id="collapseLayoutsDataBarang" aria-labelledby="headingOne"
							data-bs-parent="#sidenavAccordion">
							<nav class="sb-sidenav-menu-nested nav">
								<a class="nav-link"
									href="<?php echo base_url('admin/DataBarangV2/Data_BarangNama') ?>"><i
										class="bi bi-box-seam"> Nama Barang</i></a>
								<a class="nav-link"
									href="<?php echo base_url('admin/DataBarangV2/Data_StockRincianNonModem') ?>"><i
										class="bi bi-box-seam"> Detail Barang</i></a>
							</nav>
						</div>

						<a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsKategori"
							aria-expanded="false" aria-controls="collapseLayoutsKategori">
							<div class="sb-nav-link-icon"><i class="bi bi-bookmarks"></i>
							</div>
							Kategori Barang
							<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
						</a>
						<div class="collapse" id="collapseLayoutsKategori" aria-labelledby="headingOne"
							data-bs-parent="#sidenavAccordion">
							<nav class="sb-sidenav-menu-nested nav">
								<!-- <a class="nav-link"
									href="<?php echo base_url('admin/DataBarangV2/Data_StockBarangATK') ?>"><i
									class="bi bi-box-seam"> ATK</i></a>
								<a class="nav-link"
									href="<?php echo base_url('admin/DataBarangV2/Data_StockBarangKantor') ?>"><i
										class="bi bi-box-seam"> Kantor</i></a> -->
								<a class="nav-link"
									href="<?php echo base_url('admin/DataBarangV2/Data_StockBarangModem') ?>"><i
										class="bi bi-box-seam"> Aktivasi</i></a>
								<a class="nav-link"
									href="<?php echo base_url('admin/DataBarangV2/Data_StockBarangPelanggan') ?>"><i
										class="bi bi-box-seam"> Distribusi</i></a>
								<a class="nav-link"
									href="<?php echo base_url('admin/DataBarangV2/Data_StockBarangEngineer') ?>"><i
										class="bi bi-box-seam"> Engineer</i></a>
							</nav>
						</div>

						<a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsLaporan"
							aria-expanded="false" aria-controls="collapseLayoutsLaporan">
							<div class="sb-nav-link-icon"><i class="bi bi-bookmark-star"></i>
							</div>
							Laporan Barang
							<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
						</a>
						<div class="collapse" id="collapseLayoutsLaporan" aria-labelledby="headingOne"
							data-bs-parent="#sidenavAccordion">
							<nav class="sb-sidenav-menu-nested nav">
								<a class="nav-link"
									href="<?php echo base_url('admin/DataBarangV2/Data_BarangMasuk') ?>"><i
										class="bi bi-box-seam"> Barang Masuk</i></a>
								<a class="nav-link"
									href="<?php echo base_url('admin/DataBarangV2/Data_BarangMutasi') ?>"><i
										class="bi bi-box-seam"> Barang Keluar</i></a>
								<a class="nav-link"
									href="<?php echo base_url('admin/DataPeminjamanV2/DataPeminjamanBarang') ?>"><i
										class="bi bi-box-seam"> Peminjaman</i></a>
							</nav>
						</div>



						<!-- Purchasing -->
						<div class="sb-sidenav-menu-heading">Purchasing</div>
						<a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#purchaseRequest"
							aria-expanded="false" aria-controls="purchaseRequest">
							<div class="sb-nav-link-icon"><i class="bi bi-clipboard-data-fill"></i> </div>
							Purchase Request
							<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
						</a>
						<div class="collapse" id="purchaseRequest" aria-labelledby="headingOne"
							data-bs-parent="#sidenavAccordion">
							<nav class="sb-sidenav-menu-nested nav">
								<a class="nav-link"
									href="<?php echo base_url('admin/DataPurchase/DataPurchaseRequest') ?>"><i
										class="bi bi-journal-plus"> Data Request</i></a>
								<!-- <a class="nav-link"
									href="<?php echo base_url('admin/Purchasing/DataPurchaseRequest') ?>"><i
									class="bi bi-eye-fill"> Detail Request</i></a>
								<a class="nav-link"
									href="<?php echo base_url('admin/Purchasing/RekapPurchaseRequest') ?>"><i
										class="bi bi-book"> Rekap Request</i></a> -->
							</nav>
						</div>

						<a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#purchaseOrder"
							aria-expanded="false" aria-controls="purchaseOrder">
							<div class="sb-nav-link-icon"><i class="bi bi-clipboard-data-fill"></i> </div>
							Purchase Order
							<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
						</a>
						<div class="collapse" id="purchaseOrder" aria-labelledby="headingOne"
							data-bs-parent="#sidenavAccordion">
							<nav class="sb-sidenav-menu-nested nav">
								<a class="nav-link"
									href="<?php echo base_url('admin/DataPurchase/DataPurchaseOrder') ?>"><i
										class="bi bi-journal-plus"> Data Order</i></a>
								<!-- <a class="nav-link"
									href="<?php echo base_url('admin/Purchasing/DataPurchaseOrder') ?>"><i
									class="bi bi-eye-fill"> Detail Order</i></a>
								<a class="nav-link"
									href="<?php echo base_url('admin/Purchasing/RekapPurchaseOrder') ?>"><i
										class="bi bi-book"> Rekap Order</i></a> -->
							</nav>
						</div>

						<a class="nav-link"
							href="<?php echo base_url('Welcome/logout') ?>">
							<div class="sb-nav-link-icon"><i class="bi bi-box-arrow-right text-danger"></i></div>
							Log Out
						</a>

					</div>
				</div>
				<div class="sb-sidenav-footer">
					<div class="text-warning"><img
							src="<?php echo base_url(); ?>assets/img/welcomeCustomer.gif"
							alt="" width="30px"> Selamat Datang</div>
					<div class="small">
						<?php echo $this->session->userdata('name');?>
					</div>

				</div>
			</nav>
		</div>