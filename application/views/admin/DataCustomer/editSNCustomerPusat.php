<div id="layoutSidenav_content">
	<main>

		<div class="container-fluid px-4">

			<h4 class="mt-4">Edit Data SN Customer</h4>
			<ol class="breadcrumb mb-4">
				<li class="breadcrumb-item"><a href="#">SN Data Customer Pusat</a></li>
				<li class="breadcrumb-item active">Edit Data SN Customer</li>
			</ol>


			<div class="card mb-4">
				<div class="card-header">
					<i class="fas fa-table me-1"></i>
					Data SN Customer Pusat
				</div>
				<div class="card-body">
					<div class="container">

						<?php foreach ($dataMutasi as $data) : ?>
						<form method="POST"
							action="<?php echo base_url('admin/DataCustomer/DataSNCustomerPusat/editDataAksi') ?>"
							enctype="multipart/form-data">

							<div class="row justify-content-center">
								<div class="col-sm-3 mt-2">
									<label for="nama_customer" class="form-label" style="font-weight: bold;"> Nama
										Customer :
										<span class="text-danger">*</span></label>
									<input type="hidden" class="form-control" name="id_barang_mutasi"
										id="id_barang_mutasi"
										value="<?php echo $data['id_barang_mutasi']?>"
										readonly>

									<input type="hidden" class="form-control" name="id_barang" id=""
										value="<?php echo $data['id_barang']?>"
										placeholder="" readonly>

									<input type="hidden" class="form-control" name="nama_barang" id=""
										value="<?php echo $data['nama_barang']?>"
										placeholder="" readonly>

									<input type="hidden" class="form-control" name="SN_old" id=""
										value="<?php echo $data['SN']?>"
										placeholder="" readonly>

									<input type="hidden" class="form-control" name="id_customer" id=""
										value="<?php echo $data['id_customer']?>"
										placeholder="" readonly>

									<input type="hidden" class="form-control" name="tanggal" id=""
										value="<?php echo date('Y-m-d');?>"
										placeholder="" readonly>

									<input type="text" class="form-control" name="" id=""
										value="<?php echo $data['nama_customer']?>"
										placeholder="" readonly>
								</div>

								<div class="col-sm-4 mt-2">
									<label for="pendidikan_pegawai" class="form-label" style="font-weight: bold;">Nama
										Modem : <span class="text-danger">*</span></label>
									<select name="barang" id="barang" class="form-control text-center" required>
										<?php foreach ($dataBarang as $DBarang) : ?>
										<option
											value="<?php echo $DBarang['id_barang']; ?>"
											<?=$DBarang['nama_barang'] == $data['nama_barang'] ? 'selected' : null?>><?php echo $DBarang['nama_barang'];?>
										</option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="col-sm-3 mt-2">
									<label for="SN" class="form-label" style="font-weight: bold;"> SN : <span
											class="text-danger">*</span></label>
									<input type="text" class="form-control" name="SN" id="SN"
										value="<?php echo $data['SN']?>"
										placeholder="Masukkan SN...">
									<div class="bg-danger">
										<small
											class="text-white"><?php echo form_error('SN'); ?></small>
									</div>
								</div>
							</div>

							<div class="row mt-3">
								<div class="col-sm-12 d-flex justify-content-end">
									<button type="submit" class="btn btn-success mt-2 justify-content-end"
										style="margin-right: 5px;"><i class="bi bi-plus-circle"></i> Simpan</button>
									<a class="btn btn-danger mt-2 justify-content-end"
										href="<?php echo base_url('admin/DataCustomer/DataSNCustomerPusat')?>"><i
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