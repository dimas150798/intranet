<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AddCustomerPusat extends CI_Controller
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
        $data['dataCustomer'] = $this->CustomerModel->dataCustomer();
        $data['dataPaket'] = $this->CustomerModel->dataPaket();
        $data['dataKotKab'] = $this->CustomerModel->dataKotKab();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataCustomer/addCustomerPusat', $data);
        $this->load->view('template/footer', $data);
    }

    // menampilkan data kecamatan
    public function getKecamatan()
    {
        $id_kota = $this->input->post('id_kota');
        $kecamatan = $this->CustomerModel->ListKecamatan($id_kota);

        if (count($kecamatan) > 0) {
            $pro_select_box = '';
            $pro_select_box .= '<option value="" disabled selected>Pilih Kecamatan</option>';

            foreach ($kecamatan as $dataKecamatan) {
                $pro_select_box .= '<option value="'.$dataKecamatan->id_kecamatan.'">'.$dataKecamatan->nama_kecamatan.'</option>';
            }
            echo json_encode($pro_select_box);
        }
    }

    // menampilkan data kelurahan
    public function getKelurahan()
    {
        $id_kecamatan = $this->input->post('id_kecamatan');
        $kelurahan = $this->CustomerModel->ListKelurahan($id_kecamatan);

        if (count($kelurahan) > 0) {
            $pro_select_box = '';
            $pro_select_box .= '<option value="" disabled selected>Pilih Kelurahan</option>';

            foreach ($kelurahan as $dataKelurahan) {
                $pro_select_box .= '<option value="'.$dataKelurahan->id_kelurahan.'">'.$dataKelurahan->nama_kelurahan.'</option>';
            }
            echo json_encode($pro_select_box);
        }
    }

    public function addData()
    {
        $data['dataCustomer'] = $this->CustomerModel->dataCustomer();
        $data['dataPaket'] = $this->CustomerModel->dataPaket();
        $data['dataKotKab'] = $this->CustomerModel->dataKotKab();

        $this->form_validation->set_rules('nama_customer', 'Nama Customer', 'required');
        $this->form_validation->set_rules('nik_customer', 'NIK Customer', 'required');
        $this->form_validation->set_rules('tlp_customer', 'Telepon Customer', 'required');
        $this->form_validation->set_rules('alamat_customer', 'Alamat Customer', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebarAdmin', $data);
            $this->load->view('admin/DataCustomer/addCustomerPusat', $data);
            $this->load->view('template/footer', $data);
        } else {
            $nama_customer          = $this->input->post('nama_customer');
            $pembelian_paket        = $this->input->post('pembelian_paket');
            $nik_customer           = $this->input->post('nik_customer');
            $alamat_customer        = $this->input->post('alamat_customer');
            $tlp_customer           = $this->input->post('tlp_customer');
            $kota                   = $this->input->post('kota');
            $kecamatan              = $this->input->post('kecamatan');
            $kelurahan              = $this->input->post('kelurahan');
            $tanggal                = $this->input->post('tanggal');

            $data = array(
                        'pembelian_paket'    => $pembelian_paket,
                        'nama_customer'      => $nama_customer,
                        'nik_customer'       => $nik_customer,
                        'alamat_customer'    => $alamat_customer,
                        'date'               => $tanggal,
                        'id_kota'            => $kota,
                        'id_kecamatan'       => $kecamatan,
                        'id_kelurahan'       => $kelurahan,
                        'tlp_customer'       => $tlp_customer,
                  );

            $checkDuplicateCustomer = $this->CustomerModel->checkDuplicateCustomer($nama_customer, $nik_customer);

            if ($checkDuplicateCustomer->nama_customer || $nama_customer && $checkDuplicateCustomer->nik_customer == $nik_customer) {
                echo "
                        <script>
                        alert('Customer Sudah Terdaftar');history.go(-1)
                        // document.location.href = 'tambahData';            
                        </script>
                        ";
            } else {
                $this->CustomerModel->insertData($data, 'data_customer');
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>TAMBAH DATA BERHASIL</strong>
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>');
                redirect('admin/DataCustomer/DataCustomerPusat');
            }
        }
    }
}
