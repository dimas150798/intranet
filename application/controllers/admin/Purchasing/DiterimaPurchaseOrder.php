<?php

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
        $data['dataOrder']  =  $this->db->query("SELECT dpo.id_purchasing_order, dpo.no_purchase_request, 
      dpo.id_barang, dpo.no_purchase_order, dpo.no_reff, dpo.nama_supplier, dpo.sub_total, 
      dpo.ongkir, dpo.id_pegawai, dpo.tanggal, dpo.id_status, dpo.quantinty, data_barang.nama_barang, data_pegawai.nama_pegawai

      FROM data_purchase_order AS dpo
      INNER JOIN data_barang ON dpo.id_barang = data_barang.id_barang
      INNER JOIN data_pegawai ON dpo.id_pegawai = data_pegawai.id_pegawai
      
      WHERE dpo.id_purchasing_order = $id
      
      ORDER BY dpo.id_purchasing_order DESC")->result();

        $data['dataPegawai'] = $this->PegawaiModel->dataPegawai();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/Purchasing/diterimaPurchaseOrder', $data);
        $this->load->view('template/footer', $data);
    }

    public function diterimaOrderAksi()
    {
        $id                         = $this->input->post('id_purchasing_order');
        $no_purchase_request        = $this->input->post('no_purchase_request');
        $id_barang                  = $this->input->post('id_barang');

        $data['dataOrder']  =  $this->db->query("SELECT dpo.id_purchasing_order, dpo.no_purchase_request, 
      dpo.id_barang, dpo.no_purchase_order, dpo.no_reff, dpo.nama_supplier, dpo.sub_total, 
      dpo.ongkir, dpo.id_pegawai, dpo.tanggal, dpo.id_status, dpo.quantinty, data_barang.nama_barang, data_pegawai.nama_pegawai

      FROM data_purchase_order AS dpo
      INNER JOIN data_barang ON dpo.id_barang = data_barang.id_barang
      INNER JOIN data_pegawai ON dpo.id_pegawai = data_pegawai.id_pegawai
      
      WHERE dpo.id_purchasing_order = $id
      
      ORDER BY dpo.id_purchasing_order DESC")->result();

        $checkPurchaseOrder     = $this->PurchasingModel->checkPurchaseOrder($id);
        $checkBarang            = $this->BarangModel->checkStockBarangPusat($id_barang);

        $stockBarang            = $checkBarang->jumlah;
        $id_pegawai             = $this->input->post('pegawai');
        $tanggal                = $this->input->post('tanggal');
        $quantinty              = $this->input->post('quantinty');

        $restock                = $stockBarang + $quantinty;

        $data = array(
            'id_pegawai'         => $id_pegawai,
            'tanggal'            => $tanggal,
            'id_status'          => 5,
        );

        $dataRequest = array(
            'id_status'          => 5,
        );

        $dataBarang= array(
            'jumlah'             => $restock,
            'tanggal'            => $tanggal,
        );

        $dataBarangRestock = array(
            'nama_barang'        => $checkPurchaseOrder->nama_barang,
            'tanggal'            => $tanggal,
            'jumlah'             => $quantinty,
        );

        $where = array(
            'id_purchasing_order' => $id
        );

        $whereRequest = array(
            'no_purchase_request' => $no_purchase_request
        );

        $whereBarang = array(
            'id_barang'           => $id_barang
        );

        if ($checkPurchaseOrder->id_status == 5) {
            echo "
            <script>
            alert('ORDER SUDAH DITERIMA');history.go(-1)
            document.location.href = 'tambahData';            
            </script>
            ";
        } else {
            $this->BarangModel->insertData($dataBarangRestock, 'data_barang_restock');
            $this->PurchasingModel->updateData('data_purchase_order', $data, $where);
            $this->PurchasingModel->updateData('data_purchase_request', $dataRequest, $whereRequest);
            $this->PurchasingModel->updateData('data_barang', $dataBarang, $whereBarang);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>PURCHASE ORDER BERHASIL</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>');
            redirect('admin/Purchasing/DataPurchaseOrder');
        }
    }
}
