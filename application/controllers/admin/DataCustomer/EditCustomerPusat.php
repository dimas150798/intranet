<?php

defined('BASEPATH') or exit('No direct script access allowed');

class EditCustomerPusat extends CI_Controller
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
        $this->load->view('admin/DataCustomer/editCustomerPusat', $data);
        $this->load->view('template/footer', $data);
    }

    public function editData($id)
    {
        $data['dataCustomer']  =  $this->db->query("SELECT data_customer.id_customer,data_customer.pembelian_paket,data_customer.nama_customer,       
            data_customer.nik_customer,data_customer.alamat_customer,data_customer.tlp_customer, data_customer.id_kota, data_customer.id_kecamatan, data_customer.id_kelurahan,
            data_kota.id_kota, data_kota.nama_kota, data_kecamatan.id_kecamatan, data_kecamatan.nama_kecamatan, data_kelurahan.id_kelurahan, data_kelurahan.nama_kelurahan
            
            FROM data_customer
            LEFT JOIN data_kota ON data_customer.id_kota = data_kota.id_kota
            LEFT JOIN data_kecamatan ON data_customer.id_kecamatan = data_kecamatan.id_kecamatan
            LEFT JOIN data_kelurahan ON data_customer.id_kelurahan = data_kelurahan.id_kelurahan
            
            WHERE data_customer.id_customer  = '$id'")->result();

        $data['dataPaket']      = $this->CustomerModel->dataPaket();
        $data['dataKotKab']     = $this->CustomerModel->dataKotKab();
        $data['dataKecamatan']  = $this->CustomerModel->dataKecamatan();
        $data['dataKelurahan']  = $this->CustomerModel->dataKelurahan();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataCustomer/editCustomerPusat', $data);
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

    public function editDataAksi()
    {
        $id                     = $this->input->post('id_customer');

        $data['dataCustomer']   =  $this->db->query("SELECT data_customer.id_customer,data_customer.pembelian_paket,data_customer.nama_customer,       
            data_customer.nik_customer,data_customer.alamat_customer,data_customer.tlp_customer,data_customer.id_kota, data_customer.id_kecamatan, data_customer.id_kelurahan,
            data_kota.id_kota, data_kota.nama_kota, data_kecamatan.id_kecamatan, data_kecamatan.nama_kecamatan, data_kelurahan.id_kelurahan, data_kelurahan.nama_kelurahan
            
            FROM data_customer
            LEFT JOIN data_kota ON data_customer.id_kota = data_kota.id_kota
            LEFT JOIN data_kecamatan ON data_customer.id_kecamatan = data_kecamatan.id_kecamatan
            LEFT JOIN data_kelurahan ON data_customer.id_kelurahan = data_kelurahan.id_kelurahan
            
            WHERE data_customer.id_customer  = '$id'")->result();

        $data['dataPaket']      = $this->CustomerModel->dataPaket();
        $data['dataKotKab']     = $this->CustomerModel->dataKotKab();
        $data['dataKecamatan']  = $this->CustomerModel->dataKecamatan();
        $data['dataKelurahan']  = $this->CustomerModel->dataKelurahan();

        $this->form_validation->set_rules('nama_customer', 'Nama Customer', 'required');
        $this->form_validation->set_rules('nik_customer', 'NIK Customer', 'required');
        $this->form_validation->set_rules('tlp_customer', 'No Telpon', 'required');
        $this->form_validation->set_rules('alamat_customer', 'Alamat Customer', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header');
            $this->load->view('template/sidebarAdmin');
            $this->load->view('admin/DataCustomer/editCustomerPusat');
            $this->load->view('template/footer');
        } else {
            $pembelian_paket        = $this->input->post('pembelian_paket');
            $nama_customer          = $this->input->post('nama_customer');
            $nik_customer           = $this->input->post('nik_customer');
            $alamat_customer        = $this->input->post('alamat_customer');
            $kota                   = $this->input->post('kota');
            $kecamatan              = $this->input->post('kecamatan');
            $kelurahan              = $this->input->post('kelurahan');
            $tlp_customer           = $this->input->post('tlp_customer');

            $data = array(
                        'pembelian_paket'    => $pembelian_paket,
                        'nama_customer'      => $nama_customer,
                        'nik_customer'       => $nik_customer,
                        'alamat_customer'    => $alamat_customer,
                        'id_kota'            => $kota,
                        'id_kecamatan'       => $kecamatan,
                        'id_kelurahan'       => $kelurahan,
                        'tlp_customer'       => $tlp_customer,
                  );

            $where = array(
                        'id_customer'        => $id
                  );

            $this->CustomerModel->updateData('data_customer', $data, $where);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>UPDATE DATA BERHASIL</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>');
            redirect('admin/DataCustomer/DataCustomerPusat');
        }
    }
}
