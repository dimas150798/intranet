<div id="layoutSidenav_content">
	<main>

		<div class="container-fluid px-4">

			<h4 class="mt-4">Restock Barang</h4>
			<ol class="breadcrumb mb-4">
				<li class="breadcrumb-item"><a href="#">Data Barang Pusat</a></li>
				<li class="breadcrumb-item active">Restock Barang</li>
			</ol>


			<div class="card mb-4">
				<div class="card-header">
					<i class="fas fa-table me-1"></i>
					Data Barang <br>
					<label for="tanggal" class="form-label" style="font-weight: bold;">Noted ! :
						<span class="text-danger text-b">*</span></label>
					Apabila Menambah Barang Modem, Masukkan Keterangan Sebagai Modem
				</div>
				<div class="card-body">
					<div class="container">

						<form method="POST"
							action="<?php echo base_url('admin/DataBarang/AddBarangPusat/addData') ?>">

							<div class="row justify-content-center">
								<div class="col-sm-3 mt-2">
									<label for="nama_barang" class="form-label" style="font-weight: bold;"> Nama Barang
										: <span class="text-danger">*</span></label>
									<input type="hidden" class="form-control" name="id_barang" id="id_barang" value=""
										readonly>

									<input type="text" class="form-control" name="nama_barang" id="nama_barang" value=""
										placeholder="Masukkan nama...">
									<div class="bg-danger">
										<small
											class="text-white"><?php echo form_error('nama_barang'); ?></small>
									</div>
								</div>

								<div class="col-sm-2 mt-2">
									<label for="satuan" class="form-label" style="font-weight: bold;">UOM : <span
											class="text-danger">*</span></label>
									<select name="satuan" class="form-control text-center" required>
										<option disabled selected>-- Pilih UOM --</option>
										<?php foreach ($dataSatuan as $data) : ?>
										<option
											value="<?php echo $data['nama_satuan']?>">
											<?php echo $data['nama_satuan']?>
										</option>
										<?php endforeach; ?>
									</select>
								</div>

								<div class="col-sm-2 mt-2">
									<label for="tanggal" class="form-label" style="font-weight: bold;">Tanggal :
										<span class="text-danger">*</span></label>
									<input type="date" class="form-control" name="tanggal" id="tanggal" value=""
										required>
									<div class="bg-danger">
										<small
											class="text-white"><?php echo form_error('tanggal'); ?></small>
									</div>
								</div>

								<div class="col-sm-3 mt-2">
									<label for="jumlah" class="form-label" style="font-weight: bold;"> Jumlah :
										<span class="text-danger">*</span></label>
									<input type="number" class="form-control" name="jumlah" id="jumlah" value=""
										placeholder="Masukkan jumlah...">
									<div class="bg-danger">
										<small
											class="text-white"><?php echo form_error('jumlah'); ?></small>
									</div>
								</div>

								<div class="col-sm-2 mt-2">
									<label for="keterangan" class="form-label" style="font-weight: bold;">Keterangan :
										<select name="keterangan" class="form-control text-center mt-2">
											<option disabled selected>-- Keterangan --</option>
											<option value="Modem">Modem</option>
										</select>
								</div>

							</div>

							<div class="row mt-3">
								<div class="col-sm-12 d-flex justify-content-end">
									<button type="submit" class="btn btn-success mt-2 justify-content-end"
										style="margin-right: 5px;"><i class="bi bi-plus-circle"></i> Simpan</button>
									<a class="btn btn-danger mt-2 justify-content-end"
										href="<?php echo base_url('admin/DataBarang/DataBarangPusat')?>"><i
											class="bi bi-backspace-fill"></i> Kembali</a>
								</div>
							</div>

						</form>




					</div>
				</div>
			</div>
		</div>
	</main>