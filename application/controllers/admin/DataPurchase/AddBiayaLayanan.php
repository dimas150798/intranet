<?php

class AddBiayaLayanan extends CI_Controller
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

    public function addBiaya($id)
    {
        $checkPurchaseOrder     = $this->PurchasingModel->checkPurchaseOrder($id);
        $kodePayPurchase          = $checkPurchaseOrder->kode_pay_purchase;

        if ($kodePayPurchase != null) {
            echo "
            <script>
            alert('Biaya Layanan Sudah Dimasukkan');history.go(-1)
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
            $this->load->view('admin/DataPurchase/addBiayaLayanan', $data);
            $this->load->view('template/footer', $data);
        }
    }

    public function addBiayaAksi()
    {
        $id                         = $this->input->post('id_purchase_order');
        $no_purchase_order          = $this->input->post('no_purchase_order');

        $data['dataOrder']  =  $this->db->query("SELECT dpo.id_purchase_order, dpo.no_purchase_order, dpo.no_purchase_request,
        dpo.jumlah_order, dpo.tanggal, dpo.no_pesanan, dpo.nama_supplier, dpo.harga_barang, dpo.keterangan,
        dpo.kode_pay_purchase, dpo.id_status, dpo.id_pegawai_order, dpo.id_barang, data_namabarang.nama_barang

        FROM data_purchase_order AS dpo
        INNER JOIN data_namabarang ON dpo.id_barang = data_namabarang.id_barang
        INNER JOIN data_pegawai ON dpo.id_pegawai_order = data_pegawai.id_pegawai
        
        WHERE dpo.id_purchase_order = $id
        
        ORDER BY dpo.id_purchase_order DESC")->result();

        $data['dataPegawai']    = $this->PegawaiModel->dataPegawai();

        $biaya_ongkir           = $this->input->post('biaya_ongkir');
        $biaya_penanganan       = $this->input->post('biaya_penanganan');
        $biaya_layanan          = $this->input->post('biaya_layanan');
        $kode_pay_purchase      = $this->input->post('kode_pay_purchase');

        $dataOrder = array(
            'kode_pay_purchase'           => $kode_pay_purchase
        );

        $whereOrder = array(
            'no_purchase_order'   => $no_purchase_order
        );

        $dataPayLayanan = array(
            'kode_pay_purchase'     => $kode_pay_purchase,
            'biaya_ongkir'          => $biaya_ongkir,
            'biaya_penanganan'      => $biaya_penanganan,
            'biaya_layanan'         => $biaya_layanan
        );

        $this->form_validation->set_rules('biaya_ongkir', 'Biaya Ongkir', 'required');
        $this->form_validation->set_rules('biaya_penanganan', 'Biaya Penanganan', 'required');
        $this->form_validation->set_rules('biaya_layanan', 'Biaya Layanan', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebarAdmin', $data);
            $this->load->view('admin/DataPurchase/addBiayaLayanan', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->PurchasingModel->updateData('data_purchase_order', $dataOrder, $whereOrder);
            $this->PurchasingModel->insertData($dataPayLayanan, 'data_pay_purchase');

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>PURCHASE REQUEST BERHASIL</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>');
            redirect('admin/DataPurchase/DataPurchaseOrder');
        }
    }
}
