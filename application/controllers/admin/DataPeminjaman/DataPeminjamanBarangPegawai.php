<?php

defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
ini_set('display_errors', 0);

class DataPeminjamanBarangPegawai extends CI_Controller
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
        $this->load->view('admin/DataPeminjaman/dataPeminjamanBarangPegawai', $data);
        $this->load->view('template/footer', $data);
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
        $this->load->view('admin/DataPeminjaman/detailPeminjamanBarang', $data);
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
        redirect('admin/DataPeminjaman/DataPeminjamanBarangPegawai');
    }
}
