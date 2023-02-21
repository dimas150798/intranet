<?php

defined('BASEPATH') or exit('No direct script access allowed');

class EditPegawai extends CI_Controller
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
        $this->load->view('admin/DataPegawai/editPegawai', $data);
        $this->load->view('template/footer', $data);
    }

    public function editData($id)
    {
        $data['dataPegawai']  =  $this->db->query("SELECT id_pegawai, NIK, nama_pegawai, no_telpon,
            alamat_pegawai, pendidikan_pegawai, jabatan, tanggal_masuk, gaji, photo
            
            FROM data_pegawai
            WHERE id_pegawai  = '$id'")->result();

        $data['dataPendidikan'] = $this->PegawaiModel->dataPendidikanPegawai();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataPegawai/editPegawai', $data);
        $this->load->view('template/footer', $data);
    }

    public function editDataAksi()
    {
        $id                = $this->input->post('id_pegawai');

        $data['dataPegawai']  =  $this->db->query("SELECT id_pegawai, NIK, nama_pegawai, no_telpon,
            alamat_pegawai, pendidikan_pegawai, jabatan, tanggal_masuk, gaji, photo
            
            FROM data_pegawai
            WHERE id_pegawai  = '$id'")->result();

        $data['dataPendidikan'] = $this->PegawaiModel->dataPendidikanPegawai();

        $this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('NIK', 'NIK', 'required');
        $this->form_validation->set_rules('no_telpon', 'No Telpon', 'required');
        $this->form_validation->set_rules('alamat_pegawai', 'Alamat Pegawai', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
        $this->form_validation->set_rules('gaji', 'Gaji', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header');
            $this->load->view('template/sidebarAdmin');
            $this->load->view('admin/DataPegawai/editPegawai');
            $this->load->view('template/footer');
        } else {
            $nama_pegawai           = $this->input->post('nama_pegawai');
            $NIK                    = $this->input->post('NIK');
            $no_telpon              = $this->input->post('no_telpon');
            $alamat_pegawai         = $this->input->post('alamat_pegawai');
            $pendidikan_pegawai     = $this->input->post('pendidikan_pegawai');
            $jabatan                = $this->input->post('jabatan');
            $tanggal_masuk          = $this->input->post('tanggal_masuk');
            $gaji                   = $this->input->post('gaji');

            $data = array(
                        'NIK'                => $NIK,
                        'nama_pegawai'       => $nama_pegawai,
                        'no_telpon'          => $no_telpon,
                        'alamat_pegawai'     => $alamat_pegawai,
                        'pendidikan_pegawai' => $pendidikan_pegawai,
                        'jabatan'            => $jabatan,
                        'tanggal_masuk'      => $tanggal_masuk,
                        'gaji'               => $gaji,
                  );

            $where = array(
                        'id_pegawai'              => $id
                  );

            $this->PegawaiModel->updateData('data_pegawai', $data, $where);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>UPDATE DATA BERHASIL</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>');
            redirect('admin/DataPegawai/DataPegawai');
        }
    }
}
