<?php
$months = array(1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember');
date_default_timezone_set("Asia/Jakarta"); # add your city to set local time zone
$now = date('Y-m-d H:i:s');
?>

<div id="layoutSidenav_content">
	<main>


		<div class="container-fluid px-4">

			<h4 class="mt-4">Purchase Request</h4>
			<ol class="breadcrumb mb-4">
				<li class="breadcrumb-item"><a href="#">Purchase Request</a></li>
				<li class="breadcrumb-item active">Add Purchase Request</li>
			</ol><br>
			<h5 class="text-center font-weight-light mt-2 mb-2">
				<?php echo $this->session->flashdata('pesan'); ?>
			</h5>

			<div class="card mb-4">
				<div class="card-header">
					<i class="fas fa-table me-1"></i>
					Data Purchase Request
				</div>
				<div class="card-body">
					<div class="container">

						<form method="POST"
							action="<?php echo base_url('admin/Purchasing/AddPurchaseRequestMore/addDataMore') ?>">

							<div class="row justify-content-center">
								<div class="col-sm-4 mt-2">
									<label for="no_purchase_request" class="form-label" style="font-weight: bold;">No
										Purchase
										Order :
										<span class="text-danger">*</span></label>
									<input type="text" class="form-control" name="no_purchase_request"
										id="no_purchase_request"
										value="<?php echo $this->session->userdata('no_purchase_request')?>"
										readonly>
									<input type="hidden" class="form-control" name="no_purchase_order"
										id="no_purchase_order"
										value="<?php echo $this->session->userdata('no_purchase_order')?>"
										readonly>
								</div>

								<div class="col-sm-4 mt-2">
									<label for="pegawai" class="form-label text-center" style="font-weight: bold;">
										Nama Request :
										<span class="text-danger">*</span></label>
									<input type="hidden" class="form-control" name="id_pegawai" id="id_pegawai"
										value="<?php echo $this->session->userdata('id_pegawai')?>"
										readonly>
									<input type="text" class="form-control" name="" id=""
										value="<?php echo $this->session->userdata('nama_pegawai')?>"
										readonly>
								</div>

								<div class="col-sm-4 mt-2">
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


								<div class="col-sm-4 mt-2">
									<label for="tanggal" class="form-label" style="font-weight: bold;">Tanggal :
										<span class="text-danger">*</span></label>
									<input type="date" class="form-control" name="tanggal" id="tanggal" value=""
										required>
								</div>

								<div class="col-sm-4 mt-2">
									<label for="quantinty" class="form-label" style="font-weight: bold;"> Jumlah Barang
										:
										<span class="text-danger">*</span></label>
									<input type="number" class="form-control" name="quantinty" id="quantinty" value=""
										placeholder="Masukkan jumlah barang...">
									<div class="bg-danger">
										<small
											class="text-white"><?php echo form_error('quantinty'); ?></small>
									</div>
								</div>


								<div class="col-sm-4 mt-2">
									<label for="keterangan" class="form-label" style="font-weight: bold;"> Keterangan
										:</label>
									<input type="text" class="form-control" name="keterangan" id="keterangan" value=""
										placeholder="Masukkan keterangan ...">
								</div>
							</div>




							<div class="row mt-3">
								<div class="col-sm-12 d-flex justify-content-end">
									<button type="submit" class="btn btn-success mt-2 justify-content-end"
										style="margin-right: 5px;"><i class="bi bi-plus-circle"></i> Simpan</button>

									<a class="btn btn-primary mt-2 justify-content-end" style="margin-right: 5px;"
										href="<?php echo base_url('admin/Purchasing/AddPurchaseRequest') ?>"><i
											class="bi bi-plus-circle"></i> Request Baru</a>

									<a class="btn btn-danger mt-2 justify-content-end"
										href="<?php echo base_url('admin/Purchasing/DataPurchaseRequest')?>"><i
											class="bi bi-backspace-fill"></i> Kembali</a>
								</div>
							</div>

						</form>


					</div>
				</div>
			</div>
		</div>
	</main>