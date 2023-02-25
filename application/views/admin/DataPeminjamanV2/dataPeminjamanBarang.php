<?php
$months = array(1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember');
error_reporting(0);
ini_set('display_errors', 0);
?>

<div id="layoutSidenav_content">
	<main>

		<div class="card mb-3 mt-2" style="margin-bottom: 10px; margin-left: 5px; margin-right: 5px;">

			<h4 class="mt-4" style="margin-left: 18px; margin-right: 5px;">Data Peminjaman Barang</h4>
			<ol class="breadcrumb" style="margin-bottom: 10px; margin-left: 18px; margin-right: 5px;">
				<li class="breadcrumb-item"><a href="#">Data Peminjaman Barang</a></li>
				<li class="breadcrumb-item active">Tables</li>
			</ol>

			<div class="card-body">

				<form class="form-inline">


					<div class="row">

						<div class="col-md-4">
							<label for="start_date" class="form-label" style="font-weight: bold;">Tanggal : <span
									class="text-danger">*</span></label>
							<input type="date" name="day" id="day" class="form-control"
								value="<?php echo $day?>">
						</div>

						<div class="col-md-8 mt-auto justify-content-end d-flex">
							<button type="submit" class="btn btn-info mt-2 justify-content-start"> <i
									class="fas fa-eye"></i>
								Tampilkan</button>
							<a class="btn btn-primary mt-2 justify-content-end"
								href="<?php echo base_url('admin/DataPeminjamanV2/DataBuktiPeminjamanBarang') ?>"
								style="margin-left: 5px;"><i class="bi bi-images"></i> Bukti Foto</a>
							<a class="btn btn-success mt-2 justify-content-end"
								href="<?php echo base_url('admin/DataPeminjamanV2/AddPeminjamanBarang') ?>"
								style="margin-left: 5px;"><i class="bi bi-plus-circle"></i> Tambah Data</a>
						</div>

					</div>
				</form>
			</div>
		</div>

		<?php
         if ((isset($_GET['day']) && $_GET['day'] != '')) {
             $day    = $_GET['day'];
             $this->session->set_userdata('day', $day);
         } else {
             $day = $this->session->userdata('day');
         }

         $pecahDay      = explode("-", $day);

         $tahun         = $pecahDay[0];
         $bulan         = $pecahDay[1];
         $dayTanggal    = $pecahDay[2];
      ?>

		<?php
                if (!function_exists('changeDateFormat')) {
                    function changeDateFormat($format='d-m-Y', $givenDate=null)
                    {
                        return date($format, strtotime($givenDate));
                    }
                }
            ?>

		<div id="kwitansiClose" class="alert alert-info mt-2"
			style="margin-bottom: 10px; margin-left: 5px; margin-right: 5px;">

			<div class="row">

				<div class="col">
					<div class="card border-primary shadow text-black">
						<div class="row">
							<div class="col">
								<div class="fw-bold mt-2 mb-2" style="font-size: 14px; text-align: center;">Tahun :
								</div>
							</div>
							<div class="col">
								<div class="fw-bold mt-2 mb-2" style="font-size: 14px; text-align: center;">
									<?php echo $tahun; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card border-primary shadow text-black">
						<div class="row">
							<div class="col">
								<div class="fw-bold mt-2 mb-2" style="font-size: 13px; text-align: center;">Bulan :
								</div>
							</div>
							<div class="col">
								<div class="fw-bold mt-2 mb-2" style="font-size: 13px; text-align: center;">
									<?php echo $months[(int)$bulan]; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card border-primary shadow text-black">
						<div class="row">
							<div class="col">
								<div class="fw-bold mt-2 mb-2" style="font-size: 13px; text-align: center;">Tanggal :
								</div>
							</div>
							<div class="col">
								<div class="fw-bold mt-2 mb-2" style="font-size: 13px; text-align: center;">
									<?php echo $dayTanggal; ?>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

			<h5 class="text-center font-weight-light mt-2 mb-2">
				<?php echo $this->session->flashdata('pesan'); ?>
			</h5>
		</div>
		<div id="kwitansiClose" class="card" style="margin-bottom: 10px; margin-left: 5px; margin-right: 5px;">
			<div id="kwitansiClose" class="card-header">
				<i class="fas fa-table me-1"></i>
				Data Barang Mutasi
			</div>
			<div id="kwitansiClose" class="card-body">
				<table class="table table-bordered" id="datatablesSimple" width="100%">
					<thead>
						<tr>
							<th width="5%" class="text-center">No</th>
							<th width="20%">Nama Barang</th>
							<th width="20%">Peminjam</th>
							<th width="10%" class="text-center">Tanggal</th>
							<th width="10%" class="text-center">Jumlah</th>
							<th width="10%" class="text-center">Status</th>
							<th width="10%" class="text-center">Keterangan</th>
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
							<td>
								<?php echo $data['nama_pegawai']?>
							</td>
							<td class="text-center">
								<?php echo changeDateFormat('d-m-Y', $data['tanggal'])?>
							</td>
							<td class="text-center">
								<?php echo $data['jumlah']?>
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
									href="<?php echo base_url('admin/DataPeminjamanV2/DataPeminjamanBarang/pengembalianBarang/' . $data['id_peminjaman_barang']) ?>"><i
										class="fas fa-check"></i></a>
							</td>

						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>


	</main>