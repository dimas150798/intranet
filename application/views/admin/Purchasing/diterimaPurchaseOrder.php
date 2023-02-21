<?php
$months = array(1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember');
date_default_timezone_set("Asia/Jakarta"); # add your city to set local time zone
$now = date('Y-m-d H:i:s');
?>

<div id="layoutSidenav_content">
	<main>


		<div class="container-fluid px-4">

			<h4 class="mt-4">Purchase Order Diterima</h4>
			<ol class="breadcrumb mb-4">
				<li class="breadcrumb-item"><a href="#">Purchase Order Diterima</a></li>
				<li class="breadcrumb-item active">Add Purchase Order Diterima</li>
			</ol>


			<div class="card mb-4">
				<div class="card-header">
					<i class="fas fa-table me-1"></i>
					Data Purchase Order
				</div>
				<div class="card-body">
					<div class="container">

						<?php foreach ($dataOrder as $data) : ?>
						<form method="POST"
							action="<?php echo base_url('admin/Purchasing/DiterimaPurchaseOrder/diterimaOrderAksi') ?>">

							<div class="row justify-content-center">
								<div class="col-sm-4 mt-2">
									<label for="no_purchase_request" class="form-label" style="font-weight: bold;">No
										Purchase
										Order :
										<span class="text-danger">*</span></label>
									<input type="text" class="form-control" name="no_purchase_order"
										id="no_purchase_order"
										value="<?php echo $data->no_purchase_order?>"
										readonly>
									<input type="hidden" class="form-control" name="id_purchasing_order"
										id="id_purchasing_order"
										value="<?php echo $data->id_purchasing_order?>"
										readonly>
									<input type="hidden" class="form-control" name="no_purchase_request"
										id="no_purchase_request"
										value="<?php echo $data->no_purchase_request?>"
										readonly>
									<input type="hidden" class="form-control" name="id_barang" id="id_barang"
										value="<?php echo $data->id_barang?>"
										readonly>
								</div>

								<div class="col-sm-4 mt-2">
									<label for="pegawai" class="form-label text-center" style="font-weight: bold;">
										Nama Barang :
										<span class="text-danger">*</span></label>
									<input type="text" class="form-control" name="no_purchase_order"
										id="no_purchase_order"
										value="<?php echo $data->nama_barang?>"
										readonly>
								</div>

								<div class="col-sm-4 mt-2">
									<label for="No Reff" class="form-label text-center" style="font-weight: bold;">
										No Reff :
										<span class="text-danger">*</span></label>
									<input type="text" class="form-control" name="no_reff" id="no_reff"
										value="<?php echo $data->no_reff?>"
										placeholder="Masukkan no reff..." readonly>
								</div>

								<div class="col-sm-4 mt-2">
									<label for="No Reff" class="form-label text-center" style="font-weight: bold;">
										Nama Supplier :
										<span class="text-danger">*</span></label>
									<input type="text" class="form-control" name="nama_supplier" id="nama_supplier"
										value="<?php echo $data->nama_supplier?>"
										placeholder="Masukkan nama supplier..." readonly>

								</div>

								<div class="col-sm-4 mt-2">
									<label for="No Reff" class="form-label text-center" style="font-weight: bold;">
										Jumlah :
										<span class="text-danger">*</span></label>
									<input type="text" class="form-control" name="quantinty" id="quantinty"
										value="<?php echo $data->quantinty?>"
										readonly>
								</div>

								<div class="col-sm-4 mt-2">
									<label for="No Reff" class="form-label text-center" style="font-weight: bold;">
										Total Harga :
										<span class="text-danger">*</span></label>
									<input type="number" class="form-control" name="sub_total" id="sub_total"
										value="<?php echo number_format($data->sub_total, 0, ',', '.')?>"
										placeholder="Masukkan total harga..." readonly>
								</div>

								<div class="col-sm-4 mt-2">
									<label for="pegawai" class="form-label text-center" style="font-weight: bold;">
										Nama Penerima :
										<span class="text-danger">*</span></label>
									<select name="pegawai" id="pegawai" class="form-control text-center" required>
										<option disabled selected>-- Nama Penerima --</option>
										<?php foreach ($dataPegawai as $data) : ?>
										<option
											value="<?php echo $data['id_pegawai']?>">
											<?php echo $data['nama_pegawai']?>
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
							</div>

							<div class="row mt-3">
								<div class="col-sm-12 d-flex justify-content-end">
									<button type="submit" class="btn btn-success mt-2 justify-content-end"
										style="margin-right: 5px;"><i class="bi bi-plus-circle"></i> Simpan</button>
									<a class="btn btn-danger mt-2 justify-content-end"
										href="<?php echo base_url('admin/Purchasing/DataPurchaseOrder')?>"><i
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