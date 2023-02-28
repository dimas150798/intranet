<?php

defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
ini_set('display_errors', 0);

class Add_StockKeluarNonModem extends CI_Controller
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
        data_stockbarang.jumlah_stockMutasi, data_namabarang.nama_barang, data_stockrincian.jumlah

        FROM data_stockbarang
        
        LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
        LEFT JOIN data_stockrincian ON data_stockbarang.id_stockBarang = data_stockrincian.id_stockBarang
        
        WHERE data_stockbarang.id_barang = '$id'

        GROUP BY data_stockbarang.id_stockBarang

        ")->result();

        $checkNama= $this->BarangModelV2->checkNamaBarang($id);

        $namaBarang = $checkNama->nama_barang;

        if ($namaBarang == "Patch Core Hitam UPC Outdor" or $namaBarang == "Patch Core Kuning APC (Hijau)" or $namaBarang == "Patch Core Kuning UPC (Biru)"
        or $namaBarang == "Adaptor 1A" or $namaBarang == "Adaptor 1.5A" or $namaBarang == "Adaptor 2A") {
            $data['dataPegawai'] = $this->BarangModelV2->dataPegawai();
            $data['dataStatus'] = $this->BarangModelV2->dataStatus();
            $data['dataSN'] = $this->BarangModelV2->dataSNNonModem();
            $data['dataCustomer'] = $this->BarangModelV2->dataCustomer();

            $this->load->view('template/header', $data);
            $this->load->view('template/sidebarAdmin', $data);
            $this->load->view('admin/DataBarangV2/add_StockKeluarNonModem', $data);
            $this->load->view('template/footer', $data);
        } else {
            echo "
                <script>
                alert('Salah Input Data');history.go(-1)
                document.location.href = 'tambahData';            
                </script>
                ";
        }
    }

    // data keluar ATK
    public function addStockKeluarModem()
    {
        $data['dataSatuan'] = $this->BarangModelV2->dataSatuan();

        $this->form_validation->set_rules('jumlah', 'Jumlah Barang', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebarAdmin', $data);
            $this->load->view('admin/DataBarangV2/add_StockKeluarNonModem', $data);
            $this->load->view('template/footer', $data);
        } else {
            $id_stockBarang         = $this->input->post('id_stockBarang');
            $jumlah                 = $this->input->post('jumlah');
            $jumlahNow              = $this->input->post('jumlahNow');
            $jumlahMutasi           = $this->input->post('jumlahMutasi');
            $jumlahKeluar           = $this->input->post('jumlahKeluar');
            $tanggal                = $this->input->post('tanggal');
            $id_pegawai             = $this->input->post('pegawai');
            $keterangan             = $this->input->post('keterangan');
            $id_barang              = $this->input->post('id_barang');
            $kode_barang            = $this->input->post('kodeBarang');
            $id_customer            = $this->input->post('dataCustomer');
            $nama_barang            = $this->input->post('nama_barang');
            $id_status              = 1;
            $id_status13            = 13;

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
                'id_status'         => 13,
                'keterangan'        => $keterangan,
                'non_modem'         => "Yes"
            );

            $dataPatch_Core_Kuning_APC_Hijau = array(
                'Patch_Core_Kuning_APC_Hijau'   => $jumlah,
                'id_status'                     => $id_status13
            );

            $dataPatch_Core_Kuning_UPC_Biru = array(
                'Patch_Core_Kuning_UPC_Biru'    => $jumlah,
                'id_status'                     => $id_status13
            );

            $dataPatch_Core_Hitam_UPC_Outdor = array(
                'Patch_Core_Hitam_UPC_Outdor'   => $jumlah,
                'id_status'                     => $id_status13
            );

            $dataAdaptor = array(
                'Adaptor'       => $nama_barang,
                'id_status'     => $id_status13
            );

            $dataStockGudang = array(
                'jumlah_stockBarang'    => $stockGudang,
                'jumlah_stockMutasi'    => $stockMutasi,
                'tanggal_mutasi'        => $tanggal
            );

            $where = array(
                'id_stockBarang'       => $id_stockBarang
            );

            $whereAktivasi = array(
                'kode_barang'       => $kode_barang
            );

            $checkNama = $this->BarangModelV2->checkDuplicateNamaBarang($nama_barang);
            $checkPacthCore = $this->BarangModelV2->checkDataAktivasi($kode_barang);

            $namaBarang = $checkNama->nama_barang;
            $jumlahPCKAPC = $checkPacthCore->Patch_Core_Kuning_APC_Hijau;
            $jumlahPCKUPC = $checkPacthCore->Patch_Core_Kuning_UPC_Biru;
            $jumlahPCHUPC = $checkPacthCore->Patch_Core_Hitam_UPC_Outdor;
            $jumlahAdaptor = $checkPacthCore->Adaptor;

            if ($namaBarang == "Patch Core Kuning UPC (Biru)") {
                if ($jumlahNow == 0) {
                    echo "
                    <script>
                    alert('Stock Barang Kosong');history.go(-1)
                    document.location.href = 'tambahData';
                    </script>
                    ";
                } else {
                    if ($jumlah <= 2) {
                        if ($jumlahPCKUPC == null) {
                            $this->BarangModelV2->updateData('data_aktivasi', $dataPatch_Core_Kuning_UPC_Biru, $whereAktivasi);
                            $this->BarangModelV2->updateData('data_stockbarang', $dataStockGudang, $where);
                            $this->BarangModelV2->insertData($dataStockKeluar, 'data_stockkeluar');
                            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong>STOCK BARANG BERHASIL DIKURANGIN</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>');
                            redirect('admin/DataBarangV2/Data_StockBarangModem');
                        } else {
                            echo "
                        <script>
                        alert('Data Barang Sudah Dimasukkan');history.go(-1)
                        document.location.href = 'tambahData';
                        </script>
                        ";
                        }
                    } else {
                        echo "
                        <script>
                        alert('Jumlah Melebihi');history.go(-1)
                        document.location.href = 'tambahData';
                        </script>
                        ";
                    }
                }
            } elseif ($namaBarang == "Patch Core Kuning APC (Hijau)") {
                if ($jumlahNow == 0) {
                    echo "
                    <script>
                    alert('Stock Barang Kosong');history.go(-1)
                    document.location.href = 'tambahData';
                    </script>
                    ";
                } else {
                    if ($jumlah <= 2) {
                        if ($jumlahPCKAPC == null) {
                            $this->BarangModelV2->updateData('data_aktivasi', $dataPatch_Core_Kuning_APC_Hijau, $whereAktivasi);
                            $this->BarangModelV2->updateData('data_stockbarang', $dataStockGudang, $where);
                            $this->BarangModelV2->insertData($dataStockKeluar, 'data_stockkeluar');
                            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong>STOCK BARANG BERHASIL DIKURANGIN</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>');
                            redirect('admin/DataBarangV2/Data_StockBarangModem');
                        } else {
                            echo "
                        <script>
                        alert('Data Barang Sudah Dimasukkan');history.go(-1)
                        document.location.href = 'tambahData';
                        </script>
                        ";
                        }
                    } else {
                        echo "
                        <script>
                        alert('Jumlah Melebihi');history.go(-1)
                        document.location.href = 'tambahData';
                        </script>
                        ";
                    }
                }
            } elseif ($namaBarang == "Patch Core Hitam UPC Outdor") {
                if ($jumlahNow == 0) {
                    echo "
                    <script>
                    alert('Stock Barang Kosong');history.go(-1)
                    document.location.href = 'tambahData';
                    </script>
                    ";
                } else {
                    if ($jumlah <= 2) {
                        if ($jumlahPCHUPC == null) {
                            $this->BarangModelV2->updateData('data_aktivasi', $dataPatch_Core_Hitam_UPC_Outdor, $whereAktivasi);
                            $this->BarangModelV2->updateData('data_stockbarang', $dataStockGudang, $where);
                            $this->BarangModelV2->insertData($dataStockKeluar, 'data_stockkeluar');
                            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong>STOCK BARANG BERHASIL DIKURANGIN</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>');
                            redirect('admin/DataBarangV2/Data_StockBarangModem');
                        } else {
                            echo "
                        <script>
                        alert('Data Barang Sudah Dimasukkan');history.go(-1)
                        document.location.href = 'tambahData';
                        </script>
                        ";
                        }
                    } else {
                        echo "
                        <script>
                        alert('Jumlah Melebihi');history.go(-1)
                        document.location.href = 'tambahData';
                        </script>
                        ";
                    }
                }
            } elseif ($namaBarang == "Adaptor 1A" or $namaBarang == "Adaptor 1.5A" or $namaBarang == "Adaptor 2A") {
                if ($jumlahNow == 0) {
                    echo "
                    <script>
                    alert('Stock Barang Kosong');history.go(-1)
                    document.location.href = 'tambahData';
                    </script>
                    ";
                } else {
                    if ($jumlah <= 2) {
                        if ($jumlahAdaptor == null) {
                            $this->BarangModelV2->updateData('data_aktivasi', $dataAdaptor, $whereAktivasi);
                            $this->BarangModelV2->updateData('data_stockbarang', $dataStockGudang, $where);
                            $this->BarangModelV2->insertData($dataStockKeluar, 'data_stockkeluar');
                            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong>STOCK BARANG BERHASIL DIKURANGIN</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>');
                            redirect('admin/DataBarangV2/Data_StockBarangModem');
                        } else {
                            echo "
                            <script>
                            alert('Data Barang Sudah Dimasukkan');history.go(-1)
                            document.location.href = 'tambahData';
                            </script>
                            ";
                        }
                    } else {
                        echo "
                        <script>
                        alert('Jumlah Melebihi');history.go(-1)
                        document.location.href = 'tambahData';
                        </script>
                        ";
                    }
                }
            }
        }
    }
}
