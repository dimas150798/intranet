<div id="layoutSidenav_content">
	<main>

		<div class="container-fluid px-4">

			<h4 class="mt-4">Edit Data Customer</h4>
			<ol class="breadcrumb mb-4">
				<li class="breadcrumb-item"><a href="#">Data Customer Pusat</a></li>
				<li class="breadcrumb-item active">Edit Data Customer</li>
			</ol>


			<div class="card mb-4">
				<div class="card-header">
					<i class="fas fa-table me-1"></i>
					Data Customer Pusat
				</div>
				<div class="card-body">
					<div class="container">

						<?php foreach ($dataCustomer as $data) : ?>
						<form method="POST"
							action="<?php echo base_url('admin/DataCustomer/EditCustomerPusat/editDataAksi') ?>"
							enctype="multipart/form-data">

							<div class="row justify-content-center">
								<div class="col-sm-3 mt-2">
									<label for="nama_customer" class="form-label" style="font-weight: bold;"> Nama :
										<span class="text-danger">*</span></label>
									<input type="hidden" class="form-control" name="id_customer" id="id_customer"
										value="<?php echo $data->id_customer?>"
										readonly>

									<input type="text" class="form-control" name="nama_customer" id="nama_customer"
										value="<?php echo $data->nama_customer?>"
										placeholder="Masukkan nama...">
									<div class="bg-danger">
										<small
											class="text-white"><?php echo form_error('nama_customer'); ?></small>
									</div>
								</div>
								<div class="col-sm-3 mt-2">
									<label for="pembelian_paket" class="form-label" style="font-weight: bold;">Paket :
										<span class="text-danger">*</span></label>
									<select name="pembelian_paket" class="form-control text-center" required>
										<option selected disabled>-- Pilih Paket --</option>
										<?php foreach ($dataPaket as $datapaket) : ?>
										<option
											value="<?php echo $datapaket->nama_paket; ?>"
											<?=$data->pembelian_paket == $datapaket->nama_paket ? 'selected' : null?>><?php echo $datapaket->nama_paket;?>
										</option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="col-sm-3 mt-2">
									<label for="nik_customer" class="form-label" style="font-weight: bold;">NIK Customer
										: <span class="text-danger">*</span></label>
									<input type="number" class="form-control" name="nik_customer" id="nik_customer"
										value="<?php echo $data->nik_customer?>"
										placeholder="Masukkan NIK...">
									<div class="bg-danger">
										<small
											class="text-white"><?php echo form_error('nik_customer'); ?></small>
									</div>
								</div>
								<div class="col-sm-3 mt-2">
									<label for="tlp_customer" class="form-label" style="font-weight: bold;"> Telephon :
										<span class="text-danger">*</span></label>
									<input type="number" class="form-control" name="tlp_customer" id="tlp_customer"
										value="<?php echo $data->tlp_customer?>"
										placeholder="Masukkan telephon...">
									<div class="bg-danger">
										<small
											class="text-white"><?php echo form_error('tlp_customer'); ?></small>
									</div>
								</div>
							</div>

							<div class="row justify-content-center">

								<div class="col-sm-3 mt-2">
									<label for="alamat_customer" class="form-label" style="font-weight: bold;"> Alamat :
										<span class="text-danger">*</span></label>
									<input type="text" class="form-control" name="alamat_customer" id="alamat_customer"
										value="<?php echo $data->alamat_customer?>"
										placeholder="Masukkan alamat...">
									<div class="bg-danger">
										<small
											class="text-white"><?php echo form_error('alamat_customer'); ?></small>
									</div>
								</div>
								<div class="col-sm-3 mt-2">
									<label for="tanggal" class="form-label" style="font-weight: bold;"> Tanggal : <span
											class="text-danger">*</span></label>
									<input type="date" class="form-control" name="tanggal" id="tanggal"
										value="<?php echo $data->date?>"
										placeholder="Masukkan alamat...">
								</div>
								<div class="col-sm-6 mt-2">
									<label for="kota" class="form-label" style="font-weight: bold;"> Kota / Kabupaten :
										<span class="text-danger">*</span></label>
									<select name="kota" id="kota" class="form-control text-center" required>
										<option selected disabled>-- Pilih Kota / Kabupaten --</option>
										<?php foreach ($dataKotKab as $datakotkab) : ?>
										<option
											value="<?php echo $datakotkab->id_kota; ?>"
											<?=$data->id_kota == $datakotkab->id_kota ? 'selected' : null?>><?php echo $datakotkab->nama_kota;?>
										</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="row justify-content-center">
								<div class="col-sm-6 mt-2">
									<label for="kecamatan" class="form-label" style="font-weight: bold;">Kecamatan :
										<span class="text-danger">*</span></label>
									<select name="kecamatan" id="kecamatan" class="form-control text-center" required>
										<option selected disabled>-- Pilih Kecamatan --</option>
										<?php foreach ($dataKecamatan as $datakecamatan) : ?>
										<option
											value="<?php echo $datakecamatan->id_kecamatan; ?>"
											<?=$data->id_kecamatan == $datakecamatan->id_kecamatan ? 'selected' : null?>><?php echo $datakecamatan->nama_kecamatan;?>
										</option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="col-sm-6 mt-2">
									<label for="kelurahan" class="form-label" style="font-weight: bold;">Kelurahan :
										<span class="text-danger">*</span></label>
									<select name="kelurahan" id="kelurahan" class="form-control text-center" required>
										<option selected disabled>-- Pilih Kelurahan --</option>
										<?php foreach ($dataKelurahan as $datakelurahan) : ?>
										<option
											value="<?php echo $datakelurahan->id_kelurahan; ?>"
											<?=$data->id_kelurahan == $datakelurahan->id_kelurahan ? 'selected' : null?>><?php echo $datakelurahan->nama_kelurahan;?>
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
										href="<?php echo base_url('admin/DataCustomer/DataCustomerPusat')?>"><i
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