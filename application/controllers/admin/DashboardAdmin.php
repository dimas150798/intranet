<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DashboardAdmin extends CI_Controller
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
        $day = date('Y-m-d');
        $pecahDay      = explode("-", $day);

        $tahun         = $pecahDay[0];
        $bulan         = $pecahDay[1];
        $dayTanggal    = $pecahDay[2];

        // $data['peminjamanBarangPending'] = $this->BarangModel->peminjamanBarangPending();
        // $data['jumlahBarangKeluar'] = $this->BarangModel->jumlahBarangKeluar($bulan);
        // $data['jumlahBarangRestock'] = $this->BarangModel->jumlahBarangRestock($bulan);
        // $data['jumlahBarang'] = $this->BarangModel->jumlahBarang();
        // $data['jumlahCustomer'] = $this->CustomerModel->jumlahCustomer();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/dashboardAdmin', $data);
        $this->load->view('template/footer', $data);
    }
}
