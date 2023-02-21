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
        $data['dataBarang'] = $this->BarangModel->dataBarangPusat();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/Purchasing/addPurchaseRequestMore', $data);
        $this->load->view('template/footer', $data);
    }

    public function addDataMore()
    {
        $data['dataBarang'] = $this->BarangModel->dataBarangPusat();
        $data['dataPegawai'] = $this->PegawaiModel->dataPegawai();

        $this->form_validation->set_rules('quantinty', 'Quantinty', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebarAdmin', $data);
            $this->load->view('admin/Purchasing/addPurchaseRequest', $data);
            $this->load->view('template/footer', $data);
        } else {
            $no_purchase_order      = $this->input->post('no_purchase_order');
            $no_purchase_request    = $this->input->post('no_purchase_request');
            $id_barang              = $this->input->post('barang');
            $id_pegawai             = $this->input->post('id_pegawai');
            $quantinty              = $this->input->post('quantinty');
            $tanggal                = $this->input->post('tanggal');
            $keterangan             = $this->input->post('keterangan');

            $dataRequest = array(
                'no_purchase_request'       => $no_purchase_request,
                'id_pegawai'                => $id_pegawai,
                'id_barang'                 => $id_barang,
                'quantinty'                 => $quantinty,
                'tanggal'                   => $tanggal,
                'keterangan'                => $keterangan,
                'id_status'                 => 3,
            );

            $dataOrder = array(
                'no_purchase_request'       => $no_purchase_request,
                'id_barang'                 => $id_barang,
                'no_purchase_order'         => $no_purchase_order,
                'quantinty'                 => $quantinty,
                'id_pegawai'                => $id_pegawai,
                'tanggal'                   => $tanggal,
                'id_status'                 => 3,
            );

            $this->PurchasingModel->insertData($dataRequest, 'data_purchase_request');
            $this->PurchasingModel->insertData($dataOrder, 'data_purchase_order');

            // Show request data terakhir
            $checkRequest =  $this->PurchasingModel->checkPurchaseRequest($no_purchase_request);

            $noPurchaseRequest = $checkRequest->no_purchase_request;
            $this->session->set_userdata('no_purchase_request', $noPurchaseRequest);

            $idPegawai = $checkRequest->id_pegawai;
            $this->session->set_userdata('id_pegawai', $idPegawai);

            $namaPurchaseRequest = $checkRequest->nama_pegawai;
            $this->session->set_userdata('nama_pegawai', $namaPurchaseRequest);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>REQUEST BERHASIL</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');

            redirect('admin/Purchasing/AddPurchaseRequestMore');
        }
    }
}
