<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AddPeminjamanBarangPegawai extends CI_Controller
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
        $data['dataPegawai'] = $this->PegawaiModel->dataPegawai();
        $data['dataBarang'] = $this->BarangModel->dataBarangPusat();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataPeminjaman/addPeminjamanBarangPegawai', $data);
        $this->load->view('template/footer', $data);
    }

    public function addData()
    {
        $id_pegawai             = $this->input->post('pegawai');
        $photo1                 = $_FILES['photo1']['name'];
        $photo2                 = $_FILES['photo2']['name'];
        $tanggal_peminjaman     = date('Y/m/d');

        if ($photo1 = '') {
        } else {
            $config['upload_path']    = './assets/bukti_peminjaman';
            $config['allowed_types']   = 'jpg|jpeg|png|tiff';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('photo1')) {
                echo "Photo Gagal diupload";
            } else {
                $photo1 = $this->upload->data('file_name');
            }
        }

        if ($photo2 = '') {
        } else {
            $config['upload_path']    = './assets/bukti_peminjaman';
            $config['allowed_types']   = 'jpg|jpeg|png|tiff';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('photo2')) {
                echo "Photo Gagal diupload";
            } else {
                $photo2 = $this->upload->data('file_name');
            }
        }

        $data = array(
                'id_pegawai'                => $id_pegawai,
                'foto_peminjaman1'          => $photo1,
                'foto_peminjaman2'          => $photo2,
                'tanggal_peminjaman'        => $tanggal_peminjaman
            );


        $this->BarangModel->insertData($data, 'bukti_barang_peminjaman');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>PEMINJAMAN BARANG BERHASIL</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
        redirect('admin/DataPeminjaman/DataPeminjamanBarangPegawai');
    }
}
