<div id="layoutSidenav_content">
   <main>

      <div class="container-fluid px-4">

         <h4 class="mt-4">Data Pengembalian Barang</h4>
         <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="#">Data Pengembalian Barang</a></li>
            <li class="breadcrumb-item active">Form</li>
         </ol>


         <div class="card mb-4">
            <div class="card-header">
               <i class="fas fa-table me-1"></i>
               Data Peminjaman <br>
               <label for="tanggal" class="form-label" style="font-weight: bold;">Noted ! :
                  <span class="text-danger text-b">*</span></label> <br>
               Pegawai mengharuskan memasukan data foto bukti barang yang ingin di kembalikan, <br> dengan di
               sertai
               watermark infly dan maksimal foto hanya 2
            </div>
            <div class="card-body">
               <div class="container">

                  <?php foreach ($dataPeminjaman as $data) : ?>
                  <form method="POST"
                     action="<?php echo base_url('admin/DataPeminjamanV2/AddBuktiPengembalianBarang/addPengembalianAksi') ?>"
                     enctype="multipart/form-data">

                     <div class="row justify-content-center">
                        <div class="col-sm-4 mt-2">
                           <label for="nama_customer" class="form-label" style="font-weight: bold;"> Nama
                              Pegawai:
                              <span class="text-danger">*</span></label>
                           <input type="hidden" class="form-control" name="id_bukti_barang_peminjaman"
                              id="id_bukti_barang_peminjaman"
                              value="<?php echo $data->id_bukti_barang_peminjaman?>"
                              readonly>
                           <input type="text" class="form-control" name="" id=""
                              value="<?php echo $data->nama_pegawai?>"
                              readonly>
                        </div>

                        <div class="col-sm-4 mt-2">
                           <label for="photo" class="form-label" style="font-weight: bold;">Foto 1 : <span
                                 class="text-danger">*</span></label>
                           <input type="file" name="photo1" accept="image/*" class="form-control" required>
                        </div>

                        <div class="col-sm-4 mt-2">
                           <label for="photo" class="form-label" style="font-weight: bold;">Foto 2 : <span
                                 class="text-danger">*</span></label>
                           <input type="file" name="photo2" accept="image/*" class="form-control">
                        </div>

                     </div>



                     <div class="row mt-3">
                        <div class="col-sm-12 d-flex justify-content-end">
                           <button type="submit" class="btn btn-success mt-2 justify-content-end"
                              style="margin-right: 5px;"><i class="bi bi-plus-circle"></i> Simpan</button>
                           <a class="btn btn-danger mt-2 justify-content-end" href="javascript:history.go(-1)"><i
                                 class="bi bi-backspace-fill"></i>
                              Kembali</a>
                        </div>
                     </div>

                  </form>
                  <?php endforeach; ?>

               </div>
            </div>
         </div>
      </div>
   </main>