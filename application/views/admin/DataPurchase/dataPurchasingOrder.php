<div id="layoutSidenav_content">
   <main>

      <div class="card mb-3 mt-2" style="margin-bottom: 10px; margin-left: 5px; margin-right: 5px;">

         <h4 class="mt-4" style="margin-left: 18px; margin-right: 5px;">Purchase Order</h4>
         <ol class="breadcrumb" style="margin-bottom: 10px; margin-left: 18px; margin-right: 5px;">
            <li class="breadcrumb-item"><a href="#">Data Purchase Order</a></li>
            <li class="breadcrumb-item active">Tables</li>
         </ol>

         <div class="card-body">
            <form method="POST"
               action="<?php echo base_url('admin/DataPurchase/DataPurchaseOrder/index') ?>">

               <div class="row">
                  <div class="col-md-2">
                     <label for="tahun">Tahun : </label>
                     <select class="form-control text-center" name="tahun" required>
                        <?php
                           if ($tahun == null) {
                               echo '<option value="" disabled selected>-- Pilih Tahun --</option>';
                           } else {
                               echo '<option value="" disabled>-- Pilih Tahun --</option>';

                               for ($i=2022; $i <= 2023; $i++) {
                                   if ($tahun == $i) {
                                       echo '<option selected value='.$i.'>'.date("Y", mktime(0, 0, 0, 1, 1, $i)).'</option>'."\n";
                                   } else {
                                       echo '<option value='.$i.'>'.date("Y", mktime(0, 0, 0, 1, 1, $i)).'</option>'."\n";
                                   }
                               }
                           }
                        ?>
                     </select>
                  </div>

                  <div class="col-md-2">
                     <label for="bulan">Bulan : </label>
                     <select class="form-control text-center" name="bulan" required>
                        <?php
                           if ($bulan == null) {
                               echo '<option value="" disabled selected>-- Pilih Bulan --</option>';
                           } else {
                               echo '<option value="" disabled>-- Pilih Bulan --</option>';

                               for ($m=1; $m <= 12; ++$m) {
                                   if ($bulan == $m) {
                                       echo '<option selected value='.$m.'>'.date('F', mktime(0, 0, 0, $m, 1)).'</option>'."\n";
                                   } else {
                                       echo '<option  value='.$m.'>'.date('F', mktime(0, 0, 0, $m, 1)).'</option>'."\n";
                                   }
                               }
                           }
                        ?>
                     </select>
                  </div>

                  <div class="col-md-8 mt-auto justify-content-end d-flex">
                     <button type="submit" class="btn btn-info mt-2 ml-auto"> <i class="fas fa-eye"></i>
                        Tampilkan</button> <br>
                  </div>
               </div>

            </form>
         </div>
      </div>


      <?php
            if (!function_exists('changeDateFormat')) {
                function changeDateFormat($format='d-m-Y', $givenDate=null)
                {
                    return date($format, strtotime($givenDate));
                }
            }
      ?>

      <div id="kwitansiClose" class="card" style="margin-bottom: 10px; margin-left: 5px; margin-right: 5px;">
         <div id="kwitansiClose" class="card-header">
            <i class="fas fa-table me-1"></i>
            Purchase Order <br>
            <h5 class="text-center font-weight-light mt-2 mb-2">
               <?php echo $this->session->flashdata('pesan'); ?>
            </h5>
         </div>
         <div id="kwitansiClose" class="card-body">
            <table class="table table-bordered" id="datatablesSimple" width="100%">
               <thead>
                  <tr>
                     <th width="5%" class="text-center">No</th>
                     <th width="15%">No PO</th>
                     <th width="15%">Nama Barang</th>
                     <th width="20%">Nama Supplier</th>
                     <th width="10%" class="text-center">No Pesanan</th>
                     <th width="10%" class="text-center">Tanggal</th>
                     <th width="5%" class="text-center">Jumlah</th>
                     <th width="5%" class="text-center">Harga</th>
                     <th width="10%" class="text-center">Status</th>
                     <th width="10%" class="text-center">Opsi</th>
                  </tr>
               </thead>
               <tbody>
                  <?php $no = 1;
                        foreach ($dataOrder as $data) :
                        ?>

                  <tr>
                     <td class="text-center">
                        <?php echo $no++ ?>
                     </td>

                     <td>
                        <?php echo $data['no_purchase_order']?>
                     </td>

                     <td>
                        <?php echo $data['nama_barang']?>
                     </td>


                     <td>
                        <?php if ($data['nama_supplier'] == null) {
                            echo '<span class="badge bg-warning">REQUEST</span>';
                        } else {
                            echo $data['nama_supplier'];
                        }?>
                     </td>

                     <td class="text-center">
                        <?php if ($data['no_pesanan'] == null) {
                            echo '<span class="badge bg-warning">REQUEST</span>';
                        } else {
                            echo $data['no_pesanan'];
                        }?>
                     </td>

                     <td class="text-center">
                        <?php echo changeDateFormat('d-m-Y', $data['tanggal'])?>
                     </td>

                     <td class="text-center">
                        <?php echo $data['jumlah_order']?>
                     </td>

                     <td class="text-center">
                        <?php echo number_format($data['harga_barang'], 0, ',', '.')?>
                     </td>

                     <td class="text-center">
                        <?php if ($data['id_status'] == 3) {
                            echo '<span class="badge bg-warning">REQUEST</span>';
                        } elseif ($data['id_status'] == 4) {
                            echo '<span class="badge bg-success">ORDER</span>';
                        } else {
                            echo '<span class="badge bg-primary">DITERIMA</span>';
                        }
                        ?>
                     </td>

                     <td class="text-center">
                        <div class="btn-group">
                           <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-bs-toggle="dropdown"
                              data-bs-target="#dropdown" aria-expanded="false" aria-controls="dropdown">
                              Opsi
                           </button>
                           <div class="dropdown-menu text-black" style="background-color:aqua;">
                              <a class="dropdown-item text-black"
                                 href="<?php echo base_url('admin/DataPurchase/AccPurchaseOrder/accRequest/' . $data['id_purchase_order']) ?>"><i
                                    class="bi bi-pencil-square"></i> ACC Request</a>
                              <a class="dropdown-item text-black"
                                 href="<?php echo base_url('admin/DataPurchase/AddBiayaLayanan/addBiaya/' . $data['id_purchase_order']) ?>"><i
                                    class="bi bi-cash-stack"></i> Biaya Layanan</a>
                              <a class="dropdown-item text-black"
                                 href="<?php echo base_url('admin/DataPurchase/DiterimaPurchaseOrder/diterimaOrder/' . $data['id_purchase_order']) ?>"><i
                                    class="bi bi-check-circle"></i> Diterima</a>
                           </div>
                     </td>

                  </tr>

                  <?php endforeach; ?>
               </tbody>
            </table>
         </div>
      </div>


   </main>