<div id="layoutSidenav_content">
   <main>

      <div class="container-fluid px-4">

         <h4 class="mt-4">Purchase Request</h4>
         <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="#">Data Purchase Request</a></li>
            <li class="breadcrumb-item active">Form</li>
         </ol>


         <div class="card mb-4">
            <div class="card-header">
               <i class="fas fa-table me-1"></i>
               Data Purchase Request <br>
            </div>
            <div class="card-body">
               <div class="container">

                  <form method="POST"
                     action="<?php echo base_url('admin/DataPurchase/AddPurchaseRequest/addData') ?>">

                     <div class="row justify-content-center">
                        <div class="col-sm-12">
                           <input type="hidden" class="form-control" name="no_purchase_order" id="no_purchase_order"
                              value="<?php echo $this->PurchasingModel->invoiceOrder()?>"
                              readonly>
                        </div>
                     </div>

                     <div class="row justify-content-center">
                        <div class="col-sm-4 mt-3">
                           <label for="no_purchase_request" class="form-label" style="font-weight: bold;">No
                              Purchase Request :</label>
                           <input type="text" class="form-control text-center bg-warning fw-bold"
                              name="no_purchase_request" id="no_purchase_request"
                              value="<?php echo $this->PurchasingModel->invoiceRequest()?>"
                              readonly>
                        </div>

                        <div class="col-sm-4 mt-3">
                           <label for="pegawai" class="form-label text-center" style="font-weight: bold;">
                              Nama Request :
                              <span class="text-danger">*</span></label>
                           <select name="pegawai" id="pegawai" class="form-control text-center" required>
                              <option disabled selected>-- Pilih Pegawai --</option>
                              <?php foreach ($dataPegawai as $data) : ?>
                              <option
                                 value="<?php echo $data['id_pegawai']?>">
                                 <?php echo $data['nama_pegawai']?>
                              </option>
                              <?php endforeach; ?>
                           </select>
                        </div>

                        <div class="col-sm-4 mt-3">
                           <label for="barang" class="form-label text-center" style="font-weight: bold;">Nama
                              Barang :
                              <span class="text-danger">*</span></label>
                           <select name="barang" id="barang" class="form-control text-center" required>
                              <option disabled selected>-- Pilih Barang --</option>
                              <?php foreach ($dataBarang as $data) : ?>
                              <option
                                 value="<?php echo $data['id_barang']?>">
                                 <?php echo $data['nama_barang']?>
                              </option>
                              <?php endforeach; ?>
                           </select>
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
                           <label for="jumlah" class="form-label" style="font-weight: bold;"> Jumlah Barang :
                              <span class="text-danger">*</span></label>
                           <input type="number" class="form-control" name="jumlah" id="jumlah" value=""
                              placeholder="Masukkan jumlah...">
                           <div class="bg-danger">
                              <small
                                 class="text-white"><?php echo form_error('jumlah'); ?></small>
                           </div>
                        </div>

                        <div class="col-sm-4 mt-2">
                           <label for="keterangan" class="form-label" style="font-weight: bold;"> Keterangan
                              :</label>
                           <input type="text" class="form-control" name="keterangan" id="keterangan" value=""
                              placeholder="Masukkan keterangan...">
                        </div>

                     </div>

                     <div class="row mt-3">
                        <div class="col-sm-12 d-flex justify-content-end">
                           <button type="submit" class="btn btn-success mt-2 justify-content-end"
                              style="margin-right: 5px;"><i class="bi bi-plus-circle"></i> Simpan</button>
                           <a class="btn btn-danger mt-2 justify-content-end"
                              href="<?php echo base_url('admin/DataPurchase/DataPurchaseRequest')?>"><i
                                 class="bi bi-backspace-fill"></i> Kembali</a>
                        </div>
                     </div>

                  </form>




               </div>
            </div>
         </div>
      </div>
   </main>