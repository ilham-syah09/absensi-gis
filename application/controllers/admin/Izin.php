<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Izin extends CI_Controller
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
		$th_ini = $this->uri->segment(3);
		$bln_ini = $this->uri->segment(4);

		if (!$th_ini) {
			$th_ini = $this->admin->getTahunIni();
		}
		if (!$bln_ini) {
			$bln_ini = $this->admin->getBulanIni($th_ini);
		}

		$data = [
			'title'     => 'Rekap Izin',
			'navbar'    => 'admin/navbar',
			'page'      => 'admin/izin',
			'tahun'     => $this->admin->getTahun(),
			'rekapIzin' => $this->admin->getRekapIzin($th_ini, $bln_ini),
			'th_ini'    => $th_ini,
			'bln_ini'   => $bln_ini
		];

		$this->load->view('index', $data);
	}

	public function list($th, $bln, $id)
	{
		$this->db->where('id', $id);
		$pegawai = $this->db->get('pegawai')->row();

		$data = [
			'title'   => 'List Rekap Izin Pegawai',
			'navbar'  => 'admin/navbar',
			'page'    => 'admin/list_izin',
			'pegawai' => $pegawai,
			'izin'    => $this->admin->getListIzin($th, $bln, $id),
			'th'      => $th,
			'bln'     => $bln
		];

		$this->load->view('index', $data);
	}
}

/* End of file Izin.php */
