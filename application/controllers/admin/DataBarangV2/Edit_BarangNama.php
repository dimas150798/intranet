<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Edit_BarangNama extends CI_Controller
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

    public function editData($id)
    {
        $data['barangNama']  =  $this->db->query("SELECT data_namabarang.id_barang, data_namabarang.nama_barang, 
        data_namabarang.id_satuan, data_satuan.id_satuan, data_satuan.nama_satuan, data_peralatan.id_peralatan, data_peralatan.kategori_peralatan
        
        FROM data_namabarang

        INNER JOIN data_satuan ON data_namabarang.id_satuan = data_satuan.id_satuan
        INNER JOIN data_peralatan ON data_namabarang.id_peralatan = data_peralatan.id_peralatan

        WHERE id_barang  = '$id'")->result();

        $data['dataSatuan'] = $this->BarangModelV2->dataSatuan();
        $data['dataKategori'] = $this->BarangModelV2->dataKategoriPeralatan();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataBarangV2/edit_BarangNama', $data);
        $this->load->view('template/footer', $data);
    }

    public function editDataAksi()
    {
        $id                = $this->input->post('id_barang');

        $data['barangNama']  =  $this->db->query("SELECT data_namabarang.id_barang, data_namabarang.nama_barang, 
        data_namabarang.id_satuan, data_satuan.id_satuan, data_satuan.nama_satuan, data_peralatan.id_peralatan, data_peralatan.kategori_peralatan
        FROM data_namabarang
        INNER JOIN data_satuan ON data_namabarang.id_satuan = data_satuan.id_satuan
        INNER JOIN data_peralatan ON data_namabarang.id_peralatan = data_peralatan.id_peralatan

        WHERE id_barang  = '$id'")->result();

        $data['dataSatuan'] = $this->BarangModelV2->dataSatuan();
        $data['dataKategori'] = $this->BarangModelV2->dataKategoriPeralatan();

        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebarAdmin', $data);
            $this->load->view('admin/DataBarangV2/edit_BarangNama', $data);
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

            $where = array(
                'id_barang'         => $id
            );

            $this->BarangModelV2->updateData('data_namabarang', $data, $where);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>UPDATE DATA BERHASIL</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>');
            redirect('admin/DataBarangV2/Data_BarangNama');
        }
    }
}
