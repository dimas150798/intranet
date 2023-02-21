<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function index()
    {
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run()==false) {
            $this->load->view('template/headerLogin');
            $this->load->view('formLogin');
            $this->load->view('template/footerLogin');
        } else {
            $username		= $this->input->post('username');
            $password		= $this->input->post('password');

            $cekLogin 		= $this->LoginModel->cekLogin($username, $password);

            if ($cekLogin == null) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Username atau password salah</strong>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>');
                redirect('Welcome');
            } else {
                $cekLogin 		= $this->LoginModel->cekLogin($username, $password);

                $this->session->set_userdata('username', $cekLogin->username);

                if ($cekLogin->id_akses == 1) {
                    redirect('admin/DashboardAdmin');
                } elseif ($cekLogin->id_akses == 2) {
                    redirect('user/DashboardUser');
                }
            }
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();

        redirect('welcome');
    }
}
