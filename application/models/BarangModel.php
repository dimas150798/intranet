<?php


class BarangModel extends CI_Model
{
    // Menghitung jumlah barang restock bulan ini
    public function jumlahBarangRestock($month)
    {
        $query   = $this->db->query("SELECT id_barang_restock, nama_barang, tanggal
              FROM data_barang_restock
              WHERE MONTH(tanggal) = '$month'
              ");

        return $query->num_rows();
    }

    // Menghitung jumlah barang keluar bulan ini
    public function jumlahBarangKeluar($month)
    {
        $query   = $this->db->query("SELECT id_barang_mutasi, id_barang, tanggal
          FROM data_barang_mutasi
          WHERE MONTH(tanggal) = '$month'
          ");

        return $query->num_rows();
    }

    // Menghitung jumlah barang
    public function jumlahBarang()
    {
        $query   = $this->db->query("SELECT id_barang, kode_barang, nama_barang,
      satuan, tanggal, jumlah
      FROM data_barang");

        return $query->num_rows();
    }

    // Menampilkan data pegawai
    public function dataPegawai()
    {
        $query   = $this->db->query("SELECT id_pegawai, NIK, nama_pegawai, no_telpon,
      alamat_pegawai, pendidikan_pegawai, jabatan, tanggal_masuk, gaji, photo
      
      FROM data_pegawai");

        return $query->result_array();
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

    // Menampilkan data barang pusat
    public function dataBarangPusat()
    {
        $query   = $this->db->query("SELECT 
      data_barang.id_barang, data_barang.kode_barang, data_barang.nama_barang, 
      data_barang.satuan, data_barang.keterangan, data_barang.tanggal, data_barang.jumlah, 
      SUM(data_barang_mutasi.jumlah) AS jumlahMutasi
      
      FROM data_barang
      LEFT JOIN data_barang_mutasi ON data_barang.id_barang = data_barang_mutasi.id_barang

      GROUP BY data_barang.nama_barang
      ORDER BY data_barang.nama_barang ASC
      ");

        return $query->result_array();
    }

    // Menampilkan data barang modem pusat
    public function dataBarangModemPusat()
    {
        $query   = $this->db->query("SELECT 
          data_barang.id_barang, data_barang.kode_barang, data_barang.nama_barang, 
          data_barang.satuan, data_barang.keterangan, data_barang.tanggal, data_barang.jumlah, 
          SUM(data_barang_mutasi.jumlah) AS jumlahMutasi
          
          FROM data_barang
          LEFT JOIN data_barang_mutasi ON data_barang.id_barang = data_barang_mutasi.id_barang
    
          WHERE data_barang.keterangan = 'Modem' 
    
          GROUP BY data_barang.nama_barang
          ORDER BY data_barang.nama_barang ASC
          ");

        return $query->result_array();
    }

    // Menampilkan data barang restock
    public function dataBarangRestock($tanggalAwal, $tanggalAkhir)
    {
        $query   = $this->db->query("SELECT id_barang_restock, nama_barang, tanggal, jumlah
          
          FROM data_barang_restock
          WHERE tanggal BETWEEN '$tanggalAwal' AND '$tanggalAkhir'

          ORDER BY id_barang_restock DESC
          ");

        return $query->result_array();
    }

    // Menampilkan UOM
    public function dataSatuan()
    {
        $query   = $this->db->query("SELECT 
      id_satuan, nama_satuan
      
      FROM data_satuan

      ORDER BY nama_satuan ASC
      ");

        return $query->result_array();
    }

    //  Kode Barang
    public function getKodeBarang($table = null, $field = null)
    {
        $this->db->select_max($field);
        return $this->db->get($table)->row_array()[$field];
    }

    // Check Nama Customer
    public function checkCustomer($id_customer)
    {
        $this->db->select('id_customer, pembelian_paket, nama_customer');
        $this->db->where('id_customer', $id_customer);

        $this->db->limit(1);
        $result = $this->db->get('data_customer');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check Nama Barang Duplicate
    public function checkDuplicateBarangPusat($nama_barang)
    {
        $this->db->select('id_barang, kode_barang, nama_barang, satuan, tanggal, jumlah');
        $this->db->where('nama_barang', $nama_barang);

        $this->db->limit(1);
        $result = $this->db->get('data_barang');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check SN Duplicate
    public function checkDuplicateSN($id_barang, $SN)
    {
        $this->db->select('id_barang_mutasi, id_barang, SN, id_customer, kode_mutasi, tanggal, jumlah, keterangan');
        $this->db->where('id_barang', $id_barang);
        $this->db->where('SN', $SN);

        $this->db->limit(1);
        $result = $this->db->get('data_barang_mutasi');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check Stock Barang Duplicate
    public function checkStockBarangPusat($id_barang)
    {
        $this->db->select('id_barang, kode_barang, nama_barang, satuan, tanggal, jumlah');
        $this->db->where('id_barang', $id_barang);

        $this->db->limit(1);
        $result = $this->db->get('data_barang');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check Stock Barang Mutasi
    public function checkStockBarangMutasi($id_barang_mutasi)
    {
        $this->db->select('data_barang_mutasi.id_barang_mutasi, data_barang_mutasi.id_barang, data_barang_mutasi.SN, data_barang_mutasi.id_customer, 
        data_barang_mutasi.kode_mutasi, data_barang_mutasi.tanggal, data_barang_mutasi.jumlah, data_barang_mutasi.keterangan, data_barang.jumlah AS jumlahBarang');
        $this->db->join('data_barang', 'data_barang_mutasi.id_barang = data_barang.id_barang', 'left');
        $this->db->where('data_barang_mutasi.id_barang_mutasi', $id_barang_mutasi);

        $this->db->limit(1);
        $result = $this->db->get('data_barang_mutasi');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check SN Customer
    public function checkSNCustomer($id_barang_mutasi)
    {
        $this->db->select('data_barang_mutasi.id_barang_mutasi, data_barang_mutasi.id_barang, 
        data_barang_mutasi.SN, data_barang_mutasi.id_customer, data_barang_mutasi.kode_mutasi, 
        data_barang_mutasi.tanggal, data_barang_mutasi.jumlah, data_barang_mutasi.keterangan,
        data_barang.jumlah AS jumlahBarang');
        $this->db->join('data_barang', 'data_barang_mutasi.id_barang = data_barang.id_barang', 'left');
        $this->db->where('id_barang_mutasi', $id_barang_mutasi);

        $this->db->limit(1);
        $result = $this->db->get('data_barang_mutasi');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check Pengembalian Barang
    public function checkPengembalianBarang($id_peminjaman_barang)
    {
        $this->db->select('data_peminjaman_barang.id_peminjaman_barang, data_peminjaman_barang.id_barang, data_peminjaman_barang.id_pegawai, 
        data_peminjaman_barang.kode_peminjaman_barang, data_peminjaman_barang.tanggal, data_peminjaman_barang.jumlah, data_peminjaman_barang.id_status, 
        data_peminjaman_barang.keterangan, data_barang.nama_barang, data_barang.jumlah AS jumlahBarang, data_pegawai.nama_pegawai, data_status.nama_status');
        $this->db->join('data_barang', 'data_peminjaman_barang.id_barang = data_barang.id_barang', 'left');
        $this->db->join('data_pegawai', 'data_peminjaman_barang.id_pegawai = data_pegawai.id_pegawai', 'left');
        $this->db->join('data_status', 'data_peminjaman_barang.id_status = data_status.id_status', 'left');
        $this->db->where('data_peminjaman_barang.id_peminjaman_barang', $id_peminjaman_barang);

        $this->db->limit(1);
        $result = $this->db->get('data_peminjaman_barang');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Menampilkan data barang mutasi pusat
    public function dataBarangMutasiPusat($tanggalAwal, $tanggalAkhir)
    {
        $query   = $this->db->query("SELECT data_barang_mutasi.id_barang_mutasi, data_barang_mutasi.id_barang, data_barang_mutasi.SN, 
        data_barang_mutasi.id_customer, data_barang_mutasi.kode_mutasi, data_barang_mutasi.tanggal, 
        data_barang_mutasi.jumlah, data_barang_mutasi.keterangan, data_barang.nama_barang, data_barang.satuan
        FROM data_barang_mutasi
        LEFT JOIN data_barang ON data_barang_mutasi.id_barang = data_barang.id_barang
        WHERE data_barang_mutasi.SN IS NULL AND 
        data_barang_mutasi.tanggal BETWEEN '$tanggalAwal' AND '$tanggalAkhir'
        
        ORDER BY data_barang_mutasi.id_barang_mutasi DESC
          ");

        return $query->result_array();
    }

    // Menampilkan data barang mutasi modem pusat
    public function dataBarangMutasiModemPusat($tanggalAwal, $tanggalAkhir)
    {
        $query   = $this->db->query("SELECT data_barang_mutasi.id_barang_mutasi, data_barang_mutasi.id_barang, data_barang_mutasi.SN, 
            data_barang_mutasi.id_customer, data_barang_mutasi.kode_mutasi, data_barang_mutasi.tanggal, 
            data_barang_mutasi.jumlah, data_barang_mutasi.keterangan, data_barang.nama_barang, data_barang.satuan
            FROM data_barang_mutasi
            LEFT JOIN data_barang ON data_barang_mutasi.id_barang = data_barang.id_barang
            WHERE data_barang_mutasi.SN IS NOT NULL AND 
            data_barang_mutasi.tanggal BETWEEN '$tanggalAwal' AND '$tanggalAkhir'
            
            ORDER BY data_barang_mutasi.id_barang_mutasi DESC
              ");

        return $query->result_array();
    }

    // Menampilkan data peminjaman barang
    public function dataPeminjamanBarang($day)
    {
        $query   = $this->db->query("SELECT data_peminjaman_barang.id_peminjaman_barang, data_peminjaman_barang.id_barang, data_peminjaman_barang.id_pegawai, 
        data_peminjaman_barang.kode_peminjaman_barang, data_peminjaman_barang.tanggal, data_peminjaman_barang.jumlah, data_peminjaman_barang.id_status, 
        data_peminjaman_barang.keterangan, data_barang.nama_barang, data_pegawai.nama_pegawai, data_status.nama_status

        FROM data_peminjaman_barang
        LEFT JOIN data_barang ON data_peminjaman_barang.id_barang = data_barang.id_barang
        LEFT JOIN data_pegawai ON data_peminjaman_barang.id_pegawai = data_pegawai.id_pegawai
        LEFT JOIN data_status ON data_peminjaman_barang.id_status = data_status.id_status
        
        WHERE data_peminjaman_barang.tanggal = '$day'
        
        ORDER BY data_peminjaman_barang.id_peminjaman_barang DESC
        ");

        return $query->result_array();
    }

    // Menampilkan data peminjman yang pending
    public function peminjamanBarangPending()
    {
        $query   = $this->db->query("SELECT data_peminjaman_barang.id_peminjaman_barang, data_peminjaman_barang.id_barang, data_peminjaman_barang.id_pegawai, 
        data_peminjaman_barang.kode_peminjaman_barang, data_peminjaman_barang.tanggal, data_peminjaman_barang.jumlah, data_peminjaman_barang.id_status, 
        data_peminjaman_barang.keterangan, data_barang.nama_barang, data_pegawai.nama_pegawai, data_status.nama_status

        FROM data_peminjaman_barang
        LEFT JOIN data_barang ON data_peminjaman_barang.id_barang = data_barang.id_barang
        LEFT JOIN data_pegawai ON data_peminjaman_barang.id_pegawai = data_pegawai.id_pegawai
        LEFT JOIN data_status ON data_peminjaman_barang.id_status = data_status.id_status
        
        WHERE data_peminjaman_barang.id_status = '1'
        
        ORDER BY data_peminjaman_barang.id_peminjaman_barang DESC
        ");

        return $query->result_array();
    }

    // Menampilkan data peminjaman barang pegawai
    public function dataPeminjamanBarangPegawai($day)
    {
        $query   = $this->db->query("SELECT bukti_barang_peminjaman.id_bukti_barang_peminjaman, bukti_barang_peminjaman.id_pegawai, 
        bukti_barang_peminjaman.foto_peminjaman1, bukti_barang_peminjaman.foto_peminjaman2, 
        bukti_barang_peminjaman.foto_pengembalian1, bukti_barang_peminjaman.foto_pengembalian2, 
        bukti_barang_peminjaman.tanggal_pengembalian, bukti_barang_peminjaman.tanggal_peminjaman, data_pegawai.nama_pegawai

        FROM bukti_barang_peminjaman 
        LEFT JOIN data_pegawai ON bukti_barang_peminjaman.id_pegawai = data_pegawai.id_pegawai
        
        WHERE tanggal_peminjaman = '$day'
        
        ORDER BY bukti_barang_peminjaman.id_bukti_barang_peminjaman DESC
            ");

        return $query->result_array();
    }
}
