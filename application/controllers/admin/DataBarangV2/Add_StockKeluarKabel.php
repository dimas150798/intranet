<?php

defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
ini_set('display_errors', 0);

class Add_StockKeluarKabel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == null) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Login terlebih dahulu</strong>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
            redirect('Welcome');
        }
    }

    public function addStockKeluar($id)
    {
        $checkStockBarang   = $this->BarangModelV2->checkDuplicateStockBarang($id);
        $idStockBarang      = $checkStockBarang->id_stockBarang;

        $checkStockRincian  = $this->BarangModelV2->checkStockRincianBarang($idStockBarang);
        $idStockRincian     = $checkStockRincian->id_stockRincian;

        $jumlahStockRincian = $checkStockRincian->jumlah;

        // var_dump($checkStockRincian);
        // die;

        if ($idStockRincian == null) {
            echo "
            <script>
            alert('Masukkan Detail Barang');history.go(-1)
            document.location.href = 'tambahData';            
            </script>
            ";
        } else {
            $data['barangNama']  =  $this->db->query("SELECT data_stockbarang.id_stockBarang, data_stockbarang.id_barang, data_stockbarang.jumlah_stockBarang, 
            data_stockbarang.jumlah_stockMutasi, data_namabarang.nama_barang, data_stockrincian.jumlah
    
            FROM data_stockbarang
            
            LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
            LEFT JOIN data_stockrincian ON data_stockbarang.id_stockBarang = data_stockrincian.id_stockBarang
            
            WHERE data_stockbarang.id_barang = '$id'
    
            GROUP BY data_stockbarang.id_stockBarang
    
            ")->result();

            $data['dataPegawai'] = $this->BarangModelV2->dataPegawai();
            $data['dataStatus'] = $this->BarangModelV2->dataStatus();
            $data['dataKodeKabel'] = $this->BarangModelV2->dataKodeKabel($id);
            $data['dataCustomer'] = $this->BarangModelV2->dataCustomerAll();

            $this->load->view('template/header', $data);
            $this->load->view('template/sidebarAdmin', $data);
            $this->load->view('admin/DataBarangV2/add_StockKeluarKabel', $data);
            $this->load->view('template/footer', $data);
        }
    }

    // data keluar ATK
    public function addStockKeluarKabel()
    {
        $data['dataSatuan'] = $this->BarangModelV2->dataSatuan();

        $this->form_validation->set_rules('jumlah', 'Jumlah Barang', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebarAdmin', $data);
            $this->load->view('admin/DataBarangV2/add_StockKeluarKabel', $data);
            $this->load->view('template/footer', $data);
        } else {
            $id_stockBarang         = $this->input->post('id_stockBarang');
            $jumlah                 = $this->input->post('jumlah');
            $jumlahNow              = $this->input->post('jumlahNow');
            $jumlahMutasi           = $this->input->post('jumlahMutasi');
            $jumlahKeluar           = $this->input->post('jumlahKeluar');
            $tanggal                = $this->input->post('tanggal');
            $id_pegawai             = $this->input->post('pegawai');
            $keterangan             = $this->input->post('keterangan');
            $id_barang              = $this->input->post('id_barang');
            $kode_barang            = $this->input->post('kodeBarang');
            $id_customer            = $this->input->post('dataCustomer');
            $id_status              = 1;

            // Stock Gudang
            $stockGudang            = $jumlahNow - $jumlah;
            // Stock Mutasi Stock Gudang
            $stockMutasi            = $jumlahMutasi + $jumlah;

            $checkStockRincian  = $this->BarangModelV2->checkStockKodeBarang($kode_barang);
            $jumlahStockRincian = $checkStockRincian->jumlah;

            $stockRincian           = $jumlahStockRincian - $jumlah;

            $dataStockKeluar = array(
                'id_stockBarang'    => $id_stockBarang,
                'kode_barang'       => $kode_barang,
                'jumlah'            => $jumlah,
                'tanggal'           => $tanggal,
                'id_pegawai'        => $id_pegawai,
                'id_customer'       => $id_customer,
                'id_status'         => 13,
                'keterangan'        => $keterangan
            );

            $dataStockGudang = array(
                'jumlah_stockBarang'    => $stockGudang,
                'jumlah_stockMutasi'    => $stockMutasi,
                'tanggal_mutasi'        => $tanggal
            );

            $dataStockRincian = array(
                'tanggal'           => $tanggal,
                'kode_barang'       => $kode_barang,
                'id_stockBarang'    => $id_stockBarang,
                'jumlah'            => $stockRincian,
                'tanggal'           => $tanggal,
                'id_status'         => 12
            );

            $where = array(
                'id_stockBarang'       => $id_stockBarang
            );

            $whereStockRincian = array(
                'kode_barang'       => $kode_barang
            );

            if ($jumlahNow == 0) {
                echo "
                <script>
                alert('Stock Barang Kosong');history.go(-1)
                document.location.href = 'tambahData';            
                </script>
                ";
            } else {
                if ($jumlah >= $jumlahStockRincian) {
                    echo "
                <script>
                alert('Melebihi Stock Yang Ada');history.go(-1)
                document.location.href = 'tambahData';            
                </script>
                ";
                } else {
                    if ($kode_barang == null && $kode_barang == 0) {
                        echo "
                        <script>
                        alert('Stock Barang Kosong');history.go(-1)
                        document.location.href = 'tambahData';            
                        </script>
                        ";
                    } else {
                        $this->BarangModelV2->updateData('data_stockrincian', $dataStockRincian, $whereStockRincian);
                        $this->BarangModelV2->updateData('data_stockbarang', $dataStockGudang, $where);
                        $this->BarangModelV2->insertData($dataStockKeluar, 'data_stockkeluar');
                        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>STOCK BARANG BERHASIL DIKURANGIN</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>');
                        redirect('admin/DataBarangV2/Data_StockBarangPelanggan');
                    }
                }
            }
        }
    }
}
