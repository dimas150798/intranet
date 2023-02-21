<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AddPeminjamanBarang extends CI_Controller
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
        $data['dataPegawai'] = $this->PegawaiModel->dataPegawai();
        $data['dataBarang'] = $this->BarangModel->dataBarangPusat();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataPeminjaman/addPeminjamanBarang', $data);
        $this->load->view('template/footer', $data);
    }

    public function addData()
    {
        $data['dataPegawai'] = $this->PegawaiModel->dataPegawai();
        $data['dataBarang'] = $this->BarangModel->dataBarangPusat();
        $data['dataSatuan'] = $this->BarangModel->dataSatuan();

        $this->form_validation->set_rules('keterangan', 'keterangan', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebarAdmin', $data);
            $this->load->view('admin/DataPeminjaman/addPeminjamanBarang', $data);
            $this->load->view('template/footer', $data);
        } else {
            // kode Barang Inisilisasi
            $table         = "data_peminjaman_barang";
            $field         = "kode_peminjaman_barang";
            $kodeBarang    = $this->BarangModel->getKodeBarang($table, $field);
            $noUrut        = (int) substr($kodeBarang, 4, 4);
            $noUrut++;
            $str           = "PEB";
            $newKode       = $str . sprintf('%04s', $noUrut);

            $id_barang              = $this->input->post('barang');
            $id_pegawai             = $this->input->post('pegawai');
            $kode_peminjaman_barang = $newKode;
            $tanggal                = $this->input->post('tanggal');
            $jumlah                 = $this->input->post('jumlah');
            $id_status              = 1;
            $keterangan             = $this->input->post('keterangan');

            $data = array(
                'id_barang'                 => $id_barang,
                'id_pegawai'                => $id_pegawai,
                'kode_peminjaman_barang'    => $kode_peminjaman_barang,
                'tanggal'                   => $tanggal,
                'jumlah'                    => $jumlah,
                'id_status'                 => $id_status,
                'keterangan'                => $keterangan,
            );

            $checkBarang = $this->BarangModel->checkStockBarangPusat($id_barang);
            $stock = $checkBarang->jumlah;
            $restock = $stock - $jumlah;

            if ($jumlah == 0) {
                echo "
                    <script>
                    alert('Masukkan Jumlah Terlebih Dahulu !');history.go(-1)
                    document.location.href = 'tambahData';            
                    </script>
                    ";
            } elseif ($jumlah > $checkBarang->jumlah) {
                echo "
                    <script>
                    alert('Stock Barang Tidak Mencukupi');history.go(-1)
                    document.location.href = 'tambahData';            
                    </script>
                    ";
            } else {
                $dataRestock = array(
                    'jumlah'            => $restock,
                );

                $where = array(
                    'id_barang'        => $id_barang
                );

                $this->BarangModel->updateData('data_barang', $dataRestock, $where);
                $this->BarangModel->insertData($data, 'data_peminjaman_barang');
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>PEMINJAMAN BARANG BERHASIL</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>');
                redirect('admin/DataPeminjaman/DataPeminjamanBarang');
            }
        }
    }
}
