<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lembur extends CI_Controller
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
			'title'   => 'Lembur',
			'navbar'  => 'admin/navbar',
			'page'    => 'admin/lembur',
			'pegawai' => $this->admin->getPegawai(),
			'lembur'  => $this->admin->getLembur()
		];

		$this->load->view('index', $data);
	}

	public function add()
	{
		$data = [
			'idPegawai' => $this->input->post('idPegawai'),
			'tanggal'   => $this->input->post('tanggal'),
			'jam'       => $this->input->post('jam')
		];

		$insert = $this->db->insert('lembur', $data);

		if ($insert) {
			$this->session->set_flashdata('toastr-sukses', 'Data berhasil ditambahkan');
		} else {
			$this->session->set_flashdata('toastr-eror', 'Data gagal ditambahkam');
		}

		redirect('admin/lembur', 'refresh');
	}

	public function edit()
	{
		$data = [
			'tanggal'   => $this->input->post('tanggal'),
			'jam'       => $this->input->post('jam')
		];

		$this->db->where('id', $this->input->post('id'));
		$update = $this->db->update('lembur', $data);

		if ($update) {
			$this->session->set_flashdata('toastr-sukses', 'Data berhasil diedit');
		} else {
			$this->session->set_flashdata('toastr-eror', 'Data gagal diedit');
		}

		redirect('admin/lembur', 'refresh');
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('lembur');

		if ($delete) {
			$this->session->set_flashdata('toastr-sukses', 'Data berhasil dihapus');
		} else {
			$this->session->set_flashdata('toastr-eror', 'Data gagal dihapus!!');
		}

		redirect('admin/lembur', 'refresh');
	}
}

/* End of file Lembur.php */
