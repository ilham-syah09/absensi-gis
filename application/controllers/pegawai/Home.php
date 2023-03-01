<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('log_pegawai'))) {
			$this->session->set_flashdata('toastr-eror', 'Anda Belum Login');
			redirect('auth', 'refresh');
		}

		$this->db->where('id', $this->session->userdata('id'));
		$this->dt_pegawai = $this->db->get('pegawai')->row();

		$this->load->model('M_pegawai', 'pegawai');
	}

	public function index()
	{
		$data = [
			'title'   => 'Dashboard Pegawai',
			'navbar'  => 'pegawai/navbar',
			'page'    => 'pegawai/dashboard',
			'setting' => $this->pegawai->getSetting(),
			'presensiHariIni' => $this->pegawai->getPresensi([
				'idPegawai' => $this->dt_pegawai->id,
				'tanggal'   => date('Y-m-d'),
			]),
		];

		$this->load->view('index', $data);
	}
}

/* End of file Home.php */
