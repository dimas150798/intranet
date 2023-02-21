<!-- <div id="layoutSidenav_content">
	<main>
		<div class="container-fluid px-4">
			<div class="row">
				<div class="col-xl-3 col-md-6">
					<div class="card shadow bg-primary text-white mb-4 mt-4">
						<div class="row">
							<div class="col-sm-12 mt-2 mb-4 fw-bold" style="text-align: center;">Data Barang :</div>
							<div class="col-sm-6 fw-bold" style="font-size: 20px; text-align: center;"><i
									class="fas fa-user fa-2x text-gray-300"></i></div>
							<div class="col-sm-6 mb-4 fw-bold" style="font-size: 30px; text-align: center;">
								<?php echo $jumlahBarang ?>
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
				<?php echo $jumlahBarangRestock ?>
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
			<div class="col-sm-12 mt-2 mb-4 fw-bold" style="text-align: center;">Total Customer :</div>
			<div class="col-sm-6 fw-bold" style="font-size: 20px; text-align: center;"><i
					class="fas fa-user fa-2x text-gray-300"></i></div>
			<div class="col-sm-6 mb-4 fw-bold" style="font-size: 30px; text-align: center;">
				<?php echo $jumlahCustomer ?>
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

<div class="col-xl-12 col-md-12">
	<div class="card shadow bg-secondary text-white mb-4 mt-4">

		<div id="kwitansiClose" class="card">
			<div id="kwitansiClose" class="card-header text-black">
				<i class="fas fa-table me-1"></i>
				Data Peminjaman Barang Pending <br>
			</div>
			<div id="kwitansiClose" class="card-body">
				<table class="table table-bordered" id="datatablesSimple" width="100%">
					<thead>
						<tr>
							<th width="5%" class="text-center">No</th>
							<th width="20%">Nama Pegawai</th>
							<th width="20%">Nama Barang</th>
							<th width="10%" class="text-center">Tanggal</th>
							<th width="10%" class="text-center">Status</th>
							<th width="10%" class="text-center">Keterangan</th>
							<th width="10%" class="text-center">Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
                                            foreach ($peminjamanBarangPending as $data) :
                                        ?>

						<tr>
							<td class="text-center">
								<?php echo $no++ ?>
							</td>
							<td>
								<?php echo $data['nama_pegawai']?>
							</td>
							<td>
								<?php echo $data['nama_barang']?>
							</td>
							<td class="text-center">
								<?php echo changeDateFormat('d-m-Y', $data['tanggal'])?>
							</td>
							<td class="text-center">
								<?php
                                                    if ($data['id_status'] == 1) {
                                                        echo '<span class="badge bg-danger">PENDING</span>';
                                                    } else {
                                                        echo '<span class="badge bg-success">SUCCESS</span>';
                                                    }
                                                ?>
							</td>
							<td class="text-center">
								<?php echo $data['keterangan']?>
							</td>
							<td class="text-center">
								<a class="btn btn-sm btn-primary"
									href="<?php echo base_url('admin/DataPeminjaman/DataPeminjamanBarang/pengembalianBarang/' . $data['id_peminjaman_barang']) ?>"><i
										class="fas fa-check"></i></a>
							</td>



						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>

</div>

</main> -->