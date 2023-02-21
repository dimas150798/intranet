<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Edit_StockRincianModem extends CI_Controller
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
        $data['dataRincian']  =  $this->db->query("SELECT data_stockbarang.id_stockBarang, data_stockbarang.id_barang, data_stockbarang.jumlah_stockBarang, 
        data_stockbarang.jumlah_stockMutasi, data_namabarang.nama_barang, data_stockrincian.jumlah, 
        data_stockrincian.id_stockRincian, data_stockrincian.kode_barang, data_stockrincian.tanggal, data_stockrincian.id_status, 
        data_stockrincian.id_keadaanbarang, data_stockrincian.id_customer

        FROM data_stockbarang
        
        LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
        LEFT JOIN data_stockrincian ON data_stockbarang.id_stockBarang = data_stockrincian.id_stockBarang
        
        WHERE data_stockrincian.id_stockRincian = '$id'")->result_array();

        $data['dataStatus'] = $this->BarangModelV2->dataStatus();
        $data['dataKeadaan'] = $this->BarangModelV2->dataKeadaanBarang();
        $data['dataCustomer'] = $this->BarangModelV2->dataCustomerEditRincian();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataBarangV2/edit_StockRincianModem', $data);
        $this->load->view('template/footer', $data);
    }

    public function editDataAksi()
    {
        $id                = $this->input->post('id_barang');

        $data['barangNama']  =  $this->db->query("SELECT data_namaBarang.id_barang, data_namaBarang.nama_barang, 
        data_namaBarang.id_satuan, data_satuan.id_satuan, data_satuan.nama_satuan, data_peralatan.id_peralatan, data_peralatan.kategori_peralatan
        FROM data_NamaBarang
        INNER JOIN data_satuan ON data_NamaBarang.id_satuan = data_satuan.id_satuan
        INNER JOIN data_peralatan ON data_NamaBarang.id_peralatan = data_peralatan.id_peralatan

        WHERE id_barang  = '$id'")->result();

        $data['dataSatuan'] = $this->BarangModelV2->dataSatuan();
        $data['dataKategori'] = $this->BarangModelV2->dataKategoriPeralatan();

        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebarAdmin', $data);
            $this->load->view('admin/DataBarangV2/edit_StockRincianModem', $data);
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
            redirect('admin/DataBarangV2/Data_StockRincianModem');
        }
    }
}
