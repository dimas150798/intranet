<div id="layoutSidenav_content">
	<main>

		<div class="container">
			<h4 class="mt-4" style="margin-left: 5px; margin-right: 5px;">Data Pegawai</h4>
			<ol class="breadcrumb " style="margin-bottom: 10px; margin-left: 5px; margin-right: 5px;">
				<li class="breadcrumb-item"><a href="#">Data Pegawai</a></li>
				<li class="breadcrumb-item active">Tables</li>
			</ol>

			<a class="btn btn-success mb-3"
				href="<?php echo base_url('admin/DataPegawai/AddPegawai') ?>"><i
					class="bi bi-plus-circle"></i> Tambah Data</a>

			<div class="card mb-3">
				<div id="kwitansiClose" class="card-header">
					<i class="fas fa-table me-1"></i>
					Data Pegawai <br>

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
								<th width="25%" class="text-center">Nik Pegawai</th>
								<th width="10%" class="text-center">Telepon</th>
								<th width="25%" class="text-center">Jabatan</th>
								<th width="5%" class="text-center">Opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
                        foreach ($dataPegawai as $data) :
                        ?>

							<tr>
								<td class="text-center">
									<?php echo $no++ ?>
								</td>
								<td>
									<?php echo $data['nama_pegawai']?>
								</td>
								<td class="text-center">
									<?php echo $data['NIK']?>
								</td>
								<td class="text-center">
									<?php echo $data['no_telpon']?>
								</td>
								<td class="text-center">
									<?php echo $data['jabatan']?>
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
												href="<?php echo base_url('admin/DataPegawai/EditPegawai/editData/' . $data['id_pegawai']) ?>"><i
													class="bi bi-pencil-square"></i> Edit</a>
											<a onclick="return confirm('Yakin Menghapus Data')"
												class="dropdown-item text-black"
												href="<?php echo base_url('admin/DataPegawai/DataPegawai/deleteData/' . $data['id_pegawai']) ?>"><i
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