<?php

defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
ini_set('display_errors', 0);

class Add_StockKeluarPelanggan extends CI_Controller
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

    public function addStockKeluar($id)
    {
        $data['barangNama']  =  $this->db->query("SELECT COUNT(data_stockrincian.id_stockRincian) AS jumlahDetailBarang, data_stockbarang.id_stockBarang, data_stockbarang.id_barang, 
        data_stockbarang.jumlah_stockBarang, data_namabarang.nama_barang, data_namabarang.id_peralatan, data_stockrincian.jumlah

        FROM data_stockbarang
        
        LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
        LEFT JOIN data_stockrincian ON data_stockbarang.id_stockBarang = data_stockrincian.id_stockBarang
        
        WHERE data_stockbarang.id_barang = '$id'

        GROUP BY data_stockbarang.id_stockBarang

        ")->result();

        $checkNama= $this->BarangModelV2->checkNamaBarang($id);

        $namaBarang = $checkNama->nama_barang;

        if ($namaBarang == "kabel") {
            echo "
            <script>
            alert('Tidak Perlu Input Detail Barang');history.go(-1)
            document.location.href = 'tambahData';            
            </script>
            ";
        } else {
            $data['dataPegawai'] = $this->BarangModelV2->dataPegawai();
            $data['dataStatus'] = $this->BarangModelV2->dataStatus();

            $this->load->view('template/header', $data);
            $this->load->view('template/sidebarAdmin', $data);
            $this->load->view('admin/DataBarangV2/add_StockKeluarPelanggan', $data);
            $this->load->view('template/footer', $data);
        }
    }

    // data keluar ATK
    public function addStockKeluarPelanggan()
    {
        $data['dataSatuan'] = $this->BarangModelV2->dataSatuan();

        $this->form_validation->set_rules('jumlah', 'Jumlah Barang', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebarAdmin', $data);
            $this->load->view('admin/DataBarangV2/add_StockKeluarPelanggan', $data);
            $this->load->view('template/footer', $data);
        } else {
            $id_stockBarang         = $this->input->post('id_stockBarang');
            $jumlah                 = $this->input->post('jumlah');
            $jumlahNow              = $this->input->post('jumlahNow');
            $jumlahMutasi           = $this->input->post('jumlahMutasi');
            $tanggal                = $this->input->post('tanggal');
            $id_pegawai             = $this->input->post('pegawai');
            $keterangan             = $this->input->post('keterangan');
            $kode_barang            = $this->input->post('kode_barang');
            $id_status              = 13;

            // Stock Gudang
            $stockGudang            = $jumlahNow - $jumlah;
            // Stock Mutasi Stock Gudang
            $stockMutasi            = $jumlahMutasi + $jumlah;

            $dataStockKeluar = array(
                'id_stockBarang'    => $id_stockBarang,
                'kode_barang'       => $kode_barang,
                'jumlah'            => $jumlah,
                'tanggal'           => $tanggal,
                'id_pegawai'        => $id_pegawai,
                'id_status'         => $id_status,
                'keterangan'        => $keterangan,
                'non_modem'         => "Yes"
            );

            $dataStockGudang = array(
                'jumlah_stockBarang'    => $stockGudang,
                'jumlah_stockMutasi'    => $stockMutasi,
                'tanggal_mutasi'        => $tanggal
            );

            $where = array(
                'id_stockBarang'       => $id_stockBarang
            );

            if ($id_pegawai == null && $tanggal == null) {
                echo "
                <script>
                alert('Terdapat Data Yang Belum Terisi');history.go(-1)
                document.location.href = 'tambahData';            
                </script>
                ";
            } else {
                $this->BarangModelV2->updateData('data_stockbarang', $dataStockGudang, $where);
                $this->BarangModelV2->insertData($dataStockKeluar, 'data_stockkeluar');
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>STOCK BARANG BERHASIL DIKURANGIN</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>');
                redirect('admin/DataBarangV2/Data_StockBarangPelanggan');
            }
        }
    }
}
