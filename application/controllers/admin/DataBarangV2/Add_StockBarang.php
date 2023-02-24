<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Add_StockBarang extends CI_Controller
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
        $data['dataBarang'] = $this->BarangModelV2->data_NamaBarang();
        $data['dataPegawai'] = $this->BarangModelV2->dataPegawai();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataBarangV2/add_StockBarang', $data);
        $this->load->view('template/footer', $data);
    }

    public function addData()
    {
        $data['dataBarang'] = $this->BarangModelV2->data_NamaBarang();
        $data['dataPegawai'] = $this->BarangModelV2->dataPegawai();

        $this->form_validation->set_rules('jumlah_stockBarang', 'Jumlah Stock Barang', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebarAdmin', $data);
            $this->load->view('admin/DataBarangV2/add_StockBarang', $data);
            $this->load->view('template/footer', $data);
        } else {
            $barang                 = $this->input->post('barang');
            $jumlah                 = $this->input->post('jumlah_stockBarang');

            $data = array(
                'id_barang'             => $barang,
                'jumlah_stockBarang'    => $jumlah,
            );

            $checkDuplicateNamaBarang = $this->BarangModelV2->checkDuplicateStockBarang($barang);

            if ($checkDuplicateNamaBarang->id_barang == $barang) {
                echo "
                        <script>
                        alert('Nama Barang Sudah Ada');history.go(-1)
                        document.location.href = 'tambahData';            
                        </script>
                        ";
            } else {
                $this->BarangModelV2->insertData($data, 'data_stockbarang');
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>TAMBAH DATA BERHASIL</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>');
                redirect('admin/DataBarangV2/Data_BarangNama');
            }
        }
    }
}
