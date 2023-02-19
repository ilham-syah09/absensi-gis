<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{

    public function getAllUser()
    {
        return $this->db->get('tb_user')->result();
    }
}

/* End of file M_admin.php */
