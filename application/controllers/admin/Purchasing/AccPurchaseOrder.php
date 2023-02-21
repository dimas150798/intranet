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
        $this->load->view('admin/Purchasing/accPurchaseOrder', $data);
        $this->load->view('template/footer', $data);
    }

    public function accRequestAksi()
    {
        $id                         = $this->input->post('id_purchasing_order');
        $no_purchase_request        = $this->input->post('no_purchase_request');

        $data['dataOrder']  =  $this->db->query("SELECT dpo.id_purchasing_order, dpo.no_purchase_request, dpo.no_purchase_order, dpo.id_pegawai,
        dpo.tanggal, dpo.id_status, data_pegawai.nama_pegawai, data_status.nama_status, data_barang.nama_barang, data_purchase_request.quantinty,
        data_purchase_request.quantinty, data_barang.id_barang, data_barang.jumlah, dpo.no_reff, dpo.nama_supplier, dpo.sub_total

        FROM data_purchase_order AS dpo
        LEFT JOIN data_purchase_request ON dpo.no_purchase_request = data_purchase_request.no_purchase_request
        LEFT JOIN data_pegawai ON dpo.id_pegawai = data_pegawai.id_pegawai
        LEFT JOIN data_status ON dpo.id_status = data_status.id_status
        LEFT JOIN data_barang ON data_purchase_request.id_barang = data_barang.id_barang

        WHERE dpo.id_purchasing_order = '$id'

        ORDER BY dpo.tanggal DESC")->result();

        $checkPurchaseOrder     = $this->PurchasingModel->checkPurchaseOrder($id);
        $data['dataPegawai']    = $this->PegawaiModel->dataPegawai();

        $this->form_validation->set_rules('no_reff', 'No Reff', 'required');
        $this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'required');
        $this->form_validation->set_rules('sub_total', 'Sub Total', 'required');
        $this->form_validation->set_rules('ongkir', 'Ongkir', 'required');
        $this->form_validation->set_message('required', 'Masukan data terlebih dahulu...');

        if ($this->form_validation->run() == false) {
            $id                         = $this->input->post('id_purchasing_order');

            $data['dataOrder']  =  $this->db->query("SELECT dpo.id_purchasing_order, dpo.no_purchase_request, dpo.no_purchase_order, dpo.id_pegawai,
            dpo.tanggal, dpo.id_status, data_pegawai.nama_pegawai, data_status.nama_status, data_barang.nama_barang, data_purchase_request.quantinty,
            data_purchase_request.quantinty, data_barang.id_barang, data_barang.jumlah, dpo.no_reff, dpo.nama_supplier, dpo.sub_total

            FROM data_purchase_order AS dpo
            LEFT JOIN data_purchase_request ON dpo.no_purchase_request = data_purchase_request.no_purchase_request
            LEFT JOIN data_pegawai ON dpo.id_pegawai = data_pegawai.id_pegawai
            LEFT JOIN data_status ON dpo.id_status = data_status.id_status
            LEFT JOIN data_barang ON data_purchase_request.id_barang = data_barang.id_barang

            WHERE dpo.id_purchasing_order = '$id'

            ORDER BY dpo.tanggal DESC")->result();

            $data['dataPegawai']    = $this->PegawaiModel->dataPegawai();

            $this->load->view('template/header', $data);
            $this->load->view('template/sidebarAdmin', $data);
            $this->load->view('admin/Purchasing/accPurchaseOrder', $data);
            $this->load->view('template/footer', $data);
        } else {
            $checkPurchaseOrder     = $this->PurchasingModel->checkPurchaseOrder($id);

            $id_pegawai             = $this->input->post('pegawai');
            $tanggal                = $this->input->post('tanggal');
            $no_reff                = $this->input->post('no_reff');
            $nama_supplier          = $this->input->post('nama_supplier');
            $sub_total              = $this->input->post('sub_total');
            $ongkir                 = $this->input->post('ongkir');

            $dataOrder = array(
                'no_reff'       => $no_reff,
                'nama_supplier' => $nama_supplier,
                'sub_total'     => $sub_total,
                'ongkir'        => $ongkir,
                'id_pegawai'    => $id_pegawai,
                'tanggal'       => $tanggal,
                'id_status'     => 4,
            );

            $whereOrder = array(
                'id_purchasing_order'   => $id
            );

            $dataRequest = array(
                'id_status'          => 4,
            );

            $whereRequest = array(
                'no_purchase_request'   => $no_purchase_request
            );

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
                redirect('admin/Purchasing/DataPurchaseOrder');
            }
        }
    }

    public function diterimaOrder($id)
    {
        $data['dataOrder']  =  $this->db->query("SELECT dpo.id_purchasing_order, dpo.no_purchase_request, dpo.no_purchase_order, dpo.id_pegawai,
        dpo.tanggal, dpo.id_status, data_pegawai.nama_pegawai, data_status.nama_status, data_barang.nama_barang, data_purchase_request.quantinty,
        data_purchase_request.quantinty, data_barang.id_barang, data_barang.jumlah, dpo.no_reff, dpo.nama_supplier, dpo.sub_total

        FROM data_purchase_order AS dpo
        LEFT JOIN data_purchase_request ON dpo.no_purchase_request = data_purchase_request.no_purchase_request
        LEFT JOIN data_pegawai ON dpo.id_pegawai = data_pegawai.id_pegawai
        LEFT JOIN data_status ON dpo.id_status = data_status.id_status
        LEFT JOIN data_barang ON data_purchase_request.id_barang = data_barang.id_barang
        
        WHERE dpo.id_purchasing_order = '$id'
        
        ORDER BY dpo.tanggal DESC")->result();

        $data['dataPegawai'] = $this->PegawaiModel->dataPegawai();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebarAdmin', $data);
        $this->load->view('admin/Purchasing/donePurchaseOrder', $data);
        $this->load->view('template/footer', $data);
    }

    public function diterimaOrderAksi()
    {
        $id                         = $this->input->post('id_purchasing_order');
        $no_purchase_request        = $this->input->post('no_purchase_request');
        $id_barang                  = $this->input->post('id_barang');

        $data['dataOrder']  =  $this->db->query("SELECT dpo.id_purchasing_order, dpo.no_purchase_request, dpo.no_purchase_order, dpo.id_pegawai,
        dpo.tanggal, dpo.id_status, data_pegawai.nama_pegawai, data_status.nama_status, data_barang.nama_barang, data_purchase_request.quantinty,
        data_purchase_request.quantinty, data_barang.id_barang, data_barang.jumlah, dpo.no_reff, dpo.nama_supplier, dpo.sub_total

        FROM data_purchase_order AS dpo
        LEFT JOIN data_purchase_request ON dpo.no_purchase_request = data_purchase_request.no_purchase_request
        LEFT JOIN data_pegawai ON dpo.id_pegawai = data_pegawai.id_pegawai
        LEFT JOIN data_status ON dpo.id_status = data_status.id_status
        LEFT JOIN data_barang ON data_purchase_request.id_barang = data_barang.id_barang
        
        WHERE dpo.id_purchasing_order = '$id'
        
        ORDER BY dpo.tanggal DESC")->result();

        $checkPurchaseOrder     = $this->PurchasingModel->checkPurchaseOrder($id);
        $data['dataPegawai']    = $this->PegawaiModel->dataPegawai();

        $id_pegawai             = $this->input->post('pegawai');
        $tanggal                = $this->input->post('tanggal');
        $quantinty              = $this->input->post('quantinty');
        $jumlah                 = $this->input->post('jumlah');

        $restock                = $jumlah + $quantinty;

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
