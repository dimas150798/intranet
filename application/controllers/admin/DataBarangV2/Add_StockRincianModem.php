<?php

defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
ini_set('display_errors', 0);

class Add_StockRincianModem extends CI_Controller
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
        $data['barangNama']  =  $this->db->query("SELECT COUNT(data_aktivasi.id_aktivasi) AS jumlahDetailBarang, data_stockbarang.id_stockBarang, data_stockbarang.id_barang, 
        data_stockbarang.jumlah_stockBarang, data_namabarang.nama_barang, data_namabarang.id_peralatan

        FROM data_stockbarang
        
        LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
        LEFT JOIN data_aktivasi ON data_aktivasi.id_stockBarang = data_stockbarang.id_stockBarang
        
        WHERE data_stockbarang.id_barang = '$id'

        GROUP BY data_stockbarang.id_stockBarang

        ")->result();

        $checkNama= $this->BarangModelV2->checkNamaBarang($id);

        $namaBarang = $checkNama->nama_barang;

        if ($namaBarang == "Adaptor 1.5A" or $namaBarang == "Adaptor 1A" or $namaBarang == "Adaptor 2A"
        or $namaBarang == "Patch Core Hitam UPC Outdor" or $namaBarang == "Patch Core Kuning APC (Hijau)"
        or $namaBarang == "Patch Core Kuning UPC (Biru)") {
            echo "
            <script>
            alert('Tidak Perlu Input Detail Barang');history.go(-1)
            document.location.href = 'tambahData';            
            </script>
            ";
        } else {
            $data['dataPegawai'] = $this->BarangModelV2->dataPegawai();
            $data['dataStatus'] = $this->BarangModelV2->dataStatus();
            $data['dataKeadaan'] = $this->BarangModelV2->dataKeadaanBarang();

            $this->load->view('template/header', $data);
            $this->load->view('template/sidebarAdmin', $data);
            $this->load->view('admin/DataBarangV2/add_StockRincianModem', $data);
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

        $checkTotalBarang = $this->BarangModelV2->checkDuplicateStockBarang($id_barang);
        $checkSNBarang = $this->BarangModelV2->checkDataAktivasi($kode_barang);
        $checkStockRincian = $this->BarangModelV2->countDetailStock($id_stockBarang);

        // melihat SN pada modem
        $SN_Modem       = $checkSNBarang->kode_barang;

        // melihat stock barang, stock mutasi dan stock barang rusak
        $StockBarang    = $checkTotalBarang->jumlah_stockBarang;
        $StockMutasi    = $checkTotalBarang->jumlah_stockMutasi;
        $StockRusak     = $checkTotalBarang->jumlah_stockRusak;

        // menjumlahkan stock barang, stock mutasi dan stock barang rusak
        $JumlahStockAll = $StockBarang + $StockMutasi + $StockRusak;

        // melihat jumlah stock pada detail barang
        $StockDetailAll = $checkStockRincian->jumlahBarang;

        // menjumlahkan data aktivasi dengan detail barang (cache)
        $jumlahKeseluruhanBarang = $jumlahDetailBarang + $StockDetailAll;

        $dataAktivasi = array(
                'kode_barang'       => $kode_barang,
                'id_stockBarang'    => $id_stockBarang,
                'jumlah_modem'      => $jumlah,
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
            if ($SN_Modem != null) {
                echo "
                <script>
                alert('SN Sudah Terpakai');history.go(-1)
                document.location.href = 'tambahData';            
                </script>
                ";
            } else {
                if ($jumlahKeseluruhanBarang >= $JumlahStockAll) {
                    echo "
                    <script>
                    alert('Data Yang Dimasukkan Melebihi Stock Yang Ada');history.go(-1)
                    document.location.href = 'tambahData';            
                    </script>
                    ";
                } else {
                    $this->BarangModelV2->insertData($dataAktivasi, 'data_aktivasi');
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>TAMBAH DATA BERHASIL</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>');
                    redirect('admin/DataBarangV2/Data_StockBarangModem');
                }
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
