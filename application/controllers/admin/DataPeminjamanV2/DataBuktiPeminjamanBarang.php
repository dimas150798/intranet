<?php

defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
ini_set('display_errors', 0);

class DataBuktiPeminjamanBarang extends CI_Controller
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

    public function index()
    {
        if ((isset($_GET['day']) && $_GET['day'] != '')) {
            $day    = $_GET['day'];
            $this->session->set_userdata('day', $day);
        } else {
            $day = $this->session->userdata('day');
        }

        $pecahDay      = explode("-", $day);

        $tahun         = $pecahDay[0];
        $bulan         = $pecahDay[1];
        $dayTanggal    = $pecahDay[2];

        // Mengambil data bulan dan tahun
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['day']   = $this->session->userdata('day');
        $data['$dayTanggal'] = $dayTanggal;

        $data['dataBarang'] = $this->BarangModel->dataPeminjamanBarangPegawai($day);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataPeminjamanV2/dataBuktiPeminjamanBarang', $data);
        $this->load->view('template/footer', $data);
    }

    public function pengembalianBarang($id)
    {
        $checkPengembalian = $this->BarangModelV2->checkPengembalianBarang($id);

        $id_stockBarang     = $checkPengembalian->id_stockBarang;
        $jumlahStockBarang  = $checkPengembalian->jumlahBarangStock;
        $jumlahStockMutasi  = $checkPengembalian->jumlahBarangMutasi;
        $jumlahPengembalian = $checkPengembalian->jumlah;

        $penambahanStockBarang = $jumlahStockBarang + $jumlahPengembalian;
        $penambahanStockMutasi = $jumlahStockMutasi - $jumlahPengembalian;

        $id_status          = 2;

        $dataPengembalian = array(
            'id_status'            => $id_status,
        );


        $dataRestock = array(
            'jumlah_stockBarang'    => $penambahanStockBarang,
            'jumlah_stockMutasi'    => $penambahanStockMutasi
        );

        $wherePeminjaman = array(
            'id_peminjaman_barang'        => $id
        );

        $whereBarang = array(
            'id_stockBarang' => $id_stockBarang
        );

        if ($checkPengembalian->id_status == 2) {
            echo "
                    <script>
                    alert('Barang Sudah Di Kembalikan');history.go(-1)
                    document.location.href = 'tambahData';            
                    </script>
                    ";
        } else {
            $this->BarangModel->updateData('data_stockbarang', $dataRestock, $whereBarang);
            $this->BarangModel->updateData('data_peminjaman_barang', $dataPengembalian, $wherePeminjaman);

            $this->session->set_flashdata('pesan', '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>PENGEMBALIAN BARANG BERHASIL</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');

            redirect('admin/DataPeminjamanV2/DataPeminjamanBarang');
        }
    }

    public function detailPeminjaman($id)
    {
        $data['dataPeminjaman']  =  $this->db->query("SELECT bukti_barang_peminjaman.id_bukti_barang_peminjaman, bukti_barang_peminjaman.id_pegawai, 
        bukti_barang_peminjaman.foto_peminjaman1, bukti_barang_peminjaman.foto_peminjaman2, 
        bukti_barang_peminjaman.foto_pengembalian1, bukti_barang_peminjaman.foto_pengembalian2, 
        bukti_barang_peminjaman.tanggal_pengembalian, bukti_barang_peminjaman.tanggal_peminjaman, data_pegawai.nama_pegawai

        FROM bukti_barang_peminjaman 
        LEFT JOIN data_pegawai ON bukti_barang_peminjaman.id_pegawai = data_pegawai.id_pegawai
        
        WHERE bukti_barang_peminjaman.id_bukti_barang_peminjaman = '$id'
        
        ORDER BY bukti_barang_peminjaman.id_bukti_barang_peminjaman DESC")->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataPeminjamanV2/detailPeminjamanBarang', $data);
        $this->load->view('template/footer', $data);
    }

    public function deleteData($id)
    {
        $where = array('id_bukti_barang_peminjaman' => $id);
        $this->BarangModel->deleteData($where, 'bukti_barang_peminjaman');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>DELETE DATA BERHASIL</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('admin/DataPeminjamanV2/DataBuktiPeminjamanBarang');
    }
}
