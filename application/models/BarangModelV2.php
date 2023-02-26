<?php

class BarangModelV2 extends CI_Model
{
    // Menampilkan data pegawai
    public function dataPegawai()
    {
        $query   = $this->db->query("SELECT id_pegawai, NIK, nama_pegawai, no_telpon,
          alamat_pegawai, pendidikan_pegawai, jabatan, tanggal_masuk, gaji, photo
          
          FROM data_pegawai
          
          ORDER BY nama_pegawai ASC
          ");

        return $query->result_array();
    }

    // Menampilkan data stock barang Engineer
    public function data_StockBarangEngineer()
    {
        $query   = $this->db->query("SELECT data_stockbarang.jumlah_stockBarang, data_stockbarang.id_stockBarang, data_stockbarang.id_barang, 
                    data_stockbarang.jumlah_stockMutasi, data_stockbarang.jumlah_stockBarang, 
                    data_stockbarang.tanggal_restock, data_stockbarang.tanggal_mutasi,
                    data_namabarang.nama_barang, COUNT(data_stockrincian.id_stockRincian) As jumlahRincian, data_stockrincian.tanggal
            
                    FROM data_stockbarang
            
                    LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
                    LEFT JOIN data_stockrincian ON data_stockbarang.id_stockBarang = data_stockrincian.id_stockBarang
            
                    WHERE data_namabarang.id_peralatan = 5
            
                    GROUP BY data_namabarang.nama_barang
                    ORDER BY data_namabarang.nama_barang, data_stockrincian.tanggal DESC
                         ");

        return $query->result_array();
    }

    // Menampilkan data stock barang pelanggan
    public function data_StockBarangPelanggan()
    {
        $query   = $this->db->query("SELECT data_stockbarang.jumlah_stockBarang, data_stockbarang.id_stockBarang, data_stockbarang.id_barang, 
                    data_stockbarang.jumlah_stockMutasi, data_stockbarang.jumlah_stockBarang, 
                    data_stockbarang.tanggal_restock, data_stockbarang.tanggal_mutasi,
                    data_namabarang.nama_barang, COUNT(data_stockrincian.id_stockRincian) As jumlahRincian, data_stockrincian.tanggal
            
                    FROM data_stockbarang
            
                    LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
                    LEFT JOIN data_stockrincian ON data_stockbarang.id_stockBarang = data_stockrincian.id_stockBarang
            
                    WHERE data_namabarang.id_peralatan = 4
            
                    GROUP BY data_namabarang.nama_barang
                    ORDER BY data_namabarang.nama_barang, data_stockrincian.tanggal DESC
                         ");

        return $query->result_array();
    }

    // Menampilkan data stock barang modem
    public function data_StockBarangModem()
    {
        $query   = $this->db->query("SELECT data_stockbarang.jumlah_stockBarang, data_stockbarang.id_stockBarang, data_stockbarang.id_barang, 
                    data_stockbarang.jumlah_stockMutasi, data_stockbarang.jumlah_stockBarang, 
                    data_stockbarang.tanggal_restock, data_stockbarang.tanggal_mutasi,
                    data_namabarang.nama_barang, COUNT(data_stockrincian.id_stockRincian) As jumlahRincian, data_stockrincian.tanggal
            
                    FROM data_stockbarang
            
                    LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
                    LEFT JOIN data_stockrincian ON data_stockbarang.id_stockBarang = data_stockrincian.id_stockBarang
            
                    WHERE data_namabarang.id_peralatan = 3 
            
                    GROUP BY data_namabarang.nama_barang
                    ORDER BY data_namabarang.nama_barang, data_stockrincian.tanggal DESC
                         ");

        return $query->result_array();
    }

    // Menampilkan data stock barang kantor
    public function data_StockBarangKantor()
    {
        $query   = $this->db->query("SELECT data_stockbarang.jumlah_stockBarang, data_stockbarang.id_stockBarang, data_stockbarang.id_barang, 
                data_stockbarang.jumlah_stockMutasi, data_stockbarang.jumlah_stockBarang, 
                data_stockbarang.tanggal_restock, data_stockbarang.tanggal_mutasi,
                data_namabarang.nama_barang, COUNT(data_stockrincian.id_stockRincian) As jumlahRincian, data_stockrincian.tanggal
        
                FROM data_stockbarang
        
                LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
                LEFT JOIN data_stockrincian ON data_stockbarang.id_stockBarang = data_stockrincian.id_stockBarang
        
                WHERE data_namabarang.id_peralatan = 1
        
                GROUP BY data_namabarang.nama_barang
                ORDER BY data_namabarang.nama_barang, data_stockrincian.tanggal DESC
                     ");

        return $query->result_array();
    }

    // Menampilkan data stock barang ATK
    public function data_StockBarangATK()
    {
        $query   = $this->db->query("SELECT data_stockbarang.jumlah_stockBarang, data_stockbarang.id_stockBarang, data_stockbarang.id_barang, 
            data_stockbarang.jumlah_stockMutasi, data_stockbarang.jumlah_stockBarang, 
            data_stockbarang.tanggal_restock, data_stockbarang.tanggal_mutasi,
            data_namabarang.nama_barang, COUNT(data_stockrincian.id_stockRincian) As jumlahRincian, data_stockrincian.tanggal
    
            FROM data_stockbarang
    
            LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
            LEFT JOIN data_stockrincian ON data_stockbarang.id_stockBarang = data_stockrincian.id_stockBarang
    
            WHERE data_namabarang.id_peralatan = 2
    
            GROUP BY data_namabarang.nama_barang
            ORDER BY data_namabarang.nama_barang, data_stockrincian.tanggal DESC
                 ");

        return $query->result_array();
    }

    // Menampilkan data stock barang
    public function data_StockBarang()
    {
        $query   = $this->db->query("SELECT data_stockbarang.jumlah_stockBarang, data_stockbarang.id_stockBarang, data_stockbarang.id_barang, 
        data_stockbarang.jumlah_stockMutasi, data_stockbarang.jumlah_stockBarang, 
        data_stockbarang.tanggal_restock, data_stockbarang.tanggal_mutasi,
        data_namabarang.nama_barang, COUNT(data_stockrincian.id_stockRincian) As jumlahRincian, data_stockrincian.tanggal

        FROM data_stockbarang

        LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
        LEFT JOIN data_stockrincian ON data_stockbarang.id_stockBarang = data_stockrincian.id_stockBarang

        WHERE data_namabarang.id_peralatan != 4

        GROUP BY data_namabarang.nama_barang
        ORDER BY data_namabarang.nama_barang, data_stockrincian.tanggal DESC
             ");

        return $query->result_array();
    }

    // Menampilkan data detail barang
    public function data_StockRincian()
    {
        $query   = $this->db->query("SELECT data_stockrincian.id_stockRincian, data_stockrincian.kode_barang, 
        data_stockrincian.id_stockBarang, data_stockrincian.jumlah, data_stockrincian.tanggal, data_stockrincian.id_status, 
        data_stockrincian.id_pegawai, data_namabarang.nama_barang, data_status.nama_status, data_pegawai.nama_pegawai, 
        data_keadaanbarang.nama_keadaan

        FROM data_stockrincian
        
        LEFT JOIN data_stockbarang ON data_stockrincian.id_stockBarang = data_stockbarang.id_stockBarang
        LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
        LEFT JOIN data_status ON data_stockrincian.id_status = data_status.id_status
        LEFT JOIN data_pegawai ON data_stockrincian.id_pegawai = data_pegawai.id_pegawai
        LEFT JOIN data_keadaanbarang ON data_stockrincian.id_keadaanbarang = data_keadaanbarang.id_keadaanbarang

        WHERE data_namabarang.id_peralatan != 3
        
        ORDER BY data_namabarang.nama_barang ASC
        ");

        return $query->result_array();
    }

    // Menampilkan data aktivasi
    public function data_aktivasi()
    {
        $query   = $this->db->query("SELECT data_aktivasi.id_aktivasi, data_aktivasi.kode_barang, 
            data_aktivasi.id_stockBarang, data_aktivasi.jumlah_modem, data_aktivasi.PCK_jumlah, data_aktivasi.PCH_jumlah, 
            data_aktivasi.tanggal, data_aktivasi.id_status, 
            data_aktivasi.id_pegawai, data_namabarang.nama_barang, data_status.nama_status, data_pegawai.nama_pegawai, 
            data_customer.nama_customer, data_keadaanbarang.nama_keadaan
    
            FROM data_aktivasi
            
            LEFT JOIN data_stockbarang ON data_aktivasi.id_stockBarang = data_stockbarang.id_stockBarang
            LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
            LEFT JOIN data_status ON data_aktivasi.id_status = data_status.id_status
            LEFT JOIN data_pegawai ON data_aktivasi.id_pegawai = data_pegawai.id_pegawai
            LEFT JOIN data_customer ON data_aktivasi.id_customer = data_customer.id_customer
            LEFT JOIN data_keadaanbarang ON data_aktivasi.id_keadaanbarang = data_keadaanbarang.id_keadaanbarang

            WHERE data_namabarang.id_peralatan = 3

            ORDER BY data_namabarang.nama_barang ASC
            
                     ");

        return $query->result_array();
    }

    // Menampilkan data detail barang modem
    public function data_StockRincianModem()
    {
        $query   = $this->db->query("SELECT data_stockrincian.id_stockRincian, data_stockrincian.kode_barang, 
            data_stockrincian.id_stockBarang, data_stockrincian.jumlah, data_stockrincian.tanggal, data_stockrincian.id_status, 
            data_stockrincian.id_pegawai, data_namabarang.nama_barang, data_status.nama_status, data_pegawai.nama_pegawai, 
            data_customer.nama_customer, data_keadaanbarang.nama_keadaan
    
            FROM data_stockrincian
            
            LEFT JOIN data_stockbarang ON data_stockrincian.id_stockBarang = data_stockbarang.id_stockBarang
            LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
            LEFT JOIN data_status ON data_stockrincian.id_status = data_status.id_status
            LEFT JOIN data_pegawai ON data_stockrincian.id_pegawai = data_pegawai.id_pegawai
            LEFT JOIN data_customer ON data_stockrincian.id_customer = data_customer.id_customer
            LEFT JOIN data_keadaanbarang ON data_stockrincian.id_keadaanbarang = data_keadaanbarang.id_keadaanbarang

            WHERE data_namabarang.id_peralatan = 3

            ORDER BY data_namabarang.nama_barang ASC
            
                     ");

        return $query->result_array();
    }

    // Menampilkan data nama barang
    public function data_NamaBarang()
    {
        $query   = $this->db->query("SELECT data_namabarang.id_barang, data_namabarang.nama_barang, 
        data_namabarang.id_satuan, data_satuan.id_satuan, data_satuan.nama_satuan, data_peralatan.kategori_peralatan
        FROM data_namabarang

         INNER JOIN data_satuan ON data_namabarang.id_satuan = data_satuan.id_satuan
         INNER JOIN data_peralatan ON data_namabarang.id_peralatan = data_peralatan.id_peralatan

         WHERE data_namabarang.nama_barang != 'Ongkir' AND data_namabarang.nama_barang != 'Biaya Penanganan'
         AND data_namabarang.nama_barang != 'Biaya Layanan'
         ");

        return $query->result_array();
    }

    // Menampilkan data barang mutasi
    public function data_BarangMutasi()
    {
        $query   = $this->db->query("SELECT data_stockkeluar.id_stockKeluar, data_stockkeluar.id_stockBarang, 
        data_stockkeluar.jumlah, data_stockkeluar.tanggal, data_stockkeluar.id_pegawai, 
        data_stockkeluar.id_status, data_stockkeluar.keterangan, data_namabarang.nama_barang, data_pegawai.nama_pegawai, data_status.nama_status

        FROM data_stockkeluar
        LEFT JOIN data_stockbarang ON data_stockkeluar.id_stockBarang = data_stockbarang.id_stockBarang
        LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
        LEFT JOIN data_pegawai ON data_stockkeluar.id_pegawai = data_pegawai.id_pegawai
        LEFT JOIN data_status ON data_stockkeluar.id_status = data_status.id_status
        
        ORDER BY data_stockkeluar.id_stockKeluar DESC
             ");

        return $query->result_array();
    }

    // Menampilkan data barang masuk
    public function data_BarangMasuk()
    {
        $query   = $this->db->query("SELECT data_stockmasuk.id_stockMasuk, data_stockmasuk.nama_barang, 
        data_stockmasuk.jumlah, data_stockmasuk.tanggal, data_stockmasuk.id_pegawai, data_stockmasuk.kode_barang, 
        data_stockmasuk.id_status, data_stockmasuk.keterangan, data_namabarang.nama_barang, data_pegawai.nama_pegawai, data_status.nama_status

        FROM data_stockmasuk
        LEFT JOIN data_namabarang ON data_stockmasuk.nama_barang = data_namabarang.nama_barang
        LEFT JOIN data_pegawai ON data_stockmasuk.id_pegawai = data_pegawai.id_pegawai
        LEFT JOIN data_status ON data_stockmasuk.id_status = data_status.id_status
        
        ORDER BY data_stockmasuk.id_stockMasuk DESC
                ");

        return $query->result_array();
    }

    // Menampilkan data nama barang status Stock
    public function data_NamaBarangStock($id)
    {
        $query   = $this->db->query("SELECT data_stockbarang.id_stockBarang, data_stockbarang.id_barang, 
            data_stockbarang.jumlah_stockBarang, data_namabarang.namaBarang

            FROM data_stockbarang
    
            INNER JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang

            WHERE data_stockbarang.id_barang = '$id'");

        return $query->result_array();
    }

    // Check Nama Barang Duplicate dengan nama
    public function checkDuplicateNamaBarang($nama_barang)
    {
        $this->db->select('id_barang, nama_barang');
        $this->db->where('nama_barang', $nama_barang);

        $this->db->limit(1);
        $result = $this->db->get('data_namabarang');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check Nama Barang
    public function checkNamaBarang($id_barang)
    {
        $this->db->select('id_barang, nama_barang');
        $this->db->where('id_barang', $id_barang);

        $this->db->limit(1);
        $result = $this->db->get('data_namabarang');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check Nama Barang Duplicate dengan id
    public function checkDuplicateStockBarang($id_barang)
    {
        $this->db->select('id_stockBarang, id_barang, jumlah_stockMutasi, jumlah_stockBarang');
        $this->db->where('id_barang', $id_barang);

        $this->db->limit(1);
        $result = $this->db->get('data_stockbarang');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check data stock barang
    public function checkStockBarang($id_stockBarang)
    {
        $this->db->select('id_stockBarang, id_barang, jumlah_stockMutasi, jumlah_stockBarang');
        $this->db->where('id_stockBarang', $id_stockBarang);

        $this->db->limit(1);
        $result = $this->db->get('data_stockbarang');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check Stock Rincian
    public function checkStockKeluar($id_stockKeluar)
    {
        $this->db->select('id_stockKeluar, id_stockBarang, kode_barang, jumlah, tanggal, id_pegawai, id_status');
        $this->db->where('id_stockKeluar', $id_stockKeluar);

        $this->db->limit(1);
        $result = $this->db->get('data_stockkeluar');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check Stock Rincian
    public function checkStockDetailRincian($id_stockRincian)
    {
        $this->db->select('id_stockRincian, kode_barang, id_stockBarang, jumlah, tanggal, id_status, id_pegawai');
        $this->db->where('id_stockRincian', $id_stockRincian);

        $this->db->limit(1);
        $result = $this->db->get('data_stockrincian');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check Stock Rincian
    public function checkStockRincian($id_stockBarang)
    {
        $this->db->select('id_stockRincian, kode_barang, id_stockBarang, jumlah, tanggal, id_status, id_pegawai');
        $this->db->where('id_stockBarang', $id_stockBarang);

        $this->db->limit(1);
        $result = $this->db->get('data_stockrincian');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check Stock Rincian
    public function checkStockRincianBarang($id_stockBarang)
    {
        $this->db->select('id_stockRincian, kode_barang, id_stockBarang, jumlah, tanggal, id_status, id_pegawai');
        $this->db->where('id_stockBarang', $id_stockBarang);
        $this->db->where('id_status', 12);
        $this->db->where('id_keadaanbarang', 2);

        $this->db->limit(1);
        $result = $this->db->get('data_stockrincian');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check data aktivasi kode
    public function checkDataAktivasi($kode_barang)
    {
        $this->db->select('data_aktivasi.id_aktivasi, data_aktivasi.kode_barang, data_aktivasi.id_stockBarang, data_aktivasi.jumlah_modem, data_aktivasi.PCK_jumlah,
                            data_aktivasi.PCH_jumlah, data_aktivasi.tanggal, data_aktivasi.id_customer, data_namabarang.nama_barang');
        $this->db->join('data_stockbarang', 'data_aktivasi.id_stockBarang = data_stockbarang.id_stockBarang', 'left');
        $this->db->join('data_namabarang', 'data_stockbarang.id_barang = data_namabarang.id_barang', 'left');

        $this->db->where('data_aktivasi.kode_barang', $kode_barang);

        $result = $this->db->get('data_aktivasi');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check data aktivasi id stock barang
    public function checkDataAktivasiStockBarang($id_stockBarang)
    {
        $this->db->select('data_aktivasi.id_aktivasi, data_aktivasi.kode_barang, data_aktivasi.id_stockBarang, data_aktivasi.jumlah_modem, data_aktivasi.PCK_jumlah,
                              data_aktivasi.PCH_jumlah, data_aktivasi.tanggal, data_aktivasi.id_customer, data_namabarang.nama_barang');
        $this->db->join('data_stockbarang', 'data_aktivasi.id_stockBarang = data_stockbarang.id_stockBarang', 'left');
        $this->db->join('data_namabarang', 'data_stockbarang.id_barang = data_namabarang.id_barang', 'left');

        $this->db->where('data_aktivasi.id_stockBarang', $id_stockBarang);
        $this->db->where('data_aktivasi.id_customer', null);
        $this->db->where('data_aktivasi.id_keadaanbarang', 2);

        $result = $this->db->get('data_aktivasi');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Check Nama Barang Duplicate SN Modem
    public function checkDuplicateSNModem($kode_barang)
    {
        $this->db->select('data_stockrincian.id_stockRincian, data_stockrincian.kode_barang, data_stockrincian.id_stockBarang, data_stockrincian.jumlah, data_stockrincian.tanggal, data_stockrincian.id_status, data_stockrincian.id_pegawai, data_stockrincian.id_customer, data_stockrincian.id_keadaanbarang, data_namabarang.nama_barang');
        $this->db->join('data_stockbarang', 'data_stockrincian.id_stockBarang = data_stockbarang.id_stockBarang', 'left');
        $this->db->join('data_namabarang', 'data_stockbarang.id_barang = data_namabarang.id_barang', 'left');

        $this->db->where('data_stockrincian.kode_barang', $kode_barang);

        $result = $this->db->get('data_stockrincian');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Menampilkan data keadaan barang
    public function dataKeadaanBarang()
    {
        $query   = $this->db->query("SELECT 
          id_keadaanbarang, nama_keadaan
          
          FROM data_keadaanbarang
    
          ORDER BY nama_keadaan ASC
          ");

        return $query->result_array();
    }

    // Menampilkan data status
    public function dataStatus()
    {
        $query   = $this->db->query("SELECT 
          id_status, nama_status
          
          FROM data_status
    
          ORDER BY nama_status ASC
          ");

        return $query->result_array();
    }

    public function kodeBarang()
    {
        $sql = "SELECT MAX(MID(kode_barang,8,4)) AS invoiceID 
        FROM data_stockrincian
        WHERE MID(kode_barang,4,4) = DATE_FORMAT(CURDATE(), '%y%m')";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $dataRow    = $query->row();
            $dataN      = ((int)$dataRow->invoiceID) + 1;
            $no         = sprintf("%'.04d", $dataN);
        } else {
            $no         = "0001";
        }

        $invoice = "IN7".date('ym').$no;
        return $invoice;
    }

    // Check Stock Rincian
    public function getKodeBarang($id_barang)
    {
        $this->db->select('data_stockrincian.id_stockRincian, data_stockrincian.kode_barang, 
        data_stockrincian.id_stockBarang, data_stockrincian.jumlah, data_stockrincian.tanggal, 
        data_stockrincian.id_status, data_stockrincian.id_pegawai, data_stockrincian.id_keadaanbarang, 
        data_stockbarang.jumlah_stockBarang');

        $this->db->join('data_stockbarang', 'data_stockrincian.id_stockBarang = data_stockbarang.id_stockBarang', 'left');

        $this->db->where('data_stockbarang.id_barang', $id_barang);
        $this->db->where('data_stockrincian.id_status', 12);
        $this->db->where('data_stockrincian.id_keadaanbarang !=', 1);

        $this->db->order_by('data_stockrincian.id_stockRincian', 'DESC');
        $this->db->limit(1);
        $result = $this->db->get('data_stockrincian');

        return $result->row();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    // Menampilkan data peminjaman barang
    public function dataPeminjamanBarang($day)
    {
        $query   = $this->db->query("SELECT data_peminjaman_barang.id_peminjaman_barang, data_peminjaman_barang.id_stockBarang, 
        data_peminjaman_barang.id_pegawai, data_peminjaman_barang.kode_peminjaman_barang, 
        data_peminjaman_barang.tanggal, data_peminjaman_barang.jumlah, data_peminjaman_barang.id_status, 
        data_peminjaman_barang.keterangan, data_namabarang.nama_barang, data_pegawai.nama_pegawai

        FROM data_peminjaman_barang
        
        LEFT JOIN data_stockbarang ON data_peminjaman_barang.id_stockBarang = data_stockbarang.id_stockBarang
        LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
        LEFT JOIN data_pegawai ON data_peminjaman_barang.id_pegawai = data_pegawai.id_pegawai
        LEFT JOIN data_status ON data_peminjaman_barang.id_status = data_status.id_status
        
        WHERE data_peminjaman_barang.tanggal = '$day'
        
        ORDER BY data_peminjaman_barang.id_peminjaman_barang DESC
        
            ");

        return $query->result_array();
    }

    // Check Pengembalian Barang
    public function checkPengembalianBarang($id_peminjaman_barang)
    {
        $this->db->select('data_peminjaman_barang.id_peminjaman_barang, data_peminjaman_barang.id_stockBarang, data_peminjaman_barang.kode_barang, data_peminjaman_barang.id_pegawai, 
            data_peminjaman_barang.kode_peminjaman_barang, data_peminjaman_barang.tanggal, data_peminjaman_barang.jumlah, data_peminjaman_barang.id_status, 
            data_peminjaman_barang.keterangan, data_namabarang.nama_barang, data_stockbarang.jumlah_stockBarang AS jumlahBarangStock, data_stockbarang.jumlah_stockMutasi AS jumlahBarangMutasi, 
            data_pegawai.nama_pegawai, data_status.nama_status');

        $this->db->join('data_stockbarang', 'data_peminjaman_barang.id_stockBarang = data_stockbarang.id_stockBarang', 'left');
        $this->db->join('data_namabarang', 'data_stockbarang.id_barang = data_namabarang.id_barang', 'left');
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

    // Menampilkan data stock barang
    public function dataStockBarang()
    {
        $query   = $this->db->query("SELECT data_stockbarang.id_stockBarang, data_stockbarang.id_barang, 
        data_stockbarang.jumlah_stockBarang, data_stockbarang.jumlah_stockMutasi, data_stockbarang.tanggal_restock, 
        data_stockbarang.tanggal_mutasi, data_namabarang.nama_barang

        FROM data_stockbarang
        
        LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
        
        WHERE data_namabarang.id_peralatan BETWEEN 3 AND 5

        ORDER BY data_namabarang.nama_barang ASC
                ");

        return $query->result_array();
    }

    // Menghitung jumlah barang keluar bulan ini
    public function jumlahBarangKeluar($month)
    {
        $query   = $this->db->query("SELECT id_stockKeluar, tanggal
              FROM data_stockkeluar
              WHERE MONTH(tanggal) = '$month'
              ");

        return $query->num_rows();
    }

    // Menghitung jumlah barang restock bulan ini
    public function jumlahPeminjamanPending($month)
    {
        $query   = $this->db->query("SELECT data_peminjaman_barang.id_peminjaman_barang, data_peminjaman_barang.id_stockBarang, 
        data_peminjaman_barang.id_pegawai, data_peminjaman_barang.kode_peminjaman_barang, 
        data_peminjaman_barang.tanggal, data_peminjaman_barang.jumlah, data_peminjaman_barang.id_status, 
        data_peminjaman_barang.keterangan, data_namabarang.nama_barang, data_pegawai.nama_pegawai

        FROM data_peminjaman_barang
        
        LEFT JOIN data_stockbarang ON data_peminjaman_barang.id_stockBarang = data_stockbarang.id_stockBarang
        LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
        LEFT JOIN data_pegawai ON data_peminjaman_barang.id_pegawai = data_pegawai.id_pegawai
        LEFT JOIN data_status ON data_peminjaman_barang.id_status = data_status.id_status
        
        WHERE MONTH(data_peminjaman_barang.tanggal) = '$month' AND data_peminjaman_barang.id_status = 1
        
        ORDER BY data_peminjaman_barang.id_peminjaman_barang DESC
              ");

        return $query->num_rows();
    }

    // Menghitung jumlah barang restock bulan ini
    public function jumlahBarangMasuk($month)
    {
        $query   = $this->db->query("SELECT id_stockMasuk, tanggal
                  FROM data_stockmasuk
                  WHERE MONTH(tanggal) = '$month'
                  ");

        return $query->num_rows();
    }
    // ==========================================


    // Menghitung jumlah barang
    public function jumlahBarang()
    {
        $query   = $this->db->query("SELECT id_barang, kode_barang, nama_barang,
      satuan, tanggal, jumlah
      FROM data_barang");

        return $query->num_rows();
    }

    // Menampilkan data SN Non Modem
    public function dataSNNonModem()
    {
        $query   = $this->db->query("SELECT data_aktivasi.kode_barang
              
              FROM data_aktivasi
              LEFT JOIN data_stockbarang ON data_aktivasi.id_stockBarang = data_stockbarang.id_stockBarang
              LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang
    
              
              WHERE data_namabarang.id_peralatan = 3 AND data_aktivasi.id_customer IS NOT NULL AND
                data_aktivasi.PCK_jumlah IS NULL OR data_aktivasi.PCH_jumlah IS NULL
                AND data_aktivasi.id_keadaanbarang = 2
              ");

        return $query->result_array();
    }

    // Menampilkan data SN Barang
    public function dataSNBarang($id_barang)
    {
        $query   = $this->db->query("SELECT data_aktivasi.kode_barang
          
          FROM data_aktivasi
          LEFT JOIN data_stockbarang ON data_aktivasi.id_stockBarang = data_stockbarang.id_stockBarang
          LEFT JOIN data_namabarang ON data_stockbarang.id_barang = data_namabarang.id_barang

          
          WHERE data_aktivasi.id_status = 12 AND data_namabarang.id_peralatan = 3 
          AND data_stockbarang.id_barang = '$id_barang' AND data_aktivasi.id_keadaanbarang = 2
          ");

        return $query->result_array();
    }

    // Menampilkan data Customer Edit Rincian
    public function dataCustomerEditRincian()
    {
        $query   = $this->db->query("SELECT id_customer, nama_customer, kode_barang
                  
                  FROM data_customer
    
                  ORDER BY nama_customer ASC
                  ");

        return $query->result_array();
    }

    // Menampilkan data Customer
    public function dataCustomer()
    {
        $query   = $this->db->query("SELECT id_customer, nama_customer, kode_barang
              
              FROM data_customer

              WHERE kode_barang IS NULL
              ORDER BY nama_customer ASC
              ");

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

        return $query->result();
    }

    // Menampilkan Kategori Peralatan
    public function dataKategoriPeralatan()
    {
        $query   = $this->db->query("SELECT 
          id_peralatan, kategori_peralatan
          
          FROM data_peralatan
    
          ORDER BY kategori_peralatan ASC
          ");

        return $query->result();
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
