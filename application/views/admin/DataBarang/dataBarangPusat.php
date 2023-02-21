<div id="layoutSidenav_content">
	<main>

		<div class="container">
			<h4 class="mt-4" style="margin-left: 5px; margin-right: 5px;">Data Barang Pusat</h4>
			<ol class="breadcrumb mb-4" style="margin-bottom: 10px; margin-left: 5px; margin-right: 5px;">
				<li class="breadcrumb-item"><a href="#">Data Barang Pusat</a></li>
				<li class="breadcrumb-item active">Tables</li>
			</ol>
		</div>

		<div class="card mb-3">
			<?php
            if (!function_exists('changeDateFormat')) {
                function changeDateFormat($format='d-m-Y', $givenDate=null)
                {
                    return date($format, strtotime($givenDate));
                }
            }
        ?>

			<div id="kwitansiClose" class="card" style="margin-bottom: 10px; margin-left: 5px; margin-right: 5px;">
				<div id="kwitansiClose" class="card-header">
					<i class="fas fa-table me-1"></i>
					Data Barang Pusat <br>
					<a class="btn btn-success mt-2 ml-auto"
						href="<?php echo base_url('admin/DataBarang/AddBarangPusat') ?>"
						style="margin-top: 10px;"><i class="bi bi-plus-circle"></i> Tambah Data</a>
					<a class="btn btn-primary mt-2 ml-auto"
						href="<?php echo base_url('admin/DataBarang/DataBarangModemPusat') ?>"
						style="margin-top: 10px;"><i class="bi bi-modem"></i> Modem</a> <br>
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
								<th width="10%" class="text-center">Tanggal</th>
								<th width="5%" class="text-center">Stock</th>
								<th width="15%" class="text-center">Stock Out</th>
								<th width="5%" class="text-center">UOM</th>
								<th width="20%" class="text-center">Opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
                        foreach ($dataBarang as $data) :
                        ?>

							<tr>
								<td class="text-center">
									<?php echo $no++ ?>
								</td>
								<td>
									<?php echo $data['nama_barang']?>
								</td>
								<td class="text-center">
									<?php echo changeDateFormat('d-m-Y', $data['tanggal'])?>
								</td>
								<td class="text-center">
									<?php echo $data['jumlah']?>
								</td>

								<td class="text-center">
									<?php
                                if ($data['jumlahMutasi'] == null) {
                                    echo 0;
                                } else {
                                    echo $data['jumlahMutasi'];
                                }
                            ?>
								</td>

								<td class="text-center">
									<?php echo $data['satuan']?>
								</td>

								<td class="text-center">
									<a class="btn btn-sm btn-success"
										href="<?php echo base_url('admin/DataBarang/RestockBarangPusat/restockBarang/' . $data['id_barang']) ?>"><i
											class="fa fa-plus-square"></i></a>
									<a class="btn btn-sm btn-warning"
										href="<?php echo base_url('admin/DataBarang/MutasiBarangPusat/mutasiBarang/' . $data['id_barang']) ?>"><i
											class="fa fa-minus-square"></i></a>
									<a onclick="return confirm('Yakin Menghapus Data')" class="btn btn-sm btn-danger"
										href="<?php echo base_url('admin/DataBarang/DataBarangPusat/deleteData/' . $data['id_barang']) ?>"><i
											class="fas fa-trash"></i></a>
								</td>

							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>


	</main>