
<div id="layoutSidenav_content">
               <main>
                  
                  <div class="container-fluid px-4">

                     <h4 class="mt-4">Tambah Data Pegawai</h4>
                     <ol class="breadcrumb mb-4">
                           <li class="breadcrumb-item"><a href="#">Data Pegawai</a></li>
                           <li class="breadcrumb-item active">Tambah Data Pegawai</li>
                     </ol>
                        

                        <div class="card mb-4">
                           <div class="card-header">
                              <i class="fas fa-table me-1"></i>
                              Data Pegawai
                           </div>
                           <div class="card-body">
                              <div class="container"> 

                              <form method="POST" action="<?php echo base_url('admin/DataPegawai/AddPegawai/addData') ?>" enctype="multipart/form-data">
                                 
                                 <div class="row justify-content-center">
                                    <div class="col-sm-4 mt-2">
                                       <label for="nama_pegawai" class="form-label" style="font-weight: bold;"> Nama : <span class="text-danger">*</span></label>
                                       <input type="hidden" class="form-control" name="id_pegawai" id="id_pegawai" value="" readonly>
                                       
                                       <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" value="" placeholder="Masukkan nama...">
                                       <div class="bg-danger">
                                          <small class="text-white"><?php echo form_error('nama_pegawai'); ?></small>
                                       </div>
                                    </div>
                                    <div class="col-sm-4 mt-2">
                                       <label for="NIK" class="form-label" style="font-weight: bold;"> No Induk Karyawan : <span class="text-danger">*</span></label>
                                       
                                       <input type="text" class="form-control" name="NIK" id="NIK" value="" placeholder="Masukkan no induk karyawan...">
                                       <div class="bg-danger">
                                          <small class="text-white"><?php echo form_error('NIK'); ?></small>
                                       </div>
                                    </div>
                                    <div class="col-sm-4 mt-2">
                                       <label for="no_telpon" class="form-label" style="font-weight: bold;">No Telepon : <span class="text-danger">*</span></label>
                                       <input type="number" class="form-control" name="no_telpon" id="no_telpon" value="" placeholder="Masukkan no telepon...">
                                       <div class="bg-danger">
                                          <small class="text-white"><?php echo form_error('no_telpon'); ?></small>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="row justify-content-center">
                                    <div class="col-sm-4 mt-2">
                                       <label for="alamat_pegawai" class="form-label" style="font-weight: bold;"> Alamat : <span class="text-danger">*</span></label>
                                       <input type="text" class="form-control" name="alamat_pegawai" id="alamat_pegawai" value="" placeholder="Masukkan alamat...">
                                       <div class="bg-danger">
                                          <small class="text-white"><?php echo form_error('alamat_pegawai'); ?></small>
                                       </div>
                                    </div>
                                    <div class="col-sm-4 mt-2">
                                          <label for="pendidikan_pegawai" class="form-label" style="font-weight: bold;">Pendidikan : <span class="text-danger">*</span></label>
                                          <select name="pendidikan_pegawai" class="form-control text-center" required>
                                             <option disabled selected> -- Pilih Pendidikan-- </option>
                                             <option value="SMA/SMK/MA">SMA/SMK/MA</option>
                                             <option value="D3">D3</option>
                                             <option value="D4">D4</option>
                                             <option value="S1">S1</option>
                                          </select>
                                    </div>
                                    <div class="col-sm-4 mt-2">
                                       <label for="jabatan" class="form-label" style="font-weight: bold;">Jabatan : <span class="text-danger">*</span></label>
                                       <input type="text" class="form-control" name="jabatan" id="jabatan" value="" placeholder="Masukkan jabatan...">
                                       <div class="bg-danger">
                                          <small class="text-white"><?php echo form_error('jabatan'); ?></small>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="row justify-content-center">
                                    <div class="col-sm-4 mt-2">
                                       <label for="tanggal_masuk" class="form-label" style="font-weight: bold;"> Tanggal Masuk : <span class="text-danger">*</span></label>
                                       <input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk" value="">
                                       <div class="bg-danger">
                                          <small class="text-white"><?php echo form_error('tanggal_masuk'); ?></small>
                                       </div>
                                    </div>
                                    <div class="col-sm-4 mt-2">
                                    <label for="gaji" class="form-label" style="font-weight: bold;">Gaji : <span class="text-danger">*</span></label>
                                       <input type="text" class="form-control" name="gaji" id="gaji" value="" placeholder="Masukkan gaji...">
                                       <div class="bg-danger">
                                          <small class="text-white"><?php echo form_error('gaji'); ?></small>
                                       </div>  
                                    </div>
                                    <div class="col-sm-4 mt-2">
                                       <label for="photo" class="form-label" style="font-weight: bold;">Foto : <span class="text-danger">*</span></label>
                                       <input type="file" name="photo" accept="image/*" class="form-control">
                                       <div class="bg-danger">
                                          <small class="text-white"><?php echo form_error('photo'); ?></small>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="row mt-3">
                                       <div class="col-sm-12 d-flex justify-content-end">
                                          <button type="submit" class="btn btn-success mt-2 justify-content-end" style="margin-right: 5px;"><i class="bi bi-plus-circle"></i> Simpan</button>
                                          <a class="btn btn-danger mt-2 justify-content-end" href="<?php echo base_url('admin/DataPegawai/DataPegawai')?>"><i class="bi bi-backspace-fill"></i> Kembali</a>
                                       </div>
                                 </div>

                              </form>


                              </div>
                           </div>
                     </div>
                  </div>
               </main>
