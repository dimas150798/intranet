<?php

class DataPurchaseOrder extends CI_Controller
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
        $bulan           = $this->input->post('bulan');
        $tahun           = $this->input->post('tahun');

        // Mencari data sesuai bulan dan tahun
        if ($bulan != null && $tahun != null) {
            $bulan     = $this->input->post('bulan');
            $tahun     = $this->input->post('tahun');
        } else {
            $day    = date('d');
            $bulan  = date('m');
            $tahun  = date('Y');
        }

        // Menampilkan tanggal pada awal bulan
        $tanggal_awal     = date("01");
        // Menampilkan tanggal pada akhir bulan
        $tanggal_akhir    = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

        // Menggabungkan bulan dan tahun
        $tanggalAwal      = $tahun.'-'.$bulan.'-'.$tanggal_awal;
        $tanggalAkhir     = $tahun.'-'.$bulan.'-'.$tanggal_akhir;

        // Mengambil data bulan dan a
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $data['dataOrder'] = $this->PurchasingModel->dataOrder($tanggalAwal, $tanggalAkhir);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataPurchase/dataPurchasingOrder', $data);
        $this->load->view('template/footer', $data);
    }
}
