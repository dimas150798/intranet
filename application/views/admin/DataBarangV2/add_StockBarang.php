<div id="layoutSidenav_content">
   <main>

      <div class="container">

         <h4 class="mt-4">Data Barang Masuk</h4>
         <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="#">Data Barang Masuk</a></li>
            <li class="breadcrumb-item active">Form</li>
         </ol>

         <div class="card mb-4">
            <div class="card-header">
               <i class="fas fa-table me-1"></i>
               Data Barang <br>
            </div>
            <div class="card-body">
               <div class="container">

                  <form method="POST"
                     action="<?php echo base_url('admin/DataBarangV2/Add_StockBarang/addData') ?>">

                     <div class="row justify-content-center">

                        <div class="col-sm-6 mt-2 justify-content-center">
                           <label for="barang" class="form-label" style="font-weight: bold;">Nama Barang :
                              <span class="text-danger text-center">*</span></label>
                           <select name="barang" id="barang" class="form-control" required>
                              <option disabled selected>-- Pilih Barang --</option>
                              <?php foreach ($dataBarang as $data) : ?>
                              <option
                                 value="<?php echo $data['id_barang']?>">
                                 <?php echo $data['nama_barang']?>
                              </option>
                              <?php endforeach; ?>
                           </select>
                        </div>

                        <div class="col-sm-6 mt-2">
                           <label for="jumlah_stockBarang" class="form-label" style="font-weight: bold;">
                              Jumlah
                              : <span class="text-danger">*</span></label>

                           <input type="text" class="form-control" name="jumlah_stockBarang" id="jumlah_stockBarang"
                              value="" placeholder="Masukkan jumlah...">
                           <div class="bg-danger">
                              <small
                                 class="text-white"><?php echo form_error('jumlah_stockBarang'); ?></small>
                           </div>
                        </div>

                     </div>

                     <div class="row mt-3">
                        <div class="col-sm-12 d-flex justify-content-end">
                           <button type="submit" class="btn btn-success mt-2 justify-content-end"
                              style="margin-right: 5px;"><i class="bi bi-plus-circle"></i> Simpan</button>
                           <a class="btn btn-danger mt-2 justify-content-end"
                              href="<?php echo base_url('admin/DataBarangV2/Data_StockBarang')?>"><i
                                 class="bi bi-backspace-fill"></i> Kembali</a>
                        </div>
                     </div>

                  </form>

               </div>
            </div>
         </div>
      </div>
   </main>