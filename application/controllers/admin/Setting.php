<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
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
			'title'   => 'Setting Presensi',
			'navbar'  => 'admin/navbar',
			'page'    => 'admin/setting',
			'setting' => $this->admin->getSetting(),
		];

		$this->load->view('index', $data);
	}

	public function edit()
	{
		$data = [
			'jamMasuk'     => $this->input->post('jamMasuk'),
			'jamPulang'    => $this->input->post('jamPulang'),
			'lintangBujur' => $this->input->post('lintangBujur'),
			'jarak'        => $this->input->post('jarak')
		];

		$this->db->where('id', $this->input->post('id_setting'));
		$update = $this->db->update('setting', $data);

		if ($update) {
			$this->session->set_flashdata('toastr-sukses', 'Data berhasil diedit');
		} else {
			$this->session->set_flashdata('toastr-eror', 'Data gagal diedit');
		}

		redirect('admin/setting', 'refresh');
	}
}

/* End of file Setting.php */
