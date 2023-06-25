<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekap extends CI_Controller
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
			'title'   => 'Rekap Bulanan',
			'navbar'  => 'admin/navbar',
			'page'    => 'admin/rekap',
			'tahun'   => $this->admin->getTahun(),
			'pegawai' => $this->admin->getPegawai(),
			'th_ini'  => $th_ini,
			'bln_ini' => $bln_ini
		];

		$this->load->view('index', $data);
	}

	public function list($th, $bln, $id)
	{
		$this->db->where('id', $id);
		$pegawai = $this->db->get('pegawai')->row();

		$data = [
			'title'   => 'List Rekap Bulanan Pegawai',
			'navbar'  => 'admin/navbar',
			'page'    => 'admin/list_rekap',
			'pegawai' => $pegawai,
			'setting' => $this->admin->getSetting(),
			'rekap'   => $this->admin->getRekapBulanan($th, $bln, $id),
			'th'      => $th,
			'bln'     => $bln
		];

		$this->load->view('index', $data);
	}

	public function detail($id)
	{
		$data = [
			'title'    => 'Detail Presensi Pegawai',
			'navbar'   => 'admin/navbar',
			'page'     => 'admin/detail_presensi',
			'setting'  => $this->admin->getSetting(),
			'presensi' => $this->admin->getDetailPresensi($id),
		];

		$this->load->view('index', $data);
	}
}

/* End of file Rekap.php */
