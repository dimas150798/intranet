<?php
            if (!function_exists('changeDateFormat')) {
                function changeDateFormat($format='d-m-Y', $givenDate=null)
                {
                    return date($format, strtotime($givenDate));
                }
            }
        ?>

<div id="layoutSidenav_content">
	<main>

		<div class="container">
			<h4 class="mt-4" style="margin-left: 5px; margin-right: 5px;">Data Barang Mutasi</h4>
			<ol class="breadcrumb" style="margin-left: 5px; margin-right: 5px;">
				<li class="breadcrumb-item"><a href="#">Data Barang Gudang</a></li>
				<li class="breadcrumb-item active">Tables</li>
			</ol>

			<!-- <a class="btn btn-success mb-3"
            href="<?php echo base_url('admin/DataBarangV2/Add_BarangNama') ?>"><i
				class="bi bi-plus-circle"></i> Tambah Data</a> -->

			<div class="card mb-3">
				<div id="kwitansiClose" class="card-header">
					<i class="fas fa-table me-1"></i>
					Data Barang Mutasi <br>
					<h5 class="text-center font-weight-light mt-2 mb-2">
						<?php echo $this->session->flashdata('pesan'); ?>
					</h5>
				</div>
				<div id="kwitansiClose" class="card-body">
					<table class="table table-bordered" id="datatablesSimple" width="100%">
						<thead>
							<tr>
								<th width="5%" class="text-center">No</th>
								<th width="20%">Nama Barang</th>
								<th width="5%" class="text-center">Jumlah</th>
								<th width="10%" class="text-center">Tanggal</th>
								<th width="20%">Nama Pegawai</th>
								<th width="20%">Nama Customer</th>
								<th width="10%" class="text-center">Status Barang</th>
								<th width="15%" class="text-center">Keterangan</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
                        foreach ($dataMutasi as $data) :
                        ?>

							<tr>
								<td class="text-center">
									<?php echo $no++ ?>
								</td>
								<td>
									<?php echo $data['nama_barang']?>
								</td>
								<td class="text-center">
									<?php echo $data['jumlah']?>
								</td>
								<td class="text-center">
									<?php echo changeDateFormat('d-m-Y', $data['tanggal'])?>
								</td>
								<td>
									<?php echo $data['nama_pegawai']?>
								</td>
								<td>
									<?php echo $data['nama_customer']?>
								</td>
								<td class="text-center">
									<?php echo $data['nama_status']?>
								</td>
								<td class="text-center">
									<?php echo $data['keterangan']?>
								</td>

								<!-- <td class="text-center">
									<a onclick="return confirm('Yakin Menghapus Data')" class="btn btn-sm btn-danger"
										href="<?php echo base_url('admin/DataBarangV2/Data_BarangMutasi/deleteData/' . $data['id_stockKeluar']) ?>"><i
									class="fas fa-trash"></i></a>
								</td> -->

							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>


	</main>