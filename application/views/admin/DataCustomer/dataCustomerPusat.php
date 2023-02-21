<?php
$months = array(1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember');
?>

<div id="layoutSidenav_content">
	<main>

		<div class="container">
			<h4 class="mt-4" style="margin-left: 5px; margin-right: 5px;">Data Customer Pusat</h4>
			<ol class="breadcrumb mb-4" style="margin-left: 5px; margin-right: 5px;">
				<li class="breadcrumb-item"><a href="#">Data Customer Pusat</a></li>
				<li class="breadcrumb-item active">Tables</li>
			</ol>

			<a class="btn btn-success mb-3"
				href="<?php echo base_url('admin/DataCustomer/AddCustomerPusat') ?>"><i
					class="bi bi-plus-circle"></i> Tambah Data</a>

			<div class="card mb-3">
				<div id="kwitansiClose" class="card-header">
					<i class="fas fa-table me-1"></i>
					Data Customer Pusat <br>
					<h5 class="text-center font-weight-light mt-2 mb-2">
						<?php echo $this->session->flashdata('pesan'); ?>
					</h5>
				</div>
				<div id="kwitansiClose" class="card-body">
					<table class="table table-bordered" id="datatablesSimple" width="100%">
						<thead>
							<tr>
								<th width="5%" class="text-center">No</th>
								<th width="20%">Nama</th>
								<th width="10%">Paket</th>
								<th width="20%">Alamat</th>
								<th width="10%" class="text-center">Telepon</th>
								<th width="5%" class="text-center">Opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
                            foreach ($dataCustomer as $data) :
                            ?>

							<tr>
								<td class="text-center">
									<?php echo $no++ ?>
								</td>
								<td>
									<?php echo $data['nama_customer']?>
								</td>
								<td>
									<?php echo $data['pembelian_paket']?>
								</td>
								<td>
									<?php echo $data['alamat_customer']?>,
									<?php echo $data['nama_kota']?>,
									<?php echo $data['nama_kecamatan']?>,
									<?php echo $data['nama_kelurahan']?>
								</td>
								<td class="text-center">
									<?php echo $data['tlp_customer']?>
								</td>

								<td class="text-center">
									<div class="btn-group">
										<button type="button" class="btn btn-sm btn-info dropdown-toggle"
											data-bs-toggle="dropdown" data-bs-target="#dropdown" aria-expanded="false"
											aria-controls="dropdown">
											Opsi
										</button>
										<div class="dropdown-menu text-black" style="background-color:aqua;">
											<a class="dropdown-item text-black"
												href="<?php echo base_url('admin/DataCustomer/EditCustomerPusat/editData/' . $data['id_customer']) ?>"><i
													class="bi bi-pencil-square"></i> Edit</a>
											<a onclick="return confirm('Yakin Terminate Data ?')"
												class="dropdown-item text-black"
												href="<?php echo base_url('admin/DataCustomer/AddCustomerTerminate/addTerminate/' . $data['id_customer']) ?>"><i
													class="bi bi-wifi-off"> </i> Terminate</a>
											<a onclick="return confirm('Yakin Menghapus Data')"
												class="dropdown-item text-black"
												href="<?php echo base_url('admin/DataCustomer/DataCustomerPusat/deleteData/' . $data['id_customer']) ?>"><i
													class="bi bi-trash3-fill"></i> Hapus</a>
										</div>
								</td>

							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>

	</main>