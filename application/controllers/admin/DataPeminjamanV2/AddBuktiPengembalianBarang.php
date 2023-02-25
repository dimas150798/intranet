<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AddBuktiPengembalianBarang extends CI_Controller
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

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataPeminjamanV2/addBuktiPengembalianBarang', $data);
        $this->load->view('template/footer', $data);
    }

    public function addPengembalian($id)
    {
        $data['dataPeminjaman']  =  $this->db->query("SELECT bukti_barang_peminjaman.id_bukti_barang_peminjaman, bukti_barang_peminjaman.id_pegawai, 
        bukti_barang_peminjaman.foto_peminjaman1, bukti_barang_peminjaman.foto_peminjaman2, 
        bukti_barang_peminjaman.foto_pengembalian1, bukti_barang_peminjaman.foto_pengembalian2, 
        bukti_barang_peminjaman.tanggal_pengembalian, bukti_barang_peminjaman.tanggal_peminjaman, data_pegawai.nama_pegawai

        FROM bukti_barang_peminjaman 
        LEFT JOIN data_pegawai ON bukti_barang_peminjaman.id_pegawai = data_pegawai.id_pegawai
        
        WHERE bukti_barang_peminjaman.id_bukti_barang_peminjaman = '$id'
        
        ORDER BY bukti_barang_peminjaman.id_bukti_barang_peminjaman DESC")->result();

        $data['dataPaket']      = $this->CustomerModel->dataPaket();
        $data['dataKotKab']     = $this->CustomerModel->dataKotKab();
        $data['dataKecamatan']  = $this->CustomerModel->dataKecamatan();
        $data['dataKelurahan']  = $this->CustomerModel->dataKelurahan();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataPeminjamanV2/addBuktiPengembalianBarang', $data);
        $this->load->view('template/footer', $data);
    }

    public function addPengembalianAksi()
    {
        $id                     = $this->input->post('id_bukti_barang_peminjaman');

        $data['dataPeminjaman']   =  $this->db->query("SELECT bukti_barang_peminjaman.id_bukti_barang_peminjaman, bukti_barang_peminjaman.id_pegawai, 
        bukti_barang_peminjaman.foto_peminjaman1, bukti_barang_peminjaman.foto_peminjaman2, 
        bukti_barang_peminjaman.foto_pengembalian1, bukti_barang_peminjaman.foto_pengembalian2, 
        bukti_barang_peminjaman.tanggal_pengembalian, bukti_barang_peminjaman.tanggal_peminjaman, data_pegawai.nama_pegawai

        FROM bukti_barang_peminjaman 
        LEFT JOIN data_pegawai ON bukti_barang_peminjaman.id_pegawai = data_pegawai.id_pegawai
        
        WHERE bukti_barang_peminjaman.id_bukti_barang_peminjaman = '$id'
        
        ORDER BY bukti_barang_peminjaman.id_bukti_barang_peminjaman DESC")->result();

        $photo1                 = $_FILES['photo1']['name'];
        $photo2                 = $_FILES['photo2']['name'];

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
                        'foto_pengembalian1' => $photo1,
                        'foto_pengembalian2' => $photo2,
                  );

        $where = array(
                        'id_bukti_barang_peminjaman'        => $id
                  );

        $this->CustomerModel->updateData('bukti_barang_peminjaman', $data, $where);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>PENGEMBALIAN BARANG DATA BERHASIL</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>');
        redirect('admin/DataPeminjamanV2/DataBuktiPeminjamanBarang');
    }
}
