<div id="layoutSidenav_content">
	<main>
		<div class="container-fluid px-4">
			<div class="row">
				<div class="col-xl-3 col-md-6">
					<div class="card shadow bg-primary text-white mb-4 mt-4">
						<div class="row">
							<div class="col-sm-12 mt-2 mb-4 fw-bold" style="text-align: center;">Data Customer :</div>
							<div class="col-sm-6 fw-bold" style="font-size: 20px; text-align: center;"><i
									class="fas fa-user fa-2x text-gray-300"></i></div>
							<div class="col-sm-6 mb-4 fw-bold" style="font-size: 30px; text-align: center;">
								<?php echo $jumlahCustomer ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-md-6">
					<div class="card shadow bg-success text-white mb-4 mt-4">
						<div class="row">
							<div class="col-sm-12 mt-2 mb-4 fw-bold" style="text-align: center;">Data Barang Masuk :
							</div>
							<div class="col-sm-6 fw-bold" style="font-size: 20px; text-align: center;"><i
									class="fas fa-user fa-2x text-gray-300"></i></div>
							<div class="col-sm-6 mb-4 fw-bold" style="font-size: 30px; text-align: center;">
								<?php echo $jumlahBarangMasuk ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-md-6">
					<div class="card shadow bg-info text-white mb-4 mt-4">
						<div class="row">
							<div class="col-sm-12 mt-2 mb-4 fw-bold" style="text-align: center;">Data Barang Keluar :
							</div>
							<div class="col-sm-6 fw-bold" style="font-size: 20px; text-align: center;"><i
									class="fas fa-user fa-2x text-gray-300"></i></div>
							<div class="col-sm-6 mb-4 fw-bold" style="font-size: 30px; text-align: center;">
								<?php echo $jumlahBarangKeluar ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-md-6">
					<div class="card shadow bg-danger text-white mb-4 mt-4">
						<div class="row">
							<div class="col-sm-12 mt-2 mb-4 fw-bold" style="text-align: center;">Data Peminjaman :</div>
							<div class="col-sm-6 fw-bold" style="font-size: 20px; text-align: center;"><i
									class="fas fa-user fa-2x text-gray-300"></i></div>
							<div class="col-sm-6 mb-4 fw-bold" style="font-size: 30px; text-align: center;">
								<?php echo $peminjamanBarangPending ?>
							</div>
						</div>
					</div>
				</div>

				<?php
                    if (!function_exists('changeDateFormat')) {
                        function changeDateFormat($format='d-m-Y', $givenDate=null)
                        {
                            return date($format, strtotime($givenDate));
                        }
                    }
                ?>

			</div>

		</div>

	</main>