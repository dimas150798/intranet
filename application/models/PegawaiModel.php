<?php


class PegawaiModel extends CI_Model
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

    // Menampilkan data pendidikan pegawai
    public function dataPendidikanPegawai()
    {
        $query   = $this->db->query("SELECT id_pendidikan, nama_pendidikan
      
      FROM data_pendidikan");

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
}
