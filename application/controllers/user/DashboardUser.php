<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DashboardUser extends CI_Controller
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
        $this->load->view('template/header');
        $this->load->view('template/sidebarUser');
        $this->load->view('user/dashboardUser');
        $this->load->view('template/footer');
    }
}
