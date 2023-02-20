<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
    public function getAllUser()
    {
        return $this->db->get('tb_user')->result();
    }

    public function getJabatan()
    {
        $this->db->order_by('namaJabatan', 'asc');

        return $this->db->get('jabatan')->result();
    }

    public function getPegawai()
    {
        $this->db->select('pegawai.*, jabatan.namaJabatan');
        $this->db->join('jabatan', 'jabatan.id = pegawai.idJabatan', 'inner');

        $this->db->order_by('jabatan.namaJabatan, pegawai.nama', 'asc');

        return $this->db->get('pegawai')->result();
    }

    public function getSetting()
    {
        return $this->db->get('setting')->row();
    }
}

/* End of file M_admin.php */
