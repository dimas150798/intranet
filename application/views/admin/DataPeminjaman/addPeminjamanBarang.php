<div id="layoutSidenav_content">
	<main>

		<div class="container-fluid px-4">

			<h4 class="mt-4">Peminjaman Barang</h4>
			<ol class="breadcrumb mb-4">
				<li class="breadcrumb-item"><a href="#">Data Peminjaman Barang</a></li>
				<li class="breadcrumb-item active">Peminjaman Barang</li>
			</ol>


			<div class="card mb-4">
				<div class="card-header">
					<i class="fas fa-table me-1"></i>
					Data Peminjaman <br>
				</div>
				<div class="card-body">
					<div class="container">

						<form method="POST"
							action="<?php echo base_url('admin/DataPeminjaman/AddPeminjamanBarang/addData') ?>">

							<div class="row justify-content-center">

								<div class="col-sm-6 mt-2">
									<label for="barang" class="form-label text-center" style="font-weight: bold;">Nama
										Barang :
										<span class="text-danger">*</span></label>
									<select name="barang" id="barang" class="form-control text-center" required>
										<option disabled selected>-- Pilih Barang --</option>
										<?php foreach ($dataBarang as $data) : ?>
										<option
											value="<?php echo $data['id_barang']?>">
											<?php echo $data['nama_barang']?>
										</option>
										<?php endforeach; ?>
									</select>
								</div>

								<div class="col-sm-6 mt-2">
									<label for="pegawai" class="form-label text-center" style="font-weight: bold;">Nama
										Pegawai :
										<span class="text-danger">*</span></label>
									<select name="pegawai" id="pegawai" class="form-control text-center" required>
										<option disabled selected>-- Pilih Pegawai --</option>
										<?php foreach ($dataPegawai as $data) : ?>
										<option
											value="<?php echo $data['id_pegawai']?>">
											<?php echo $data['nama_pegawai']?>
										</option>
										<?php endforeach; ?>
									</select>
								</div>

							</div>

							<div class="row justify-content-center">
								<div class="col-sm-4 mt-2">
									<label for="tanggal" class="form-label" style="font-weight: bold;">Tanggal :
										<span class="text-danger">*</span></label>
									<input type="date" class="form-control" name="tanggal" id="tanggal" value=""
										required>
									<div class="bg-danger">
										<small
											class="text-white"><?php echo form_error('tanggal'); ?></small>
									</div>
								</div>

								<div class="col-sm-4 mt-2">
									<label for="jumlah" class="form-label" style="font-weight: bold;"> Jumlah :
										<span class="text-danger">*</span></label>
									<input type="number" class="form-control" name="jumlah" id="jumlah" value=""
										placeholder="Masukkan jumlah...">
									<div class="bg-danger">
										<small
											class="text-white"><?php echo form_error('jumlah'); ?></small>
									</div>
								</div>

								<div class="col-sm-4 mt-2">
									<label for="keterangan" class="form-label" style="font-weight: bold;"> Keterangan :
										<span class="text-danger">*</span></label>
									<input type="text" class="form-control" name="keterangan" id="keterangan" value=""
										placeholder="Masukkan keterangan...">
									<div class="bg-danger">
										<small
											class="text-white"><?php echo form_error('keterangan'); ?></small>
									</div>
								</div>

							</div>



							<div class="row mt-3">
								<div class="col-sm-12 d-flex justify-content-end">
									<button type="submit" class="btn btn-success mt-2 justify-content-end"
										style="margin-right: 5px;"><i class="bi bi-plus-circle"></i> Simpan</button>
									<a class="btn btn-danger mt-2 justify-content-end"
										href="<?php echo base_url('admin/DataPeminjaman/DataPeminjamanBarang')?>"><i
											class="bi bi-backspace-fill"></i> Kembali</a>
								</div>
							</div>

						</form>




					</div>
				</div>
			</div>
		</div>
	</main>