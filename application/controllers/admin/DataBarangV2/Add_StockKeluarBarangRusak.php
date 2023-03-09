<?php

defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
ini_set('display_errors', 0);

class Add_StockKeluarBarangRusak extends CI_Controller
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
        $data['barangNama']  =  $this->db->query("SELECT data_stockbarang.id_stockBarang, data_stockbarang.id_barang, data_stockbarang.jumlah_stockBarang, 
        data_stockbarang.jumlah_stockMutasi, data_stockbarang.jumlah_stockRusak, data_namabarang.nama_barang, data_stockrincian.jumlah

        FROM data_stockbarang
        
        LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
        LEFT JOIN data_stockrincian ON data_stockbarang.id_stockBarang = data_stockrincian.id_stockBarang
        
        WHERE data_stockbarang.id_barang = '$id'

        GROUP BY data_stockbarang.id_stockBarang

        ")->result();

        $data['dataPegawai'] = $this->BarangModelV2->dataPegawai();
        $data['dataStatus'] = $this->BarangModelV2->dataStatus();
        $data['dataSN'] = $this->BarangModelV2->dataSNBarangRusak($id);
        $data['dataCustomer'] = $this->BarangModelV2->dataCustomer();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/DataBarangV2/add_StockKeluarBarangRusak', $data);
        $this->load->view('template/footer', $data);
    }

    // data keluar ATK
    public function addStockKeluarBarang()
    {
        $kode_barang            = $this->input->post('kodeBarang');
        $id_stockBarang         = $this->input->post('id_stockBarang');
        $jumlah                 = $this->input->post('jumlah');
        $tanggal                = $this->input->post('tanggal');
        $id_status              = 12;
        $id_pegawai             = $this->input->post('pegawai');
        $id_keadaanbarang       = 1;

        $id_barang              = $this->input->post('id_barang');
        $nama_barang            = $this->input->post('nama_barang');
        $jumlahNow              = $this->input->post('jumlahNow');
        $jumlahMutasi           = $this->input->post('jumlahMutasi');
        $jumlahRusak            = $this->input->post('jumlahRusak');

        // Stock Gudang
        $stockGudang            = $jumlahNow - $jumlah;
        // Stock Mutasi Stock Gudang
        $stockMutasi            = $jumlahMutasi + $jumlah;
        // Stock Barang Rusak
        $stockRusak             = $jumlahRusak + $jumlah;

        $dataStockRincian = array(
                'kode_barang'       => $kode_barang,
                'id_stockBarang'    => $id_stockBarang,
                'jumlah'            => $jumlah,
                'tanggal'           => $tanggal,
                'id_status'         => $id_status,
                'id_pegawai'        => $id_pegawai,
                'id_keadaanbarang'  => $id_keadaanbarang
            );

        $dataStockBarang = array(
                'jumlah_stockBarang'    => $stockGudang,
                'jumlah_stockRusak'     => $stockRusak,
            );

        $whereStockBarang = array(
                'id_barang'           => $id_barang
            );

        $whereStockAktivasi = array(
                'kode_barang'   => $kode_barang
            );

        if ($kode_barang == null) {
            if ($nama_barang == "Adaptor 1.5A" or $nama_barang == "Adaptor 1A" or $nama_barang == "Adaptor 2A"
            or $nama_barang == "Patch Core Hitam UPC Outdor" or $nama_barang == "Patch Core Kuning APC (Hijau)"
            or $nama_barang == "Patch Core Kuning UPC (Biru)") {
                $this->BarangModelV2->updateData('data_stockbarang', $dataStockBarang, $whereStockBarang);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>STOCK BARANG BERHASIL DIKURANGIN</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>');
                redirect('admin/DataBarangV2/Data_StockBarangModem');
            } else {
                echo "
                    <script>
                    alert('Check Kembali Nama Barang, SN atau Jumlah');history.go(-1)
                    document.location.href = 'tambahData';            
                    </script>
                    ";
            }
        } else {
            if ($kode_barang == null & $tanggal == null & $id_pegawai == null) {
                echo "
                    <script>
                    alert('Terdapat Data Yang Belum Terisi');history.go(-1)
                    document.location.href = 'tambahData';            
                    </script>
                    ";
            } else {
                if ($jumlah <= 1) {
                    $this->BarangModelV2->updateData('data_stockbarang', $dataStockBarang, $whereStockBarang);
                    $this->BarangModelV2->insertData($dataStockRincian, 'data_stockrincian');
                    $this->BarangModelV2->deleteData($whereStockAktivasi, 'data_aktivasi');

                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>STOCK BARANG BERHASIL DIKURANGIN</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>');
                    redirect('admin/DataBarangV2/Data_StockBarangModem');
                } else {
                    echo "
                    <script>
                    alert('Jumlah Maksimal 1');history.go(-1)
                    document.location.href = 'tambahData';            
                    </script>
                    ";
                }
            }
        }
    }
}
