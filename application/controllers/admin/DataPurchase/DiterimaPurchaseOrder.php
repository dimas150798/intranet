<?php

defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
ini_set('display_errors', 0);

class DiterimaPurchaseOrder extends CI_Controller
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

    public function diterimaOrder($id)
    {
        $checkPurchaseOrder     = $this->PurchasingModel->checkPurchaseOrder($id);

        if ($checkPurchaseOrder->kode_pay_purchase == null) {
            echo "
            <script>
            alert('Biaya Layanan Belum Terinput');history.go(-1)
            document.location.href = 'tambahData';            
            </script>
            ";
        } else {
            if ($checkPurchaseOrder->id_status == 5) {
                echo "
                <script>
                alert('ORDER SUDAH DITERIMA');history.go(-1)
                document.location.href = 'tambahData';            
                </script>
                ";
            } elseif ($checkPurchaseOrder->id_status == 3) {
                echo "
                <script>
                alert('REQUEST BELUM DITERIMA');history.go(-1)
                document.location.href = 'tambahData';            
                </script>
                ";
            } elseif ($checkPurchaseOrder->id_status == 15) {
                echo "
                <script>
                alert('ORDER SUDAH DITERIMA');history.go(-1)
                document.location.href = 'tambahData';            
                </script>
                ";
            } else {
                $data['dataOrder']  =  $this->db->query("SELECT dpo.id_purchase_order, dpo.no_purchase_order, dpo.no_purchase_request,
                    dpo.jumlah_order, dpo.tanggal, dpo.no_pesanan, dpo.nama_supplier, dpo.harga_barang, dpo.keterangan,
                    dpo.kode_pay_purchase, dpo.id_status, dpo.id_pegawai_order, dpo.id_barang, data_namabarang.nama_barang
            
                    FROM data_purchase_order AS dpo
                    INNER JOIN data_namabarang ON dpo.id_barang = data_namabarang.id_barang
                    INNER JOIN data_pegawai ON dpo.id_pegawai_order = data_pegawai.id_pegawai
                    
                    WHERE dpo.id_purchase_order = $id
                    
                    ORDER BY dpo.id_purchase_order DESC")->result();

                $data['dataPegawai'] = $this->PegawaiModel->dataPegawai();

                $this->load->view('template/header', $data);
                $this->load->view('template/sidebarAdmin', $data);
                $this->load->view('admin/DataPurchase/diterimaPurchaseOrder', $data);
                $this->load->view('template/footer', $data);
            }
        }
    }

    public function diterimaOrderAksi()
    {
        $id                         = $this->input->post('id_purchasing_order');

        $data['dataOrder']          =  $this->db->query("SELECT dpo.id_purchase_order, dpo.no_purchase_order, dpo.no_purchase_request,
        dpo.jumlah_order, dpo.tanggal, dpo.no_pesanan, dpo.nama_supplier, dpo.harga_barang, dpo.keterangan,
        dpo.kode_pay_purchase, dpo.id_status, dpo.id_pegawai_order, dpo.id_barang, data_namabarang.nama_barang

        FROM data_purchase_order AS dpo
        INNER JOIN data_namabarang ON dpo.id_barang = data_namabarang.id_barang
        INNER JOIN data_pegawai ON dpo.id_pegawai_order = data_pegawai.id_pegawai
        
        WHERE dpo.id_purchase_order = $id
        
        ORDER BY dpo.id_purchase_order DESC")->result();

        $no_purchase_request        = $this->input->post('no_purchase_request');
        $no_purchase_order          = $this->input->post('no_purchase_order');
        $idBarang                   = $this->input->post('idBarang');
        $id_pegawai                 = $this->input->post('pegawai');
        $tanggal                    = $this->input->post('tanggal');
        $jumlah_order               = $this->input->post('jumlah_order');
        $nama_barang                = $this->input->post('nama_barang');
        $keterangan                 = $this->input->post('keterangan');

        $checkBarang                = $this->BarangModelV2->checkDuplicateStockBarang($idBarang);
        $checkPurchaseOrder         = $this->PurchasingModel->checkPurchaseOrder($id);

        $stockBarang                = $checkBarang->jumlah_stockBarang;
        $idStockBarang              = $checkBarang->id_stockBarang;
        $restock                    = $stockBarang + $jumlah_order;
        $keterangan                 = $checkPurchaseOrder->keterangan;

        $dataOrder = array(
            'id_pegawai_terima'  => $id_pegawai,
            'tanggal_diterima'   => $tanggal,
            'id_status'          => 5,
        );

        $dataOrderAsset = array(
            'id_pegawai_terima'  => $id_pegawai,
            'tanggal_diterima'   => $tanggal,
            'id_status'          => 15,
        );

        $dataRequest = array(
            'id_status'          => 5,
        );

        $dataRequestAsset = array(
            'id_status'          => 15,
        );

        $dataBarangRestock = array(
            'tanggal_restock'    => $tanggal,
            'jumlah_stockBarang' => $restock,
        );

        $dataBarangBaru = array(
            'id_stockBarang'     => $idStockBarang,
            'id_barang'          => $idBarang,
            'jumlah_stockBarang' => $jumlah_order,
            'jumlah_stockMutasi' => 0,
            'jumlah_stockRusak'  => 0,
            'tanggal_restock'    => $tanggal,
        );

        $dataStockMasuk = array(
            'nama_barang'       => $nama_barang,
            'kode_barang'       => $no_purchase_order,
            'jumlah'            => $jumlah_order,
            'tanggal'           => $tanggal,
            'id_pegawai'        => $id_pegawai,
            'id_status'         => 14,
            'keterangan'        => $keterangan
        );

        $dataStockMasukPurchase = array(
            'nama_barang'       => $nama_barang,
            'kode_barang'       => $no_purchase_order,
            'jumlah'            => $jumlah_order,
            'tanggal'           => $tanggal,
            'id_pegawai'        => $id_pegawai,
            'id_status'         => 15,
            'keterangan'        => $keterangan
        );

        $whereOrder = array(
            'id_purchase_order' => $id
        );

        $whereRequest = array(
            'no_purchase_request' => $no_purchase_request
        );

        $whereBarang = array(
            'id_barang'           => $idBarang
        );

        if ($checkPurchaseOrder->id_peralatan == 1 or $checkPurchaseOrder->id_peralatan == 2) {
            $this->PurchasingModel->updateData('data_purchase_order', $dataOrderAsset, $whereOrder);
            $this->PurchasingModel->updateData('data_purchase_request', $dataRequestAsset, $whereRequest);

            $this->BarangModel->insertData($dataStockMasukPurchase, 'data_stockmasuk');

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>PURCHASE ORDER BERHASIL</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('admin/DataPurchase/DataPurchaseOrder');
        } else {
            if ($idStockBarang == null & $idStockBarang == 0) {
                $this->PurchasingModel->updateData('data_purchase_order', $dataOrder, $whereOrder);
                $this->PurchasingModel->updateData('data_purchase_request', $dataRequest, $whereRequest);

                $this->BarangModel->insertData($dataBarangBaru, 'data_stockbarang');
                $this->BarangModel->insertData($dataStockMasuk, 'data_stockmasuk');

                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>PURCHASE ORDER BERHASIL</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
                redirect('admin/DataPurchase/DataPurchaseOrder');
            } else {
                $this->PurchasingModel->updateData('data_purchase_order', $dataOrder, $whereOrder);
                $this->PurchasingModel->updateData('data_purchase_request', $dataRequest, $whereRequest);

                $this->PurchasingModel->updateData('data_stockbarang', $dataBarangRestock, $whereBarang);
                $this->BarangModel->insertData($dataStockMasuk, 'data_stockmasuk');

                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>PURCHASE ORDER BERHASIL</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>');
                redirect('admin/DataPurchase/DataPurchaseOrder');
            }
        }
    }
}
