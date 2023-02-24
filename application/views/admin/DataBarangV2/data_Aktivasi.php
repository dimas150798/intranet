<?php
            if (!function_exists('changeDateFormat')) {
                function changeDateFormat($format='d-m-Y', $givenDate=null)
                {
                    return date($format, strtotime($givenDate));
                }
            }
        ?>

<div id="layoutSidenav_content">
   <main>

      <div class="container">
         <h4 class="mt-4" style="margin-left: 5px; margin-right: 5px;">Data Aktivasi Pelanggan</h4>
         <ol class="breadcrumb" style="margin-left: 5px; margin-right: 5px;">
            <li class="breadcrumb-item"><a href="#">Data Barang Aktivasi</a></li>
            <li class="breadcrumb-item active">Tables</li>
         </ol>

         <!-- <a class="btn btn-success mb-3"
            href="<?php echo base_url('admin/DataBarangV2/Add_StockBarang') ?>"><i
            class="bi bi-plus-circle"></i> Tambah Data</a> -->

         <div class="card mb-3">
            <div id="kwitansiClose" class="card-header">
               <i class="fas fa-table me-1"></i>
               Data Barang Aktivasi <br>
               <h5 class="text-center font-weight-light mt-2 mb-2">
                  <?php echo $this->session->flashdata('pesan'); ?>
               </h5>
            </div>
            <div id="kwitansiClose" class="card-body">
               <table class="table table-bordered" id="datatablesSimple" width="100%">
                  <thead>
                     <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="10%">Nama Barang</th>
                        <th width="7%" class="text-center">SN</th>
                        <th width="10%" class="text-center">PCK Jumlah</th>
                        <th width="10%" class="text-center">PCH Jumlah</th>
                        <th width="13%" class="text-center">Nama Customer</th>
                        <th width="7%" class="text-center">Tanggal</th>
                        <th width="10%" class="text-center">Status</th>
                        <th width="10%" class="text-center">Kondisi</th>
                        <th width="5%" class="text-center">Opsi</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $no = 1;
                        foreach ($dataStock as $data) :
                        ?>

                     <tr>
                        <td class="text-center">
                           <?php echo $no++ ?>
                        </td>
                        <td>
                           <?php echo $data['nama_barang']?>
                        </td>
                        <td class="text-center">
                           <?php echo $data['kode_barang']?>
                        </td>
                        <td class="text-center">
                           <?php
                           if ($data['PCK_jumlah'] == null) {
                               echo '0';
                           } else {
                               echo $data['PCK_jumlah'];
                           }
                           ?>
                        </td>
                        <td class="text-center">
                           <?php
                           if ($data['PCH_jumlah'] == null) {
                               echo '0';
                           } else {
                               echo $data['PCH_jumlah'];
                           }
                           ?>
                        </td>
                        <td class="text-center">
                           <?php
                           if ($data['nama_customer'] == null) {
                               echo '-';
                           } else {
                               echo $data['nama_customer'];
                           }
                           ?>
                        </td>
                        <td class="text-center">
                           <?php
                           if ($data['tanggal'] == null) {
                               echo "-";
                           } else {
                               echo changeDateFormat('d-m-Y', $data['tanggal']);
                           }
                           ?>
                        </td>
                        <td class="text-center">
                           <?php echo $data['nama_status']?>
                        </td>
                        <td class="text-center">
                           <?php echo $data['nama_keadaan']?>
                        </td>
                        <td class="text-center">
                           <div class="btn-group">
                              <button type="button" class="btn btn-sm btn-info dropdown-toggle"
                                 data-bs-toggle="dropdown" data-bs-target="#dropdown" aria-expanded="false"
                                 aria-controls="dropdown">
                                 Opsi
                              </button>
                              <div class="dropdown-menu text-black" style="background-color:aqua;">
                                 <!-- <a class="dropdown-item text-black"
                                    href="<?php echo base_url('admin/DataBarangV2/Edit_StockRincianModem/editData/' . $data['id_stockRincian']) ?>"><i
                                    class="bi bi-pencil-square"></i> Edit</a> -->
                                 <a onclick="return confirm('Yakin Menghapus Data')" class="dropdown-item text-black"
                                    href="<?php echo base_url('admin/DataBarangV2/Data_Aktivasi/deleteData/' . $data['kode_barang']) ?>"><i
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