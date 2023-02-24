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
        $kodeBarang = $checkStockKeluar->kode_barang;
        $idCustomer = $checkStockKeluar->id_customer;

        $checkStockBarang = $this->BarangModelV2->checkStockBarang($idStockBarang);

        // mengambil data jumlah stock barang
        $jumlahStockBarang = $checkStockBarang->jumlah_stockBarang;
        // mengambil data jumlah mutasi barang
        $jumlahStockMutasi = $checkStockBarang->jumlah_stockMutasi;

        // pengembalian data barang keluar dengan menambah stock
        $penambahanStock = $jumlahStockBarang + $jumlahStockKeluar;
        // pengembalian data barang keluar dengan mengurangi mutasi
        $penguranganStock = $jumlahStockMutasi - $jumlahStockKeluar;

        $idStatus = 12;

        $dataAktivasi = array(
            'PCK_jumlah'    => null,
            'PCH_jumlah'    => null,
            'id_status'     => 12,
            'id_pegawai'    => null,
            'id_customer'   => null
        );

        $dataCustomer = array(
            'kode_barang' => null
        );

        $dataStockRincian = array(
            'id_status'     => $idStatus,
            'id_pegawai'    => $idCustomer
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

        $this->BarangModelV2->updateData('data_aktivasi', $dataAktivasi, $whereKodeBarang);
        $this->BarangModelV2->updateData('data_stockrincian', $dataStockRincian, $whereKodeBarang);
        $this->BarangModelV2->updateData('data_customer', $dataCustomer, $whereKodeBarang);
        $this->BarangModelV2->updateData('data_stockbarang', $dataStockBarang, $whereStockBarang);
        $this->BarangModel->deleteData($whereStockKeluar, 'data_stockkeluar');
        // $this->BarangModel->deleteData($whereKodeBarang, 'data_stockrincian');

        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>DELETE DATA BERHASIL</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('admin/DataBarangV2/Data_BarangMutasi');
    }
}
