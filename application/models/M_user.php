<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    public function getBerkas($id)
    {
        $this->db->where('berkas_id', $id);
        return $this->db->get('tb_berkas')->row();
    }

}

/* End of file M_user.php */
