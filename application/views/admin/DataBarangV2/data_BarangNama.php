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
			<h4 class="mt-4" style="margin-left: 5px; margin-right: 5px;">Data Barang Gudang</h4>
			<ol class="breadcrumb" style="margin-left: 5px; margin-right: 5px;">
				<li class="breadcrumb-item"><a href="#">Data Barang Gudang</a></li>
				<li class="breadcrumb-item active">Tables</li>
			</ol>

			<a class="btn btn-success mb-3"
				href="<?php echo base_url('admin/DataBarangV2/Add_BarangNama') ?>"><i
					class="bi bi-plus-circle"></i> Tambah Data</a>

			<a class="btn btn-success mb-3"
				href="<?php echo base_url('admin/DataBarangV2/Add_StockBarang') ?>"><i
					class="bi bi-plus-circle"></i> Tambah Stock</a>

			<div class="card mb-3">
				<div id="kwitansiClose" class="card-header">
					<i class="fas fa-table me-1"></i>
					Data Barang Gudang <br>
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
								<th width="20%">Kategori</th>
								<th width="20%">Satuan</th>
								<th width="5%" class="text-center">Opsi</th>
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
								<td>
									<?php echo $data['kategori_peralatan']?>
								</td>
								<td>
									<?php echo $data['nama_satuan']?>
								</td>

								<td class="text-center">
									<a class="btn btn-sm btn-primary"
										href="<?php echo base_url('admin/DataBarangV2/Edit_BarangNama/editData/' . $data['id_barang']) ?>"><i
											class="bi bi-pencil-square"></i></a>
									<a onclick="return confirm('Yakin Menghapus Data')" class="btn btn-sm btn-danger"
										href="<?php echo base_url('admin/DataBarangV2/Data_BarangNama/deleteData/' . $data['id_barang']) ?>"><i
											class="fas fa-trash"></i></a>
								</td>

							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>


	</main>