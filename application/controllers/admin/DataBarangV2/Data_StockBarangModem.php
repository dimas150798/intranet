<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_StockBarangModem extends CI_Controller
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
        $data['dataStock'] = $this->BarangModelV2->data_StockBarangModem();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataBarangV2/data_StockBarangModem', $data);
        $this->load->view('template/footer', $data);
    }

    public function deleteData($id)
    {
        $where = array('id_barang' => $id);
        $this->BarangModel->deleteData($where, 'data_namaBarang');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>DELETE DATA BERHASIL</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('admin/DataBarangV2/Data_BarangNama');
    }
}
