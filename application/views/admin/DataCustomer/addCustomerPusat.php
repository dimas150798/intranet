<div id="layoutSidenav_content">
   <main>

      <div class="container-fluid px-4">

         <h4 class="mt-4">Tambah Data Customer</h4>
         <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="#">Data Customer</a></li>
            <li class="breadcrumb-item active">Tambah Data Customer</li>
         </ol>


         <div class="card mb-4">
            <div class="card-header">
               <i class="fas fa-table me-1"></i>
               Data Customer
            </div>
            <div class="card-body">
               <div class="container">

                  <form method="POST"
                     action="<?php echo base_url('admin/DataCustomer/AddCustomerPusat/addData') ?>"
                     enctype="multipart/form-data">

                     <div class="row justify-content-center">
                        <div class="col-sm-3 mt-2">
                           <label for="nama_customer" class="form-label" style="font-weight: bold;"> Nama : <span
                                 class="text-danger">*</span></label>
                           <input type="hidden" class="form-control" name="id_customer" id="id_customer" value=""
                              readonly>

                           <input type="text" class="form-control" name="nama_customer" id="nama_customer" value=""
                              placeholder="Masukkan nama...">
                           <div class="bg-danger">
                              <small
                                 class="text-white"><?php echo form_error('nama_customer'); ?></small>
                           </div>
                        </div>
                        <div class="col-sm-3 mt-2">
                           <label for="pembelian_paket" class="form-label" style="font-weight: bold;">Paket : <span
                                 class="text-danger">*</span></label>
                           <select name="pembelian_paket" class="form-control text-center" required>
                              <option disabled selected>-- Pilih Paket --</option>
                              <?php foreach ($dataPaket as $data) : ?>
                              <option
                                 value="<?php echo $data->nama_paket?>">
                                 <?php echo $data->nama_paket?>
                              </option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                        <div class="col-sm-3 mt-2">
                           <label for="nik_customer" class="form-label" style="font-weight: bold;">NIK Customer : <span
                                 class="text-danger">*</span></label>
                           <input type="number" class="form-control" name="nik_customer" id="nik_customer" value=""
                              placeholder="Masukkan NIK...">
                           <div class="bg-danger">
                              <small
                                 class="text-white"><?php echo form_error('nik_customer'); ?></small>
                           </div>
                        </div>
                        <div class="col-sm-3 mt-2">
                           <label for="tlp_customer" class="form-label" style="font-weight: bold;"> Telephon : <span
                                 class="text-danger">*</span></label>
                           <input type="number" class="form-control" name="tlp_customer" id="tlp_customer" value=""
                              placeholder="Masukkan telephon...">
                           <div class="bg-danger">
                              <small
                                 class="text-white"><?php echo form_error('tlp_customer'); ?></small>
                           </div>
                        </div>
                     </div>

                     <div class="row justify-content-center">

                        <div class="col-sm-3 mt-2">
                           <label for="alamat_customer" class="form-label" style="font-weight: bold;"> Alamat : <span
                                 class="text-danger">*</span></label>
                           <input type="text" class="form-control" name="alamat_customer" id="alamat_customer" value=""
                              placeholder="Masukkan alamat...">
                           <div class="bg-danger">
                              <small
                                 class="text-white"><?php echo form_error('alamat_customer'); ?></small>
                           </div>
                        </div>
                        <div class="col-sm-3 mt-2">
                           <label for="tanggal" class="form-label" style="font-weight: bold;"> Tanggal : <span
                                 class="text-danger">*</span></label>
                           <input type="date" class="form-control" name="tanggal" id="tanggal" value=""
                              placeholder="Masukkan alamat...">
                        </div>
                        <div class="col-sm-6 mt-2">
                           <label for="kota" class="form-label" style="font-weight: bold;"> Kota / Kabupaten : <span
                                 class="text-danger">*</span></label>
                           <select id="kota" name="kota" class="form-select form-select-pendaftaran text-center"
                              required>
                              <option value="" disabled selected>Kota / Kabupaten :</option>
                              <?php foreach ($dataKotKab as $value) { ?>
                              <option
                                 value="<?php echo $value->id_kota; ?>">
                                 <?php echo $value->nama_kota;?>
                              </option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>

                     <div class="row justify-content-center">
                        <div class="col-sm-6 mt-2">
                           <label for="kecamatan" class="form-label" style="font-weight: bold;">Kecamatan : <span
                                 class="text-danger">*</span></label>
                           <select id="kecamatan" name="kecamatan" disabled="" class="form-control text-center"
                              required>
                              <option value="">Kecamatan :</option>
                           </select>
                        </div>
                        <div class="col-sm-6 mt-2">
                           <label for="kelurahan" class="form-label" style="font-weight: bold;">Kelurahan : <span
                                 class="text-danger">*</span></label>
                           <select id="kelurahan" name="kelurahan" disabled="" class="form-control text-center"
                              required>
                              <option value="">Kelurahan :</option>
                           </select>
                        </div>
                     </div>

                     <div class="row mt-3">
                        <div class="col-sm-12 d-flex justify-content-end">
                           <button type="submit" class="btn btn-success mt-2 justify-content-end"
                              style="margin-right: 5px;"><i class="bi bi-plus-circle"></i> Simpan</button>
                           <a class="btn btn-danger mt-2 justify-content-end"
                              href="<?php echo base_url('admin/DataCustomer/DataCustomerPusat')?>"><i
                                 class="bi bi-backspace-fill"></i> Kembali</a>
                        </div>
                     </div>

                  </form>


               </div>
            </div>
         </div>
      </div>
   </main>