<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AddBarangPusat extends CI_Controller
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
        $this->load->view('admin/DataBarang/addBarangPusat', $data);
        $this->load->view('template/footer', $data);
    }

    public function addData()
    {
        $data['dataBarang'] = $this->BarangModel->dataBarangPusat();
        $data['dataSatuan'] = $this->BarangModel->dataSatuan();

        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebarAdmin', $data);
            $this->load->view('admin/DataBarang/addBarangPusat', $data);
            $this->load->view('template/footer', $data);
        } else {
            // kode Barang Inisilisasi
            $table         = "data_barang";
            $field         = "kode_barang";
            $kodeBarang    = $this->BarangModel->getKodeBarang($table, $field);
            $noUrut        = (int) substr($kodeBarang, 4, 4);
            $noUrut++;
            $str           = "INF";
            $newKode       = $str . sprintf('%04s', $noUrut);

            $nama_barang            = $this->input->post('nama_barang');
            $satuan                 = $this->input->post('satuan');
            $tanggal                = $this->input->post('tanggal');
            $jumlah                 = $this->input->post('jumlah');
            $keterangan             = $this->input->post('keterangan');

            $dataRestock = array(
                'nama_barang'        => $nama_barang,
                'tanggal'            => $tanggal,
                'jumlah'             => $jumlah,
            );

            $data = array(
                'kode_barang'        => $newKode,
                'nama_barang'        => $nama_barang,
                'satuan'             => $satuan,
                'tanggal'            => $tanggal,
                'jumlah'             => $jumlah,
                'keterangan'         => $keterangan,
            );

            $checkDuplicateBarangPusat = $this->BarangModel->checkDuplicateBarangPusat($nama_barang);

            if ($checkDuplicateBarangPusat->nama_barang == $nama_barang && $checkDuplicateBarangPusat->satuan == $satuan) {
                echo "
                        <script>
                        alert('Nama Barang Sudah Ada');history.go(-1)
                        document.location.href = 'tambahData';            
                        </script>
                        ";
            } else {
                $this->BarangModel->insertData($data, 'data_barang');
                $this->BarangModel->insertData($dataRestock, 'data_barang_restock');
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>TAMBAH DATA BERHASIL</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
                redirect('admin/DataBarang/DataBarangPusat');
            }
        }
    }
}
