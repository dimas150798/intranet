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
			<h4 class="mt-4" style="margin-left: 5px; margin-right: 5px;">Data Detail Barang</h4>
			<ol class="breadcrumb" style="margin-left: 5px; margin-right: 5px;">
				<li class="breadcrumb-item"><a href="#">Data Detail Barang</a></li>
				<li class="breadcrumb-item active">Tables</li>
			</ol>

			<!-- <a class="btn btn-success mb-3"
            href="<?php echo base_url('admin/DataBarangV2/Add_StockBarang') ?>"><i
				class="bi bi-plus-circle"></i> Tambah Data</a> -->

			<div class="card mb-3">
				<div id="kwitansiClose" class="card-header">
					<i class="fas fa-table me-1"></i>
					Data Barang <br>
					<h5 class="text-center font-weight-light mt-2 mb-2">
						<?php echo $this->session->flashdata('pesan'); ?>
					</h5>
				</div>
				<div id="kwitansiClose" class="card-body">
					<table class="table table-bordered" id="datatablesSimple" width="100%">
						<thead>
							<tr>
								<th width="5%" class="text-center">No</th>
								<th width="10%">Nama Barang</th>
								<th width="7%">Kode Barang</th>
								<th width="7%">Jumlah</th>
								<th width="7%" class="text-center">Status</th>
								<th width="7%" class="text-center">Kondisi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
                        foreach ($dataStock as $data) :
                        ?>

							<tr>
								<td class="text-center">
									<?php echo $no++ ?>
								</td>
								<td>
									<?php echo $data['nama_barang']?>
								</td>
								<td>
									<?php echo $data['kode_barang']?>
								</td>
								<td>
									<?php echo $data['jumlah']?>
								</td>
								<td class="text-center">
									<?php echo $data['nama_status']?>
								</td>
								<td class="text-center">
									<?php echo $data['nama_keadaan']?>
								</td>

							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>


	</main>