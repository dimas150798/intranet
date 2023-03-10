<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_StockRincianNonModem extends CI_Controller
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
        $data['dataStock'] = $this->BarangModelV2->data_StockRincian();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataBarangV2/data_StockRincianNonModem', $data);
        $this->load->view('template/footer', $data);
    }

    public function deleteData($id)
    {
        $checkDetailRincian = $this->BarangModelV2->checkStockDetailRincian($id);

        // Mengambil data kode barang pada detail rincian
        $kodeBarang = $checkDetailRincian->kode_barang;

        // Mengambil data id stock barang pada detail rincian
        $idStockBarang = $checkDetailRincian->id_stockBarang;

        $checkStockBarang = $this->BarangModelV2->checkStockBarang($idStockBarang);

        // mengambil data jumlah stock barang
        $jumlahStockBarang = $checkStockBarang->jumlah_stockBarang;
        // mengambil data jumlah mutasi barang
        $jumlahStockMutasi = $checkStockBarang->jumlah_stockMutasi;

        // pengembalian data barang keluar dengan menambah stock
        $penambahanStock = $jumlahStockBarang + 1;
        // pengembalian data barang keluar dengan mengurangi mutasi
        $penguranganStock = $jumlahStockMutasi - 1;

        $dataStockBarang = array(
            'jumlah_stockBarang'    => $penambahanStock,
            'jumlah_stockMutasi'    => $penguranganStock
        );

        $whereStockBarang = array(
            'id_stockBarang'    => $idStockBarang
        );

        $whereKodeBarang = array(
            'kode_barang'    => $kodeBarang
        );

        $where = array('id_stockRincian' => $id);

        if ($checkDetailRincian->id_status == 13) {
            $this->BarangModelV2->updateData('data_stockbarang', $dataStockBarang, $whereStockBarang);
            $this->BarangModelV2->deleteData($where, 'data_stockrincian');
            $this->BarangModelV2->deleteData($whereKodeBarang, 'data_stockkeluar');

            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>DELETE DATA BERHASIL</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
            redirect('admin/DataBarangV2/Data_StockRincianNonModem');
        } else {
            $this->BarangModelV2->deleteData($where, 'data_stockrincian');
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>DELETE DATA BERHASIL</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
            redirect('admin/DataBarangV2/Data_StockRincianNonModem');
        }
    }
}
