<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AddCustomerTerminate extends CI_Controller
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

    public function addTerminate($id)
    {
        $checkCustomer           = $this->BarangModel->checkCustomer($id);
        $id_status               = 8;

        $dataCustomer = array(
            'id_status'          => $id_status,
        );

        $whereCustomer = array(
            'id_customer'        => $id
        );

        $this->BarangModel->updateData('data_customer', $dataCustomer, $whereCustomer);

        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>TERMINATED DATA BERHASIL</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('admin/DataCustomer/DataCustomerPusat');
    }
}
