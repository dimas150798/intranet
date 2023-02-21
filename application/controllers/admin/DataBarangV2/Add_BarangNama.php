<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Add_BarangNama extends CI_Controller
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
        $data['dataSatuan'] = $this->BarangModelV2->dataSatuan();
        $data['dataKategori'] = $this->BarangModelV2->dataKategoriPeralatan();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataBarangV2/add_BarangNama', $data);
        $this->load->view('template/footer', $data);
    }

    public function addData()
    {
        $data['dataSatuan'] = $this->BarangModelV2->dataSatuan();

        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebarAdmin', $data);
            $this->load->view('admin/DataBarangV2/add_BarangNama', $data);
            $this->load->view('template/footer', $data);
        } else {
            $nama_barang            = $this->input->post('nama_barang');
            $satuan                 = $this->input->post('satuan');
            $kategori               = $this->input->post('kategori');

            $data = array(
                'nama_barang'        => $nama_barang,
                'id_satuan'         => $satuan,
                'id_peralatan'      => $kategori,
            );

            $checkDuplicateNamaBarang = $this->BarangModelV2->checkDuplicateNamaBarang($nama_barang);

            if ($checkDuplicateNamaBarang->nama_barang == $nama_barang) {
                echo "
                        <script>
                        alert('Nama Barang Sudah Ada');history.go(-1)
                        document.location.href = 'tambahData';            
                        </script>
                        ";
            } else {
                $this->BarangModelV2->insertData($data, 'data_namabarang');
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>TAMBAH DATA BERHASIL</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
                redirect('admin/DataBarangV2/Data_BarangNama');
            }
        }
    }
}
