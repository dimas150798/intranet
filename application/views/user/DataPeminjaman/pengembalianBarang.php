<div id="layoutSidenav_content">
   <main>

      <div class="container-fluid px-4">

         <h4 class="mt-4">Peminjaman Barang</h4>
         <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="#">Data Peminjaman Barang</a></li>
            <li class="breadcrumb-item active">Peminjaman Barang</li>
         </ol>


         <div class="card mb-4">
            <div class="card-header">
               <i class="fas fa-table me-1"></i>
               Data Peminjaman <br>
            </div>
            <div class="card-body">
               <div class="container">

                  <?php foreach ($dataPengembalian as $data) : ?>
                  <form method="POST"
                     action="<?php echo base_url('admin/DataArea/EditArea/editDataAksi') ?>">

                     <div class="row justify-content-center">

                        <div class="col-sm-6 mt-2">
                           <label for="id_barang" class="form-label" style="font-weight: bold;"> Nama barang :
                              <span class="text-danger">*</span></label>
                           <input type="hidden" class="form-control" name="id_peminjaman_barang"
                              id="id_peminjaman_barang"
                              value="<?php echo $data->id_peminjaman_barang?>"
                              readonly>
                           <input type="hidden" class="form-control" name="id_barang" id="id_barang"
                              value="<?php echo $data->id_barang?>"
                              readonly>
                           <input type="text" class="form-control" name="nama_barang" id="nama_barang"
                              value="<?php echo $data->nama_barang?>"
                              readonly>

                        </div>

                        <div class="col-sm-6 mt-2">
                           <label for="nama_pegawai" class="form-label" style="font-weight: bold;"> Nama
                              pegawai :
                              <span class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai"
                              value="<?php echo $data->nama_pegawai?>"
                              readonly>

                        </div>

                     </div>

                     <div class="row justify-content-center">
                        <div class="col-sm-4 mt-2">
                           <label for="tanggal" class="form-label" style="font-weight: bold;">Tanggal :
                              <span class="text-danger">*</span></label>
                           <input type="date" class="form-control" name="tanggal" id="tanggal" value="" required>
                           <div class="bg-danger">
                              <small
                                 class="text-white"><?php echo form_error('tanggal'); ?></small>
                           </div>
                        </div>

                        <div class="col-sm-4 mt-2">
                           <label for="jumlah" class="form-label" style="font-weight: bold;"> Jumlah :
                              <span class="text-danger">*</span></label>
                           <input type="number" class="form-control" name="jumlah" id="jumlah" value=""
                              placeholder="Masukkan jumlah...">
                           <div class="bg-danger">
                              <small
                                 class="text-white"><?php echo form_error('jumlah'); ?></small>
                           </div>
                        </div>

                        <div class="col-sm-4 mt-2">
                           <label for="keterangan" class="form-label" style="font-weight: bold;"> Keterangan :
                              <span class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="keterangan" id="keterangan" value=""
                              placeholder="Masukkan keterangan...">
                           <div class="bg-danger">
                              <small
                                 class="text-white"><?php echo form_error('keterangan'); ?></small>
                           </div>
                        </div>

                     </div>



                     <div class="row mt-3">
                        <div class="col-sm-12 d-flex justify-content-end">
                           <button type="submit" class="btn btn-success mt-2 justify-content-end"
                              style="margin-right: 5px;"><i class="bi bi-plus-circle"></i> Simpan</button>
                           <a class="btn btn-danger mt-2 justify-content-end"
                              href="<?php echo base_url('admin/DataPeminjaman/DataPeminjamanBarang')?>"><i
                                 class="bi bi-backspace-fill"></i> Kembali</a>
                        </div>
                     </div>

                  </form>
                  <?php endforeach; ?>





               </div>
            </div>
         </div>
      </div>
   </main>