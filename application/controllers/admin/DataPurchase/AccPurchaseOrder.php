<?php

class AccPurchaseOrder extends CI_Controller
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

    public function accRequest($id)
    {
        $checkPurchaseOrder     = $this->PurchasingModel->checkPurchaseOrder($id);
        $idStatus               = $checkPurchaseOrder->id_status;

        if ($idStatus != 3) {
            echo "
            <script>
            alert('Request Sudah Di ACC');history.go(-1)
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
            $this->load->view('admin/DataPurchase/accPurchaseOrder', $data);
            $this->load->view('template/footer', $data);
        }
    }

    public function accRequestAksi()
    {
        $id                         = $this->input->post('id_purchase_order');
        $no_purchase_request        = $this->input->post('no_purchase_request');

        $data['dataOrder']  =  $this->db->query("SELECT dpo.id_purchase_order, dpo.no_purchase_order, dpo.no_purchase_request,
            dpo.jumlah_order, dpo.tanggal, dpo.no_pesanan, dpo.nama_supplier, dpo.harga_barang, dpo.keterangan,
            dpo.kode_pay_purchase, dpo.id_status, dpo.id_pegawai_order, dpo.id_barang, data_namabarang.nama_barang
    
    
            FROM data_purchase_order AS dpo
            INNER JOIN data_namabarang ON dpo.id_barang = data_namabarang.id_barang
            INNER JOIN data_pegawai ON dpo.id_pegawai_order = data_pegawai.id_pegawai
            
            WHERE dpo.id_purchase_order = $id
            
            ORDER BY dpo.id_purchase_order DESC")->result();

        $data['dataPegawai']    = $this->PegawaiModel->dataPegawai();
        $checkPurchaseOrder     = $this->PurchasingModel->checkPurchaseOrder($id);

        $nama_supplier          = $this->input->post('nama_supplier');
        $no_pesanan             = $this->input->post('no_pesanan');
        $harga_barang           = $this->input->post('harga_barang');
        $id_pegawai             = $this->input->post('pegawai');
        $tanggal                = $this->input->post('tanggal');
        $keterangan             = $this->input->post('keterangan');

        $dataOrder = array(
            'tanggal'           => $tanggal,
            'no_pesanan'        => $no_pesanan,
            'nama_supplier'     => $nama_supplier,
            'harga_barang'      => $harga_barang,
            'id_pegawai_order'  => $id_pegawai,
            'id_status'         => 4,
        );

        $whereOrder = array(
            'id_purchase_order'   => $id
        );

        $dataRequest = array(
            'id_status'          => 4,
        );

        $whereRequest = array(
            'no_purchase_request'   => $no_purchase_request
        );

        $this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'required');
        $this->form_validation->set_rules('no_pesanan', 'No Pesanan', 'required');
        $this->form_validation->set_rules('harga_barang', 'Harga Barang', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebarAdmin', $data);
            $this->load->view('admin/DataPurchase/accPurchaseOrder', $data);
            $this->load->view('template/footer', $data);
        } else {
            if ($checkPurchaseOrder->id_status == 4) {
                echo "
                <script>
                alert('REQUEST BARANG SUDAH DITERIMA');history.go(-1)
                document.location.href = 'tambahData';
                </script>
                ";
            } else {
                $this->PurchasingModel->updateData('data_purchase_order', $dataOrder, $whereOrder);
                $this->PurchasingModel->updateData('data_purchase_request', $dataRequest, $whereRequest);

                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>PURCHASE REQUEST BERHASIL</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>');
                redirect('admin/DataPurchase/DataPurchaseOrder');
            }
        }
    }
}
