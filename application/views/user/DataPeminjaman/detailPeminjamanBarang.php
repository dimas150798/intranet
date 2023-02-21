<div id="layoutSidenav_content">
	<main>

		<div class="container-fluid px-4">

			<h4 class="mt-4">Detail Peminjaman Barang</h4>
			<ol class="breadcrumb mb-4">
				<li class="breadcrumb-item"><a href="#">Data Peminjaman Barang</a></li>
				<li class="breadcrumb-item active">Form</li>
			</ol>


			<div class="card mb-4">
				<div class="card-header">
					<i class="fas fa-table me-1"></i>
					Data Peminjaman
				</div>
				<div class="card-body">
					<div class="container">

						<?php foreach ($dataPeminjaman as $data) : ?>
						<form method="POST"
							action="<?php echo base_url('user/DataPeminjaman/AddPengembalianBarangPegawai/addPengembalianAksi') ?>"
							enctype="multipart/form-data">

							<div class="row justify-content-center">
								<div class="col-sm-12 mt-2">
									<label for="nama_customer" class="form-label" style="font-weight: bold;"> Nama
										Pegawai:
										<span class="text-danger">*</span></label>
									<input type="hidden" class="form-control" name="id_bukti_barang_peminjaman"
										id="id_bukti_barang_peminjaman"
										value="<?php echo $data->id_bukti_barang_peminjaman?>"
										readonly>
									<input type="text" class="form-control" name="" id=""
										value="<?php echo $data->nama_pegawai?>"
										readonly>
								</div>


							</div>

							<div class="row justify-content-center">
								<div class="col-sm-6 mt-2">
									<label for="photo" class="form-label" style="font-weight: bold;">Foto Peminjaman 1 :
										<span class="text-danger">*</span></label> <br>

									<img src="<?php echo base_url().'assets/bukti_peminjaman/'.$data->foto_peminjaman1 ?>"
										width="280px" height="280px">
								</div>

								<div class="col-sm-6 mt-2">
									<label for="photo" class="form-label" style="font-weight: bold;">Foto Peminjaman 2 :
										<span class="text-danger">*</span></label> <br>

									<img src="<?php echo base_url().'assets/bukti_peminjaman/'.$data->foto_peminjaman2 ?>"
										width="280px" height="280px">
								</div>

							</div>

							<div class="row justify-content-center">
								<div class="col-sm-6 mt-2">
									<label for="photo" class="form-label" style="font-weight: bold;">Foto Pengembalian 1
										:
										<span class="text-danger">*</span></label> <br>

									<img src="<?php echo base_url().'assets/bukti_peminjaman/'.$data->foto_pengembalian1 ?>"
										width="280px" height="280px">
								</div>

								<div class="col-sm-6 mt-2">
									<label for="photo" class="form-label" style="font-weight: bold;">Foto Pengembalian 2
										:
										<span class="text-danger">*</span></label> <br>

									<img src="<?php echo base_url().'assets/bukti_peminjaman/'.$data->foto_pengembalian2 ?>"
										width="280px" height="280px">
								</div>

							</div>


							<div class="row mt-3">
								<div class="col-sm-12 d-flex justify-content-end">
									<a class="btn btn-danger mt-2 justify-content-end"
										href="<?php echo base_url('user/DataPeminjaman/DataPeminjamanBarangPegawai')?>"><i
											class="bi bi-backspace-fill"></i> Kembali</a>
								</div>
							</div>

						</form>
						<?php endforeach; ?>

					</div>
				</div>
			</div>
		</div>
	</main>