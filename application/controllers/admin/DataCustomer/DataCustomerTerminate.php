<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DataCustomerTerminate extends CI_Controller
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
        $data['dataCustomer'] = $this->CustomerModel->dataCustomerTerminate();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataCustomer/dataCustomerTerminate', $data);
        $this->load->view('template/footer', $data);
    }

    public function deleteData($id)
    {
        $where = array('id_customer' => $id);
        $this->CustomerModel->deleteData($where, 'data_customer');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>DELETE DATA BERHASIL</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('admin/DataCustomer/DataCustomerPusat');
    }
}
