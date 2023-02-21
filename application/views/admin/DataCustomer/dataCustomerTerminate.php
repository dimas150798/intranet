<?php
$months = array(1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember');
?>

<div id="layoutSidenav_content">
   <main>

      <div class="container">
         <h4 class="mt-4" style="margin-left: 5px; margin-right: 5px;">Data Customer Terminate</h4>
         <ol class="breadcrumb mb-4" style="margin-left: 5px; margin-right: 5px;">
            <li class="breadcrumb-item"><a href="#">Data Customer Terminate</a></li>
            <li class="breadcrumb-item active">Tables</li>
         </ol>
      </div>

      <div class="card mb-3">
         <?php
            if (!function_exists('changeDateFormat')) {
                function changeDateFormat($format='d-m-Y', $givenDate=null)
                {
                    return date($format, strtotime($givenDate));
                }
            }
        ?>

         <div class="container">
            <div id="kwitansiClose" class="card" style="margin-bottom: 10px; margin-left: 5px; margin-right: 5px;">
               <div id="kwitansiClose" class="card-header">
                  <i class="fas fa-table me-1"></i>
                  Data Customer Terminate<br>
                  <h5 class="text-center font-weight-light mt-2 mb-2">
                     <?php echo $this->session->flashdata('pesan'); ?>
                  </h5>
               </div>
               <div id="kwitansiClose" class="card-body">
                  <table class="table table-bordered" id="datatablesSimple" width="100%">
                     <thead>
                        <tr>
                           <th width="5%" class="text-center">No</th>
                           <th width="20%">Nama</th>
                           <th width="10%">Paket</th>
                           <th width="20%">Alamat</th>
                           <th width="10%" class="text-center">Telepon</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $no = 1;
                            foreach ($dataCustomer as $data) :
                            ?>

                        <tr>
                           <td class="text-center">
                              <?php echo $no++ ?>
                           </td>
                           <td>
                              <?php echo $data['nama_customer']?>
                           </td>
                           <td>
                              <?php echo $data['pembelian_paket']?>
                           </td>
                           <td>
                              <?php echo $data['alamat_customer']?>,
                              <?php echo $data['nama_kota']?>,
                              <?php echo $data['nama_kecamatan']?>,
                              <?php echo $data['nama_kelurahan']?>
                           </td>
                           <td class="text-center">
                              <?php echo $data['tlp_customer']?>
                           </td>

                        </tr>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>

   </main>