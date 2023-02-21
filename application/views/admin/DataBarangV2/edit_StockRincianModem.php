<div id="layoutSidenav_content">
   <main>

      <div class="container-fluid px-4">

         <h4 class="mt-4">Edit Detail Barang</h4>
         <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="#">Data Barang</a></li>
            <li class="breadcrumb-item active">Form</li>
         </ol>


         <div class="card mb-4">
            <div class="card-header">
               <i class="fas fa-table me-1"></i>
               Data Barang
            </div>
            <div class="card-body">
               <div class="container">

                  <?php foreach ($dataRincian as $data) : ?>
                  <form method="POST"
                     action="<?php echo base_url('admin/DataBarangV2/Edit_BarangNama/editDataAksi') ?>"
                     enctype="multipart/form-data">

                     <div class="row justify-content-center">
                        <input type="hidden" class="form-control" name="id_stockRincian" id="id_stockRincian"
                           value="<?php echo $data['id_stockRincian']?>"
                           readonly>
                     </div>

                     <div class="row justify-content-center">
                        <div class="col-sm-4 mt-3">
                           <label for="nama_barang" class="form-label" style="font-weight: bold;"> Nama :
                              <span class="text-danger">*</span></label>
                           <input type="text" class="form-control text-center bg-warning fw-bold" name="nama_barang"
                              id="nama_barang"
                              value="<?php echo $data['nama_barang']?>"
                              placeholder="Masukkan nama..." readonly>
                        </div>
                        <div class="col-sm-4 mt-3">
                           <label for="kode_barang" class="form-label" style="font-weight: bold;"> Kode Barang :
                              <span class="text-danger">*</span></label>
                           <input type="text" class="form-control text-center bg-warning fw-bold" name="kode_barang"
                              id="kode_barang"
                              value="<?php echo $data['kode_barang']?>"
                              placeholder="Masukkan nama..." readonly>
                        </div>
                        <div class="col-sm-4 mt-3">
                           <label for="jumlah" class="form-label" style="font-weight: bold;"> Jumlah :
                              <span class="text-danger">*</span></label>
                           <input type="text" class="form-control text-center bg-warning fw-bold" name="jumlah"
                              id="jumlah"
                              value="<?php echo $data['jumlah']?>"
                              placeholder="Masukkan nama..." readonly>
                        </div>
                     </div>

                     <div class="row justify-content-center">
                        <div class="col-sm-3 mt-3">
                           <label for="tanggal" class="form-label" style="font-weight: bold;"> Tanggal :
                              <span class="text-danger">*</span></label>
                           <input type="date" class="form-control" name="tanggal" id="tanggal"
                              value="<?php echo $data['tanggal']?>"
                              placeholder="">
                        </div>
                        <div class="col-sm-3 mt-3">
                           <label for="status" class="form-label" style="font-weight: bold;">Status Barang :
                              <span class="text-danger">*</span></label>
                           <select name="status" id="status" class="form-control text-center" required>
                              <?php foreach ($dataStatus as $status) : ?>
                              <option
                                 value="<?php echo $status['id_status']; ?>"
                                 <?=$data['id_status'] == $status['id_status'] ? 'selected' : null?>><?php echo $status['nama_status'];?>
                              </option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                        <div class="col-sm-3 mt-3">
                           <label for="keadaan" class="form-label" style="font-weight: bold;">Keadaan :
                              <span class="text-danger">*</span></label>
                           <select name="keadaan" id="keadaan" class="form-control text-center" required>
                              <?php foreach ($dataKeadaan as $keadaan) : ?>
                              <option
                                 value="<?php echo $keadaan['id_keadaanbarang']; ?>"
                                 <?=$data['id_keadaanbarang'] == $keadaan['id_keadaanbarang'] ? 'selected' : null?>><?php echo $keadaan['nama_keadaan'];?>
                              </option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                        <div class="col-sm-3 mt-3">


                           <label for="dataCustomer" class="form-label" style="font-weight: bold;">Customer :
                              <span class="text-danger">*</span></label>
                           <select name="dataCustomer" id="dataCustomer" class="form-control text-center" required>
                              <?php foreach ($dataCustomer as $customer) : ?>
                              <option
                                 value="<?php echo $customer['id_customer']; ?>"
                                 <?=$data['id_customer'] == $customer['id_customer'] ? 'selected' : null?>><?php echo $customer['nama_customer'];?>
                              </option>
                              <?php endforeach; ?>
                           </select>
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