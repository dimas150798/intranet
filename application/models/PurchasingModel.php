<?php


class PurchasingModel extends CI_Model
{
    // Menambah Data Baru
    public function insertData($data, $table)
    {
        $this->db->insert($table, $data);
    }

    // Menghapus Data
    public function deleteData($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    // Update Data
    public function updateData($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
    }

    //  Menampilkan rekap data request
    public function dataRekapRequest($tanggalAwal, $tanggalAkhir)
    {
        $query   = $this->db->query("SELECT dbr.id_purchasing_request, dbr.no_purchase_request, dbr.id_pegawai, 
        dbr.id_barang, dbr.quantinty, dbr.tanggal, dbr.keterangan, dbr.id_status, data_pegawai.nama_pegawai, data_barang.nama_barang

        FROM data_purchase_request AS dbr
        LEFT JOIN data_pegawai ON dbr.id_pegawai = data_pegawai.id_pegawai
        LEFT JOIN data_barang ON dbr.id_barang = data_barang.id_barang

        WHERE dbr.tanggal BETWEEN '$tanggalAwal' AND '$tanggalAkhir'

        GROUP BY dbr.no_purchase_request
        ORDER BY dbr.id_purchasing_request DESC
      ");

        return $query->result_array();
    }

    //  Menampilkan data request
    public function dataRequest($tanggalAwal, $tanggalAkhir)
    {
        $query   = $this->db->query("SELECT dbr.id_purchase_request, dbr.no_purchase_request, dbr.id_pegawai, 
        dbr.id_barang, dbr.jumlah_request, dbr.tanggal, dbr.keterangan, dbr.id_status, data_pegawai.nama_pegawai, data_namabarang.nama_barang

        FROM data_purchase_request AS dbr
        LEFT JOIN data_pegawai ON dbr.id_pegawai = data_pegawai.id_pegawai
        LEFT JOIN data_namabarang ON dbr.id_barang = data_namabarang.id_barang

        WHERE dbr.tanggal BETWEEN '$tanggalAwal' AND '$tanggalAkhir'

        ORDER BY dbr.id_purchase_request DESC
      ");

        return $query->result_array();
    }

    //  Menampilkan data rekap order
    public function dataRekapOrder($tanggalAwal, $tanggalAkhir)
    {
        $query   = $this->db->query("SELECT dpo.id_purchasing_order, dpo.no_purchase_request, 
        dpo.id_barang, dpo.no_purchase_order, dpo.no_reff, dpo.nama_supplier, dpo.sub_total, 
        dpo.ongkir, dpo.id_pegawai, dpo.tanggal, dpo.id_status, dpo.quantinty, data_barang.nama_barang, data_pegawai.nama_pegawai

        FROM data_purchase_order AS dpo
        LEFT JOIN data_barang ON dpo.id_barang = data_barang.id_barang
        LEFT JOIN data_pegawai ON dpo.id_pegawai = data_pegawai.id_pegawai
        
        WHERE dpo.tanggal BETWEEN '$tanggalAwal' AND '$tanggalAkhir'
        
        GROUP BY dpo.no_purchase_order
        ORDER BY dpo.id_purchasing_order DESC
         ");

        return $query->result_array();
    }

    //  Menampilkan data order
    public function dataOrder($tanggalAwal, $tanggalAkhir)
    {
        $query   = $this->db->query("SELECT dpo.id_purchase_order, dpo.no_purchase_order, dpo.no_purchase_request,
        dpo.jumlah_order, dpo.tanggal, dpo.no_pesanan, dpo.nama_supplier, dpo.harga_barang, dpo.keterangan, dpo.id_status,
        data_namabarang.nama_barang, data_pegawai.nama_pegawai, data_status.nama_status, 
        data_pay_purchase.biaya_ongkir, data_pay_purchase.biaya_penanganan, data_pay_purchase.biaya_layanan

        FROM data_purchase_order AS dpo
        LEFT JOIN data_namabarang ON dpo.id_barang = data_namabarang.id_barang
        LEFT JOIN data_pegawai ON dpo.id_pegawai_order = data_pegawai.id_pegawai
        LEFT JOIN data_status ON dpo.id_status = data_status.id_status
        LEFT JOIN data_pay_purchase ON dpo.kode_pay_purchase = data_pay_purchase.id_pay_purchase
        
        WHERE dpo.tanggal BETWEEN '$tanggalAwal' AND '$tanggalAkhir'
        
        ORDER BY dpo.id_purchase_order DESC
         ");

        return $query->result_array();
    }

    // invoice purchase request
    public function invoiceRequest()
    {
        $sql = "SELECT MAX(MID(no_purchase_request,8,4)) AS invoiceID 
        FROM data_purchase_request
        WHERE MID(no_purchase_request,4,4) = DATE_FORMAT(CURDATE(), '%y%m')";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $dataRow    = $query->row();
            $dataN      = ((int)$dataRow->invoiceID) + 1;
            $no         = sprintf("%'.04d", $dataN);
        } else {
            $no         = "0001";
        }

        $invoice = "INR".date('ym').$no;
        return $invoice;
    }

    // invoice purchase order
    public function invoiceOrder()
    {
        $sql = "SELECT MAX(MID(no_purchase_order,8,4)) AS invoiceID 
        FROM data_purchase_order
        WHERE MID(no_purchase_order,4,4) = DATE_FORMAT(CURDATE(), '%y%m')";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $dataRow    = $query->row();
            $dataN      = ((int)$dataRow->invoiceID) + 1;
            $no         = sprintf("%'.04d", $dataN);
        } else {
            $no         = "0001";
        }

        $invoice = "INO".date('ym').$no;
        return $invoice;
    }

    // invoice purchase order
    public function invoicePay()
    {
        $sql = "SELECT MAX(MID(kode_pay_purchase,8,4)) AS invoiceID 
            FROM data_pay_purchase
            WHERE MID(kode_pay_purchase,4,4) = DATE_FORMAT(CURDATE(), '%y%m')";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $dataRow    = $query->row();
            $dataN      = ((int)$dataRow->invoiceID) + 1;
            $no         = sprintf("%'.04d", $dataN);
        } else {
            $no         = "0001";
        }

        $invoice = "IPO".date('ym').$no;
        return $invoice;
    }

    // Check Pengembalian Barang
    public function checkPurchaseOrder($id_purchase_order)
    {
        $this->db->select('data_purchase_order.id_purchase_order, data_purchase_order.no_purchase_order, data_purchase_order.no_purchase_request,
        data_purchase_order.jumlah_order, data_purchase_order.tanggal, data_purchase_order.no_pesanan, data_purchase_order.nama_supplier,
        data_purchase_order.harga_barang, data_purchase_order.keterangan, data_purchase_order.kode_pay_purchase, data_purchase_order.id_status,
        data_purchase_order.id_pegawai_order, data_purchase_order.id_barang, data_namabarang.id_peralatan');

        $this->db->where('data_purchase_order.id_purchase_order', $id_purchase_order);
        $this->db->join('data_purchase_request', 'data_purchase_order.no_purchase_request = data_purchase_request.no_purchase_request', 'left');
        $this->db->join('data_namabarang', 'data_purchase_request.id_barang = data_namabarang.id_barang', 'left');

        $this->db->limit(1);
        $result = $this->db->get('data_purchase_order');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check Purchase Request
    public function checkPurchaseRequest($no_purchase_request)
    {
        $this->db->select('data_purchase_request.id_purchase_request, data_purchase_request.no_purchase_request, data_purchase_request.id_barang, data_purchase_request.id_pegawai,
        data_purchase_request.jumlah_request, data_purchase_request.tanggal, data_purchase_request.keterangan, data_purchase_request.id_status, data_namabarang.nama_barang, data_pegawai.nama_pegawai, 
        data_purchase_order.no_purchase_order');

        $this->db->where('data_purchase_request.no_purchase_request', $no_purchase_request);
        $this->db->join('data_namabarang', 'data_purchase_request.id_barang = data_namabarang.id_barang', 'left');
        $this->db->join('data_pegawai', 'data_purchase_request.id_pegawai = data_pegawai.id_pegawai', 'left');
        $this->db->join('data_purchase_order', 'data_purchase_request.no_purchase_request = data_purchase_order.no_purchase_request', 'left');

        $this->db->limit(1);
        $result = $this->db->get('data_purchase_request');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
}
