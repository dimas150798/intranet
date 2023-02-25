<?php

class AddPurchaseRequestMore extends CI_Controller
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
        $data['dataBarang'] = $this->BarangModelV2->data_NamaBarang();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataPurchase/addPurchaseRequestMore', $data);
        $this->load->view('template/footer', $data);
    }

    public function addDataMore()
    {
        $data['dataBarang'] = $this->BarangModelV2->data_NamaBarang();

        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebarAdmin', $data);
            $this->load->view('admin/DataPurchase/addPurchaseRequestMore', $data);
            $this->load->view('template/footer', $data);
        } else {
            $no_purchase_order      = $this->input->post('no_purchase_order');
            $no_purchase_request    = $this->input->post('no_purchase_request');
            $id_pegawai             = $this->input->post('id_pegawai');
            $id_barang              = $this->input->post('barang');
            $tanggal                = $this->input->post('tanggal');
            $jumlah                 = $this->input->post('jumlah');
            $keterangan             = $this->input->post('keterangan');

            $dataRequest = array(
                'no_purchase_request'       => $no_purchase_request,
                'jumlah_request'            => $jumlah,
                'tanggal'                   => $tanggal,
                'keterangan'                => $keterangan,
                'id_status'                 => 3,
                'id_barang'                 => $id_barang,
                'id_pegawai'                => $id_pegawai,
            );

            $dataOrder = array(
                'no_purchase_order'         => $no_purchase_order,
                'no_purchase_request'       => $no_purchase_request,
                'jumlah_order'              => $jumlah,
                'tanggal'                   => $tanggal,
                'keterangan'                => $keterangan,
                'id_status'                 => 3,
                'id_pegawai_order'          => $id_pegawai,
                'id_barang'                 => $id_barang,
            );

            $this->PurchasingModel->insertData($dataRequest, 'data_purchase_request');
            $this->PurchasingModel->insertData($dataOrder, 'data_purchase_order');

            // Show request data terakhir
            $checkRequest =  $this->PurchasingModel->checkPurchaseRequest($no_purchase_request);

            $noPurchaseRequest = $checkRequest->no_purchase_request;
            $this->session->set_userdata('no_purchase_request', $noPurchaseRequest);

            $noPurchaseOrder = $checkRequest->no_purchase_order;
            $this->session->set_userdata('no_purchase_order', $noPurchaseOrder);

            $idPegawai = $checkRequest->id_pegawai;
            $this->session->set_userdata('id_pegawai', $idPegawai);

            $namaPurchaseRequest = $checkRequest->nama_pegawai;
            $this->session->set_userdata('nama_pegawai', $namaPurchaseRequest);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>REQUEST BERHASIL</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');

            redirect('admin/DataPurchase/AddPurchaseRequestMore');
        }
    }
}
