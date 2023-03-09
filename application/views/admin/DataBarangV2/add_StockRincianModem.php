<div id="layoutSidenav_content">
   <main>

      <div class="container-fluid px-4">

         <h4 class="mt-4">Data Detail Barang</h4>
         <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="#">Data Stock Barang</a></li>
            <li class="breadcrumb-item active">Form</li>
         </ol>


         <div class="card mb-4">
            <div class="card-header">
               <i class="fas fa-table me-1"></i>
               Data Barang
            </div>
            <div class="card-body">
               <div class="container">

                  <?php foreach ($barangNama as $data) : ?>
                  <form method="POST"
                     action="<?php echo base_url('admin/DataBarangV2/Add_StockRincianModem/addStockRincianAksi') ?>"
                     enctype="multipart/form-data">

                     <div class="row">
                        <div class="col-12">
                           <input type="hidden" class="form-control" name="id_barang" id="id_barang"
                              value="<?php echo $data->id_barang?>"
                              readonly>

                           <input type="hidden" class="form-control" name="id_stockBarang" id="id_stockBarang"
                              value="<?php echo $data->id_stockBarang?>"
                              readonly>

                           <input type="hidden" class="form-control" name="jumlahDetailBarang" id="jumlahDetailBarang"
                              value="<?php echo $data->jumlahDetailBarang?>"
                              readonly>
                        </div>
                     </div>

                     <div class="row justify-content-center">
                        <div class="col-sm-6 mt-3">
                           <label for="nama_pegawai" class="form-label" style="font-weight: bold;"> Nama Barang
                              :
                              <span class="text-danger">*</span></label>

                           <input type="text" class="form-control text-center bg-warning fw-bold" name="nama_barang"
                              id="nama_barang"
                              value="<?php echo $data->nama_barang?>"
                              placeholder="Masukkan nama..." readonly>
                        </div>

                        <div class="col-sm-6 mt-3">
                           <label for="jumlah" class="form-label" style="font-weight: bold;"> Jumlah :
                              <span class="text-danger">*</span></label>
                           <input type="text" class="form-control text-center bg-warning fw-bold" name="jumlah"
                              id="jumlah" value="<?php echo 1?>"
                              placeholder="Masukkan jumlah..." readonly>
                        </div>
                     </div>

                     <div class="row justify-content-center">
                        <div class="col-sm-4 mt-3">
                           <label for="kode_barang" class="form-label" style="font-weight: bold;"> SN Modem
                              :
                              <span class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="kode_barang" id="kode_barang" value=""
                              placeholder="Masukkan SN Modem...">
                        </div>

                        <div class="col-sm-4 mt-3">
                           <label for="keadaan" class="form-label" style="font-weight: bold;">Keadaan Barang :
                              <span class="text-danger text-center">*</span></label>
                           <select name="keadaan" id="keadaan" class="form-control" required>
                              <option disabled selected>-- Pilih Keadaan Barang --</option>
                              <?php foreach ($dataKeadaan as $keadaan) : ?>
                              <option
                                 value="<?php echo $keadaan['id_keadaanbarang']?>">
                                 <?php echo $keadaan['nama_keadaan']?>
                              </option>
                              <?php endforeach; ?>
                           </select>
                        </div>

                        <div class="col-sm-4 mt-3">
                           <label for="tanggal" class="form-label" style="font-weight: bold;"> Tanggal :
                              <span class="text-danger">*</span></label>
                           <input type="date" class="form-control" name="tanggal" id="tanggal" value="" placeholder="">
                        </div>
                     </div>

                     <div class="row mt-3">
                        <div class="col-sm-12 d-flex justify-content-end">
                           <button type="submit" class="btn btn-success mt-2 justify-content-end"
                              style="margin-right: 5px;"><i class="bi bi-plus-circle"></i> Simpan</button>
                           <a class="btn btn-danger mt-2 justify-content-end"
                              href="<?php echo base_url('admin/DataBarangV2/Data_StockBarangModem')?>"><i
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