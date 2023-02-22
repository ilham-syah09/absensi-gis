<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Presensi extends CI_Controller
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
			'title'           => 'Presensi',
			'navbar'          => 'admin/navbar',
			'page'            => 'admin/presensi',
			'tahun'           => $this->admin->getTahun(),
			'presensiHariIni' => $this->admin->getPresensi(date('Y'), date('m'), date('d')),
			'riwayatPresensi' => $this->admin->getPresensi($th_ini, $bln_ini),
			'th_ini'          => $th_ini,
			'bln_ini'         => $bln_ini
		];

		$this->load->view('index', $data);
	}

	public function list($tanggal)
	{
		$data = [
			'title'    => 'List Presensi Pegawai',
			'navbar'   => 'admin/navbar',
			'page'     => 'admin/list_presensi',
			'setting'  => $this->admin->getSetting(),
			'presensi' => $this->admin->getListPresensi($tanggal),
			'tanggal'  => $tanggal
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

/* End of file Presensi.php */
