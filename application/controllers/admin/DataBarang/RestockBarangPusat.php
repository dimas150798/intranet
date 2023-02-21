<?php

defined('BASEPATH') or exit('No direct script access allowed');

class RestockBarangPusat extends CI_Controller
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
        $data['dataBarang'] = $this->BarangModel->dataBarangPusat();
        $data['dataSatuan'] = $this->BarangModel->dataSatuan();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataBarang/restockBarangPusat', $data);
        $this->load->view('template/footer', $data);
    }

    public function restockBarang($id)
    {
        $data['dataBarang']  =  $this->db->query("SELECT id_barang, kode_barang, nama_barang, satuan, tanggal, jumlah
            
            FROM data_barang
            
            WHERE id_barang  = '$id'")->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataBarang/restockBarangPusat', $data);
        $this->load->view('template/footer', $data);
    }

    public function restockDataAksi()
    {
        $id                     = $this->input->post('id_barang');

        $data['dataBarang']   =  $this->db->query("SELECT id_barang, kode_barang, nama_barang, satuan, tanggal, jumlah
            
        FROM data_barang
        
        WHERE id_barang  = '$id'")->result();

        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header');
            $this->load->view('template/sidebarAdmin');
            $this->load->view('admin/DataBarang/restockBarangPusat');
            $this->load->view('template/footer');
        } else {
            $nama_barang        = $this->input->post('nama_barang');
            $tanggal            = $this->input->post('tanggal');
            $jumlah             = $this->input->post('jumlah');
            $jumlahNow          = $this->input->post('jumlahNow');

            $restock            = $jumlahNow + $jumlah;

            $dataBarangRestock = array(
                'nama_barang'       => $nama_barang,
                'tanggal'           => $tanggal,
                'jumlah'            => $jumlah,
            );

            $data = array(
                'nama_barang'       => $nama_barang,
                'tanggal'           => $tanggal,
                'jumlah'            => $restock,
            );

            $where = array(
                'id_barang'        => $id
            );

            $this->BarangModel->insertData($dataBarangRestock, 'data_barang_restock');
            $this->BarangModel->updateData('data_barang', $data, $where);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>RESTOCK BARANG BERHASIL</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>');
            redirect('admin/DataBarang/DataBarangPusat');
        }
    }
}
