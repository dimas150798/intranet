<?php

class LoginModel extends CI_Model{
   
   public function cekLogin()
   {

      $username     = set_value('username');
      $password     = set_value('password');

      $this->db->select('id_login, nama_pegawai, username, password, id_akses');
      $this->db->where('username', $username);
      $this->db->where('password', $password);

      $this->db->limit(1);
      $result = $this->db->get('data_login');

      return $result->row();
      if ($result->num_rows() > 0) {
         return $result->row();
      } else {
         return FALSE;
      }

   }
}

?>