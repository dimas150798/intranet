<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MutasiBarangPusat extends CI_Controller
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
        $data['dataSatuan'] = $this->BarangModel->dataSatuan();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataBarang/mutasiBarangPusat', $data);
        $this->load->view('template/footer', $data);
    }

    public function mutasiBarang($id)
    {
        $data['dataBarang']  =  $this->db->query("SELECT id_barang, kode_barang, nama_barang, satuan, tanggal, jumlah
            
            FROM data_barang
            
            WHERE id_barang  = '$id'")->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataBarang/mutasiBarangPusat', $data);
        $this->load->view('template/footer', $data);
    }

    public function mutasiDataAksi()
    {
        $id                     = $this->input->post('id_barang');

        $data['dataBarang']   =  $this->db->query("SELECT id_barang, kode_barang, nama_barang, satuan, tanggal, jumlah, keterangan
            
        FROM data_barang
        
        WHERE id_barang  = '$id'")->result();

        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $id                     = $this->input->post('id_barang');

            $data['dataBarang']   =  $this->db->query("SELECT id_barang, kode_barang, nama_barang, satuan, tanggal, jumlah, keterangan
                
            FROM data_barang
            
            WHERE id_barang  = '$id'")->result();

            $this->load->view('template/header');
            $this->load->view('template/sidebarAdmin');
            $this->load->view('admin/DataBarang/mutasiBarangPusat');
            $this->load->view('template/footer');
        } else {
            $id                 = $this->input->post('id_barang');
            $nama_barang        = $this->input->post('nama_barang');
            $tanggal            = $this->input->post('tanggal');
            $jumlah             = $this->input->post('jumlah');
            $jumlahNow          = $this->input->post('jumlahNow');
            $keterangan         = $this->input->post('keterangan');

            $restock            = $jumlahNow - $jumlah;

            // kode Barang Inisilisasi
            $table         = "data_barang_mutasi";
            $field         = "kode_mutasi";
            $kodeBarang    = $this->BarangModel->getKodeBarang($table, $field);
            $noUrut        = (int) substr($kodeBarang, 4, 4);
            $noUrut++;
            $str           = "MUT";
            $newKode       = $str . sprintf('%04s', $noUrut);

            $dataRestock = array(
                'nama_barang'       => $nama_barang,
                'tanggal'           => $tanggal,
                'jumlah'            => $restock,
            );

            $dataMutasi = array(
                'id_barang'         => $id,
                'kode_mutasi'       => $newKode,
                'tanggal'           => $tanggal,
                'jumlah'            => $jumlah,
                'keterangan'        => $keterangan,
            );

            $where = array(
                'id_barang'        => $id
            );

            if ($jumlah == 0) {
                echo "
                        <script>
                        alert('Stock Barang Kosong');history.go(-1)
                        document.location.href = 'tambahData';            
                        </script>
                        ";
            } else {
                $this->BarangModel->updateData('data_barang', $dataRestock, $where);
                $this->BarangModel->insertData($dataMutasi, 'data_barang_mutasi');
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>MUTASI BARANG BERHASIL</strong>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
                redirect('admin/DataBarang/DataBarangPusat');
            }
        }
    }
}
