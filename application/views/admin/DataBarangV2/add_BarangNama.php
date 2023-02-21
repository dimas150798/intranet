<div id="layoutSidenav_content">
	<main>

		<div class="container">

			<h4 class="mt-4">Data Barang Gudang</h4>
			<ol class="breadcrumb mb-4">
				<li class="breadcrumb-item"><a href="#">Data Barang Gudang</a></li>
				<li class="breadcrumb-item active">Form</li>
			</ol>

			<div class="card mb-4">
				<div class="card-header">
					<i class="fas fa-table me-1"></i>
					Data Barang <br>
				</div>
				<div class="card-body">
					<div class="container">

						<form method="POST"
							action="<?php echo base_url('admin/DataBarangV2/Add_BarangNama/addData') ?>">

							<div class="row justify-content-center">
								<div class="col-sm-4 mt-2">
									<label for="nama_barang" class="form-label" style="font-weight: bold;"> Nama Barang
										: <span class="text-danger">*</span></label>

									<input type="text" class="form-control" name="nama_barang" id="nama_barang" value=""
										placeholder="Masukkan nama...">
									<div class="bg-danger">
										<small
											class="text-white"><?php echo form_error('nama_barang'); ?></small>
									</div>
								</div>

								<div class="col-sm-4 mt-2 justify-content-center">
									<label for="satuan" class="form-label" style="font-weight: bold;">UOM : <span
											class="text-danger text-center">*</span></label>
									<select name="satuan" id="satuan" class="form-control" required>
										<option disabled selected>-- Pilih UOM --</option>
										<?php foreach ($dataSatuan as $data) : ?>
										<option
											value="<?php echo $data->id_satuan?>">
											<?php echo $data->nama_satuan?>
										</option>
										<?php endforeach; ?>
									</select>
								</div>

								<div class="col-sm-4 mt-2 justify-content-center">
									<label for="satuan" class="form-label" style="font-weight: bold;">Kategori : <span
											class="text-danger text-center">*</span></label>
									<select name="kategori" id="kategori" class="form-control" required>
										<option disabled selected>-- Pilih Ketegori --</option>
										<?php foreach ($dataKategori as $data) : ?>
										<option
											value="<?php echo $data->id_peralatan?>">
											<?php echo $data->kategori_peralatan?>
										</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="row mt-3">
								<div class="col-sm-12 d-flex justify-content-end">
									<button type="submit" class="btn btn-success mt-2 justify-content-end"
										style="margin-right: 5px;"><i class="bi bi-plus-circle"></i> Simpan</button>
									<a class="btn btn-danger mt-2 justify-content-end"
										href="<?php echo base_url('admin/DataBarangV2/Data_BarangNama')?>"><i
											class="bi bi-backspace-fill"></i> Kembali</a>
								</div>
							</div>

						</form>

					</div>
				</div>
			</div>
		</div>
	</main>