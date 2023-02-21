<div id="layoutSidenav_content">
   <main>

      <div class="container-fluid px-4">

         <h4 class="mt-4">Edit Nama Barang</h4>
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

                  <?php foreach ($barangNama as $data) : ?>
                  <form method="POST"
                     action="<?php echo base_url('admin/DataBarangV2/Edit_BarangNama/editDataAksi') ?>"
                     enctype="multipart/form-data">

                     <div class="row justify-content-center">
                        <div class="col-sm-4 mt-2">
                           <label for="nama_pegawai" class="form-label" style="font-weight: bold;"> Nama :
                              <span class="text-danger">*</span></label>
                           <input type="hidden" class="form-control" name="id_barang" id="id_barang"
                              value="<?php echo $data->id_barang?>"
                              readonly>

                           <input type="text" class="form-control" name="nama_barang" id="nama_barang"
                              value="<?php echo $data->nama_barang?>"
                              placeholder="Masukkan nama...">
                           <div class="bg-danger">
                              <small
                                 class="text-white"><?php echo form_error('nama_barang'); ?></small>
                           </div>
                        </div>

                        <div class="col-sm-4 mt-2">
                           <label for="satuan" class="form-label" style="font-weight: bold;">Satuan :
                              <span class="text-danger">*</span></label>
                           <select name="satuan" id="satuan" class="form-control text-center" required>
                              <?php foreach ($dataSatuan as $satuan) : ?>
                              <option
                                 value="<?php echo $satuan->id_satuan; ?>"
                                 <?=$data->id_satuan == $satuan->id_satuan ? 'selected' : null?>><?php echo $satuan->nama_satuan;?>
                              </option>
                              <?php endforeach; ?>
                           </select>
                        </div>

                        <div class="col-sm-4 mt-2">
                           <label for="kategori" class="form-label" style="font-weight: bold;">Kategori :
                              <span class="text-danger">*</span></label>
                           <select name="kategori" id="kategori" class="form-control text-center" required>
                              <?php foreach ($dataKategori as $kategori) : ?>
                              <option
                                 value="<?php echo $kategori->id_peralatan; ?>"
                                 <?=$data->id_peralatan == $kategori->id_peralatan ? 'selected' : null?>><?php echo $kategori->kategori_peralatan;?>
                              </option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                     </div>


                     <div class="row mt-3">
                        <div class="col-sm-12 d-flex justify-content-end">
                           <button type="submit" class="btn btn-success mt-2 justify-content-end"
                              style="margin-right: 5px;"><i class="bi bi-plus-circle"></i> Simpan</button>
                           <a class="btn btn-danger mt-2 justify-content-end"
                              href="<?php echo base_url('admin/DataBarangV2/Data_BarangNama')?>"><i
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