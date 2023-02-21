<?php


class CustomerModel extends CI_Model
{
    // Menampilkan data customer
    public function dataCustomer()
    {
        $query   = $this->db->query("SELECT data_customer.id_customer,data_customer.pembelian_paket,data_customer.nama_customer,      
      data_customer.nik_customer,data_customer.alamat_customer,data_customer.tlp_customer,
      data_kota.nama_kota, data_kecamatan.nama_kecamatan, data_kelurahan.nama_kelurahan
      
      FROM data_customer
      LEFT JOIN data_kota ON data_customer.id_kota = data_kota.id_kota
      LEFT JOIN data_kecamatan ON data_customer.id_kecamatan = data_kecamatan.id_kecamatan
      LEFT JOIN data_kelurahan ON data_customer.id_kelurahan = data_kelurahan.id_kelurahan

      WHERE data_customer.id_status IS NULL

      ORDER BY data_customer.nama_customer ASC
      ");

        return $query->result_array();
    }

    // Menampilkan data customer terminate
    public function dataCustomerTerminate()
    {
        $query   = $this->db->query("SELECT data_customer.id_customer,data_customer.pembelian_paket,data_customer.nama_customer,      
          data_customer.nik_customer,data_customer.alamat_customer,data_customer.tlp_customer,
          data_kota.nama_kota, data_kecamatan.nama_kecamatan, data_kelurahan.nama_kelurahan
          
          FROM data_customer
          LEFT JOIN data_kota ON data_customer.id_kota = data_kota.id_kota
          LEFT JOIN data_kecamatan ON data_customer.id_kecamatan = data_kecamatan.id_kecamatan
          LEFT JOIN data_kelurahan ON data_customer.id_kelurahan = data_kelurahan.id_kelurahan
    
          WHERE data_customer.id_status IS NOT NULL
    
          ORDER BY data_customer.nama_customer ASC
          ");

        return $query->result_array();
    }

    // Menghitung jumlah Customer
    public function jumlahCustomer()
    {
        $query   = $this->db->query("SELECT id_customer, pembelian_paket, nama_customer
          FROM data_customer");

        return $query->num_rows();
    }

    // Menampilkan data customer KBS
    public function dataCustomerKBS()
    {
        $query   = $this->db->query("SELECT data_customer_kbs.id_customer,data_customer_kbs.pembelian_paket,data_customer_kbs.nama_customer,      
      data_customer_kbs.nik_customer,data_customer_kbs.alamat_customer,data_customer_kbs.tlp_customer,data_customer_kbs.id_wilayah,data_customer_kbs.SN, 
      data_kota.nama_kota, data_kecamatan.nama_kecamatan, data_kelurahan.nama_kelurahan
      
      FROM data_customer_kbs
      LEFT JOIN data_kota ON data_customer_kbs.id_kota = data_kota.id_kota
      LEFT JOIN data_kecamatan ON data_customer_kbs.id_kecamatan = data_kecamatan.id_kecamatan
      LEFT JOIN data_kelurahan ON data_customer_kbs.id_kelurahan = data_kelurahan.id_kelurahan

      ORDER BY data_customer_kbs.nama_customer ASC
      ");

        return $query->result_array();
    }

    // Menampilkan data customer SN
    public function dataCustomerSN()
    {
        $query   = $this->db->query("SELECT data_barang_mutasi.id_barang_mutasi, data_barang_mutasi.id_barang, data_barang_mutasi.SN, data_barang_mutasi.id_customer, 
        data_barang_mutasi.kode_mutasi, data_barang_mutasi.tanggal, data_barang_mutasi.jumlah, data_barang_mutasi.keterangan, data_barang.nama_barang, data_customer.nama_customer

        FROM data_barang_mutasi 
        LEFT JOIN data_barang ON data_barang_mutasi.id_barang = data_barang.id_barang
        LEFT JOIN data_customer ON data_barang_mutasi.id_customer = data_customer.id_customer
        WHERE data_barang_mutasi.SN IS NOT NULL
        
        ORDER BY data_customer.nama_customer ASC");

        return $query->result_array();
    }

    // Menampilkan data pendidikan pegawai
    public function dataPaket()
    {
        $query   = $this->db->query("SELECT id_paket, nama_paket
      
      FROM data_paket");

        return $query->result();
    }

    // Menampilkan data kota/Kab
    public function dataKotKabEdit($id_kota)
    {
        $query   = $this->db->query("SELECT id_kota, nama_kota
      
      FROM data_kota
      WHERE id_kota = $id_kota
      ");

        return $query->result();
    }

    // Menampilkan data kota/Kab
    public function dataKotKab()
    {
        $query   = $this->db->query("SELECT id_kota, nama_kota
      
      FROM data_kota");

        return $query->result();
    }

    // Menampilkan data kecamatan
    public function dataKecamatan()
    {
        $query   = $this->db->query("SELECT id_kecamatan, nama_kecamatan, id_kota
      
      FROM data_kecamatan");

        return $query->result();
    }

    // Menampilkan data kelurahan
    public function dataKelurahan()
    {
        $query   = $this->db->query("SELECT id_kelurahan, nama_kelurahan, id_kecamatan
      
      FROM data_kelurahan");

        return $query->result();
    }

    // Menampilkan Kecamatan
    public function ListKecamatan($id_kota)
    {
        $query   = $this->db->query("SELECT id_kecamatan, nama_kecamatan, id_kota
      FROM data_kecamatan
      
      WHERE id_kota = $id_kota
      ORDER BY nama_kecamatan ASC");

        return $query->result();
    }

    // Menampilkan Kecamatan
    public function ListKelurahan($id_kecamatan)
    {
        $query   = $this->db->query("SELECT id_kelurahan, nama_kelurahan, id_kecamatan
      FROM data_kelurahan
      
      WHERE id_kecamatan = $id_kecamatan
      ORDER BY nama_kelurahan ASC");

        return $query->result();
    }

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

    // Check Nama Customer Duplicate
    public function checkDuplicateCustomer($nama_customer, $nik_customer)
    {
        $this->db->select('id_customer, pembelian_paket, nama_customer, nik_customer, alamat_customer,
                        id_kota, id_kecamatan, id_kelurahan, tlp_customer');
        $this->db->where('nama_customer', $nama_customer);
        $this->db->where('nik_customer', $nik_customer);
        $this->db->order_by('nama_customer', 'ASC');

        $this->db->limit(1);
        $result = $this->db->get('data_customer');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check Nama Customer KBS Duplicate
    public function checkDuplicateCustomerKBS($nama_customer, $nik_customer)
    {
        $this->db->select('id_customer, pembelian_paket, nama_customer, nik_customer, alamat_customer,
                        id_kota, id_kecamatan, id_kelurahan, tlp_customer');
        $this->db->where('nama_customer', $nama_customer);
        $this->db->where('nik_customer', $nik_customer);
        $this->db->order_by('nama_customer', 'ASC');

        $this->db->limit(1);
        $result = $this->db->get('data_customer_kbs');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
}
