<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('log_admin'))) {
            $this->session->set_flashdata('toastr-eror', 'Anda Belum Login');
            redirect('auth', 'refresh');
        }

        $this->db->where('id', $this->session->userdata('id'));
        $this->dt_admin = $this->db->get('tb_admin')->row();

        $this->load->model('M_admin', 'admin');
    }

    public function index()
    {
        $data = [
            'title'   => 'Dashboard Admin',
            'navbar'  => 'admin/navbar',
            'page'    => 'admin/dashboard',
            'setting' => $this->admin->getSetting(),
            'jabatan' => $this->admin->getCountJabatan(),
            'pegawaiAktif' => $this->admin->getCountPegawai(1),
            'pegawaiTidakAktif' => $this->admin->getCountPegawai(0)
        ];

        $this->load->view('index', $data);
    }
}

/* End of file Home.php */
