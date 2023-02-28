<?php

defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
ini_set('display_errors', 0);

class Add_StockRincianPelanggan extends CI_Controller
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

    public function addStockRincian($id)
    {
        $checkNama= $this->BarangModelV2->checkNamaBarangKabel($id);

        if ($checkNama == null) {
            echo "
            <script>
            alert('Tidak Perlu Input Detail Barang');history.go(-1)
            document.location.href = 'tambahData';            
            </script>
            ";
        } else {
            $data['barangNama']  =  $this->db->query("SELECT data_stockbarang.id_stockBarang, data_stockbarang.id_barang, 
            data_stockbarang.jumlah_stockBarang, data_namabarang.nama_barang, data_namabarang.id_peralatan, data_stockrincian.jumlah
    
            FROM data_stockbarang
            
            LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
            LEFT JOIN data_stockrincian ON data_stockbarang.id_stockBarang = data_stockrincian.id_stockBarang
            
            WHERE data_stockbarang.id_barang = '$id'
    
            GROUP BY data_stockbarang.id_stockBarang
    
            ")->result();

            $data['dataPegawai'] = $this->BarangModelV2->dataPegawai();
            $data['dataStatus'] = $this->BarangModelV2->dataStatus();
            $data['dataKeadaan'] = $this->BarangModelV2->dataKeadaanBarang();

            $this->load->view('template/header', $data);
            $this->load->view('template/sidebarAdmin', $data);
            $this->load->view('admin/DataBarangV2/add_StockRincianPelanggan', $data);
            $this->load->view('template/footer', $data);
        }
    }

    public function addStockRincianAksi()
    {
        $data['dataSatuan'] = $this->BarangModelV2->dataSatuan();

        $kode_barang            = $this->input->post('kode_barang');
        $id_stockBarang         = $this->input->post('id_stockBarang');
        $jumlah                 = $this->input->post('jumlah');
        $tanggal                = $this->input->post('tanggal');
        $id_status              = 12;
        $id_keadaan             = $this->input->post('keadaan');
        $id_barang              = $this->input->post('id_barang');
        $jumlahDetailBarang     = $this->input->post('jumlahDetailBarang');

        $checkJumlahKabel = $this->BarangModelV2->checkJumlahKabel($id_stockBarang);

        $jumlahKabelDetail = $checkJumlahKabel->jumlahKabel;

        // var_dump($checkJumlahKabel);
        // die;

        $dataStockRincian = array(
                'kode_barang'       => $kode_barang,
                'id_stockBarang'    => $id_stockBarang,
                'jumlah'            => $jumlah,
                'tanggal'           => $tanggal,
                'id_status'         => $id_status,
                'id_keadaanbarang'  => $id_keadaan
            );

        if ($tanggal == null && $id_keadaan == null && $id_status == null) {
            echo "
            <script>
            alert('Terdapat Data Belum Terisi');history.go(-1)
            document.location.href = 'tambahData';            
            </script>
            ";
        } else {
            $checkTotalBarang = $this->BarangModelV2->checkDuplicateStockBarang($id_barang);

            $StockBarang = $checkTotalBarang->jumlah_stockBarang;
            $StockMutasi = $checkTotalBarang->jumlah_stockMutasi;
            $JumlahStockAll = $StockBarang + $StockMutasi;

            if ($jumlahKabelDetail >= $jumlahDetailBarang) {
                echo "
                    <script>
                    alert('Data Yang Dimasukkan Melebihi Stock Yang Ada');history.go(-1)
                    document.location.href = 'tambahData';            
                    </script>
                    ";
            } else {
                $this->BarangModelV2->insertData($dataStockRincian, 'data_stockrincian');
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>TAMBAH DATA BERHASIL</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>');
                redirect('admin/DataBarangV2/Data_StockBarangPelanggan');
            }
        }
    }

    public function deleteData($id)
    {
        $where = array('id_barang' => $id);
        $this->BarangModel->deleteData($where, 'data_namabarang');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>DELETE DATA BERHASIL</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('admin/DataBarangV2/Data_BarangNama');
    }
}
