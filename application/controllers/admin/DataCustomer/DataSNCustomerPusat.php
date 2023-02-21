<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DataSNCustomerPusat extends CI_Controller
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
        $data['dataCustomerSN'] = $this->CustomerModel->dataCustomerSN();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataCustomer/dataSNCustomerPusat', $data);
        $this->load->view('template/footer', $data);
    }

    public function customerSN($id)
    {
        $data['dataCustomerSN']  =  $this->db->query("SELECT data_barang_mutasi.id_barang_mutasi, data_barang_mutasi.id_barang, 
        data_barang_mutasi.SN, data_barang_mutasi.id_customer, data_barang_mutasi.kode_mutasi, data_barang_mutasi.tanggal, 
        data_barang_mutasi.jumlah, data_barang_mutasi.keterangan, data_customer.nama_customer, data_barang.nama_barang

        FROM data_barang_mutasi 
        LEFT JOIN data_customer ON data_barang_mutasi.id_customer = data_customer.id_customer
        LEFT JOIN data_barang ON data_barang_mutasi.id_barang = data_barang.id_barang
        
        WHERE data_barang_mutasi.id_customer = $id")->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataCustomer/dataSNCustomerPusat', $data);
        $this->load->view('template/footer', $data);
    }

    public function editData($id)
    {
        $data['dataMutasi']  =  $this->db->query("SELECT data_barang_mutasi.id_barang_mutasi, 
        data_barang_mutasi.id_barang, data_barang_mutasi.SN, 
        data_barang_mutasi.id_customer, data_barang_mutasi.kode_mutasi, data_barang_mutasi.tanggal, 
        data_barang_mutasi.jumlah, data_barang_mutasi.keterangan, data_barang.nama_barang, data_customer.nama_customer

        FROM data_barang_mutasi 
        INNER JOIN data_barang ON data_barang_mutasi.id_barang = data_barang.id_barang
        INNER JOIN data_customer ON data_barang_mutasi.id_customer = data_customer.id_customer
        
        WHERE id_barang_mutasi = '$id'")->result_array();

        $data['dataBarang'] = $this->BarangModel->dataBarangModemPusat();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataCustomer/editSNCustomerPusat', $data);
        $this->load->view('template/footer', $data);
    }

    public function editDataAksi()
    {
        $id                     = $this->input->post('id_barang_mutasi');

        $data['dataMutasi']  =  $this->db->query("SELECT data_barang_mutasi.id_barang_mutasi, 
        data_barang_mutasi.id_barang, data_barang_mutasi.SN, 
        data_barang_mutasi.id_customer, data_barang_mutasi.kode_mutasi, data_barang_mutasi.tanggal, 
        data_barang_mutasi.jumlah, data_barang_mutasi.keterangan, data_barang.nama_barang, data_customer.nama_customer

        FROM data_barang_mutasi 
        INNER JOIN data_barang ON data_barang_mutasi.id_barang = data_barang.id_barang
        INNER JOIN data_customer ON data_barang_mutasi.id_customer = data_customer.id_customer
        
        WHERE id_barang_mutasi = '$id'")->result();

        $this->form_validation->set_rules('SN', 'SN', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebarAdmin', $data);
            $this->load->view('admin/DataCustomer/editSNCustomerPusat', $data);
            $this->load->view('template/footer', $data);
        } else {
            $SN                 = $this->input->post('SN');
            $barang             = $this->input->post('barang');
            $nama_barang        = $this->input->post('nama_barang');
            $SN_old             = $this->input->post('SN_old');
            $id_customer        = $this->input->post('id_customer');
            $tanggal            = $this->input->post('tanggal');

            $checkBarang        = $this->BarangModel->checkStockBarangPusat($barang);

            $idBarang           = $checkBarang->id_barang;
            $stockBarangGudang  = $checkBarang->jumlah;
            $mutasiBarang       = $stockBarangGudang - 1;

            // kode Barang Inisilisasi
            $table         = "data_barang_mutasi";
            $field         = "kode_mutasi";
            $kodeBarang    = $this->BarangModel->getKodeBarang($table, $field);
            $noUrut        = (int) substr($kodeBarang, 4, 4);
            $noUrut++;
            $str           = "MUT";
            $newKode       = $str . sprintf('%04s', $noUrut);

            $dataMutasi = array(
                'id_barang'         => $idBarang,
                'SN'                => $SN,
                'id_customer'       => $id_customer,
                'kode_mutasi'       => $newKode,
                'tanggal'           => $tanggal,
                'jumlah'            => 1,
                'keterangan'        => "Replace",
            );

            $dataEditMutasi = array(
                'id_barang'         => $barang,
                'SN'                => $SN,
            );

            $dataBarang = array(
                'jumlah'            => $mutasiBarang,
            );

            $barangRusak = array(
                'nama_barang'       => $nama_barang,
                'jumlah'            => 1,
                'SN'                => $SN_old,
            );

            $whereBarang = array(
                'id_barang'         => $idBarang
            );

            $whereEditMutasi = array(
                'id_barang_mutasi'  => $id
            );

            $this->CustomerModel->insertData($barangRusak, 'data_barang_rusak');
            $this->CustomerModel->insertData($dataMutasi, 'data_barang_mutasi');
            $this->CustomerModel->updateData('data_barang', $dataBarang, $whereBarang);
            $this->CustomerModel->updateData('data_barang_mutasi', $dataEditMutasi, $whereEditMutasi);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>UPDATE DATA BERHASIL</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>');
            redirect('admin/DataCustomer/DataSNCustomerPusat');
        }
    }

    public function deleteData($id)
    {
        $checkStockBarang   = $this->BarangModel->checkSNCustomer($id);
        $SN                 = $checkStockBarang->SN;
        $id_barang          = $checkStockBarang->id_barang;
        $jumlahBarang       = $checkStockBarang->jumlahBarang;
        $restockBarang      = $jumlahBarang + 1;

        $dataBarang = array(
            'jumlah'       => $restockBarang,
         );

        $where = array('id_barang_mutasi' => $id);
        $whereBarang = array('id_barang' => $id_barang);

        $this->BarangModel->deleteData($where, 'data_barang_mutasi');
        $this->BarangModel->updateData('data_barang', $dataBarang, $whereBarang);

        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>DELETE DATA BERHASIL</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('admin/DataCustomer/DataSNCustomerPusat');
    }
}
