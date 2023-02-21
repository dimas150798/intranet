<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_BarangMutasi extends CI_Controller
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
        $data['dataMutasi'] = $this->BarangModelV2->data_BarangMutasi();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataBarangV2/data_BarangMutasi', $data);
        $this->load->view('template/footer', $data);
    }

    public function deleteData($id)
    {
        $checkStockKeluar = $this->BarangModelV2->checkStockKeluar($id);

        $jumlahStockKeluar = $checkStockKeluar->jumlah;
        $idStockBarang = $checkStockKeluar->id_stockBarang;

        $checkStockBarang = $this->BarangModelV2->checkStockBarang($idStockBarang);
        $checkStockRincian = $this->BarangModelV2->checkStockRincian($idStockBarang);

        // mengambil data kode barang
        $kodeBarang = $checkStockRincian->kode_barang;

        // mengambil data jumlah stock barang
        $jumlahStockBarang = $checkStockBarang->jumlah_stockBarang;
        // mengambil data jumlah mutasi barang
        $jumlahStockMutasi = $checkStockBarang->jumlah_stockMutasi;

        // pengembalian data barang keluar dengan menambah stock
        $penambahanStock = $jumlahStockBarang + $jumlahStockKeluar;
        // pengembalian data barang keluar dengan mengurangi mutasi
        $penguranganStock = $jumlahStockMutasi - $jumlahStockKeluar;

        $dataCustomer = array(
            'kode_barang' => null
        );

        $dataStockBarang = array(
            'jumlah_stockBarang'    => $penambahanStock,
            'jumlah_stockMutasi'    => $penguranganStock
        );

        $whereStockBarang = array(
            'id_stockBarang'    => $idStockBarang
        );

        $whereStockKeluar = array('id_stockKeluar' => $id);

        $whereKodeBarang = array('kode_barang' => $kodeBarang);

        $this->BarangModelV2->updateData('data_customer', $dataCustomer, $whereKodeBarang);
        $this->BarangModelV2->updateData('data_stockbarang', $dataStockBarang, $whereStockBarang);
        $this->BarangModel->deleteData($whereStockKeluar, 'data_stockkeluar');
        $this->BarangModel->deleteData($whereKodeBarang, 'data_stockrincian');

        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>DELETE DATA BERHASIL</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('admin/DataBarangV2/Data_BarangMutasi');
    }
}
