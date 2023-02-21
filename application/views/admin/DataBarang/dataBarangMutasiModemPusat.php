<div id="layoutSidenav_content">
	<main>

		<div class="card mb-3 mt-2" style="margin-bottom: 10px; margin-left: 5px; margin-right: 5px;">

			<h4 class="mt-4" style="margin-left: 18px; margin-right: 5px;">Data Barang Mutasi Modem</h4>
			<ol class="breadcrumb" style="margin-bottom: 10px; margin-left: 18px; margin-right: 5px;">
				<li class="breadcrumb-item"><a href="#">Data Barang Mutasi Modem</a></li>
				<li class="breadcrumb-item active">Tables</li>
			</ol>

			<div class="card-body">
				<form method="POST"
					action="<?php echo base_url('admin/DataBarang/DataBarangMutasiModemPusat/index') ?>">

					<div class="row">
						<div class="col-md-2">
							<label for="tahun">Tahun : </label>
							<select class="form-control text-center" name="tahun" required>
								<?php
                                if ($tahun == null) {
                                    echo '<option value="" disabled selected>-- Pilih Tahun --</option>';
                                } else {
                                    echo '<option value="" disabled>-- Pilih Tahun --</option>';

                                    for ($i=2022; $i <= 2023; $i++) {
                                        if ($tahun == $i) {
                                            echo '<option selected value='.$i.'>'.date("Y", mktime(0, 0, 0, 1, 1, $i)).'</option>'."\n";
                                        } else {
                                            echo '<option value='.$i.'>'.date("Y", mktime(0, 0, 0, 1, 1, $i)).'</option>'."\n";
                                        }
                                    }
                                }
                                ?>
							</select>
						</div>

						<div class="col-md-2">
							<label for="bulan">Bulan : </label>
							<select class="form-control text-center" name="bulan" required>
								<?php
                                if ($bulan == null) {
                                    echo '<option value="" disabled selected>-- Pilih Bulan --</option>';
                                } else {
                                    echo '<option value="" disabled>-- Pilih Bulan --</option>';

                                    for ($m=1; $m <= 12; ++$m) {
                                        if ($bulan == $m) {
                                            echo '<option selected value='.$m.'>'.date('F', mktime(0, 0, 0, $m, 1)).'</option>'."\n";
                                        } else {
                                            echo '<option  value='.$m.'>'.date('F', mktime(0, 0, 0, $m, 1)).'</option>'."\n";
                                        }
                                    }
                                }

                                ?>
							</select>
						</div>

						<div class="col-md-8 mt-auto justify-content-end d-flex">
							<button type="submit" class="btn btn-info mt-2 justify-content-start"> <i
									class="fas fa-eye"></i>
								Tampilkan</button>
							<a class="btn btn-success mt-2 justify-content-end"
								href="<?php echo base_url('admin/DataBarang/DataBarangMutasiPusat') ?>"
								style="margin-left: 5px;"><i class="bi bi-box-seam-fill"> </i> Data
								Barang</a>

						</div>
					</div>

				</form>
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

		<div id="kwitansiClose" class="card" style="margin-bottom: 10px; margin-left: 5px; margin-right: 5px;">
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
							<th width="10%" class="text-center">Tanggal</th>
							<th width="15%" class="text-center">Stock Out</th>
							<th width="5%" class="text-center">UOM</th>
							<th width="10%" class="text-center">Opsi</th>
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
								<?php echo $data['satuan']?>
							</td>

							<td class="text-center">
								<a onclick="return confirm('Yakin Menghapus Data')" class="btn btn-sm btn-danger"
									href="<?php echo base_url('admin/DataBarang/DataBarangMutasiModemPusat/deleteData/' . $data['id_barang_mutasi']) ?>"><i
										class="fas fa-trash"></i></a>
							</td>

						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>


	</main>