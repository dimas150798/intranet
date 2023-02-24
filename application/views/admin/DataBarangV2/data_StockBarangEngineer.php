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
         <h4 class="mt-4" style="margin-left: 5px; margin-right: 5px;">Peralatan Engineer</h4>
         <ol class="breadcrumb" style="margin-left: 5px; margin-right: 5px;">
            <li class="breadcrumb-item"><a href="#">Data Barang Gudang</a></li>
            <li class="breadcrumb-item active">Tables</li>
         </ol>

         <div class="card mb-3">
            <div id="kwitansiClose" class="card-header">
               <i class="fas fa-table me-1"></i>
               Data Peralatan Engineer <br>
               <h5 class="text-center font-weight-light mt-2 mb-2">
                  <?php echo $this->session->flashdata('pesan'); ?>
               </h5>
            </div>
            <div id="kwitansiClose" class="card-body">
               <table class="table table-bordered" id="datatablesSimple" width="100%">
                  <thead>
                     <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="20%">Nama Barang</th>
                        <th width="5%" class="text-center">Jumlah Stock</th>
                        <th width="5%" class="text-center">Jumlah Mutasi</th>
                        <th width="5%" class="text-center">Last Restock</th>
                        <th width="5%" class="text-center">Last Mutasi</th>
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
                           <?php echo $data['jumlah_stockBarang']?>
                        </td>
                        <td class="text-center">
                           <?php if ($data['jumlah_stockMutasi'] == null) {
                            echo "0";
                        } else {
                            echo $data['jumlah_stockMutasi'];
                        }?>
                        </td>
                        <td class="text-center">
                           <?php if ($data['tanggal_restock'] == null) {
                            echo "-";
                        } else {
                            echo changeDateFormat('d-m-Y', $data['tanggal_restock']);
                        }?>
                        </td>
                        <td class="text-center">
                           <?php if ($data['tanggal_mutasi'] == null) {
                            echo "-";
                        } else {
                            echo changeDateFormat('d-m-Y', $data['tanggal_mutasi']);
                        }?>
                        </td>


                        <td class="text-center">
                           <a class="btn btn-sm btn-warning"
                              href="<?php echo base_url('admin/DataBarangV2/Add_StockRincianEngineer/addStockRincian/' . $data['id_stockBarang']) ?>"><i
                                 class="bi bi-clipboard2-plus-fill"></i></a>
                           <a class="btn btn-sm btn-primary"
                              href="<?php echo base_url('admin/DataBarangV2/Add_StockKeluarEngineer/addStockKeluar/' . $data['id_barang']) ?>"><i
                                 class="bi bi-dash-lg"></i></a>
                        </td>

                     </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>


   </main>