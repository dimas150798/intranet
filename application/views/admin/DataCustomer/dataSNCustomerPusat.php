<?php
$months = array(1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember');
?>

<div id="layoutSidenav_content">
   <main>

      <div class="container">
         <h4 class="mt-4" style="margin-left: 5px; margin-right: 5px;">Data SN Customer Pusat</h4>
         <ol class="breadcrumb mb-4" style="margin-bottom: 10px; margin-left: 5px; margin-right: 5px;">
            <li class="breadcrumb-item"><a href="#">Data SN Customer Pusat</a></li>
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

         <div id="kwitansiClose" class="card" style="margin-bottom: 10px; margin-left: 5px; margin-right: 5px;">
            <div id="kwitansiClose" class="card-header">
               <i class="fas fa-table me-1"></i>
               Data SN Customer Pusat
            </div>
            <div id="kwitansiClose" class="card-body">
               <table class="table table-bordered" id="datatablesSimple" width="100%">
                  <thead>
                     <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="20%">Nama</th>
                        <th width="20%">Nama Modem</th>
                        <th width="20%">SN</th>
                        <th width="5%" class="text-center">Opsi</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $no = 1;
                        foreach ($dataCustomerSN as $data) :
                        ?>

                     <tr>
                        <td class="text-center">
                           <?php echo $no++ ?>
                        </td>
                        <td>
                           <?php echo $data['nama_customer']?>
                        </td>
                        <td>
                           <?php echo $data['nama_barang']?>
                        </td>
                        <td>
                           <?php echo $data['SN']?>
                        </td>

                        <td class="text-center">
                           <a onclick="return confirm('Yakin Edit Data')" class="btn btn-sm btn-warning"
                              href="<?php echo base_url('admin/DataCustomer/DataSNCustomerPusat/editData/' . $data['id_barang_mutasi']) ?>"><i
                                 class="bi bi-pencil-square"></i></a>
                           <a onclick="return confirm('Yakin Menghapus Data')" class="btn btn-sm btn-danger"
                              href="<?php echo base_url('admin/DataCustomer/DataSNCustomerPusat/deleteData/' . $data['id_barang_mutasi']) ?>"><i
                                 class="fas fa-trash"></i></a>
                        </td>

                     </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>


   </main>