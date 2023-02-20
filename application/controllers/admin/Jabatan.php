<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends CI_Controller
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
			'title'  => 'Jabatan',
			'navbar' => 'admin/navbar',
			'page'   => 'admin/jabatan',
			'jabatan' => $this->admin->getJabatan()
		];

		$this->load->view('index', $data);
	}

	public function add()
	{
		$data = [
			'namaJabatan' => $this->input->post('namaJabatan')
		];

		$insert = $this->db->insert('jabatan', $data);

		if ($insert) {
			$this->session->set_flashdata('toastr-sukses', 'Data berhasil ditambahkan');
		} else {
			$this->session->set_flashdata('toastr-eror', 'Data gagal ditambahkam');
		}

		redirect('admin/jabatan', 'refresh');
	}

	public function edit()
	{
		$data = [
			'namaJabatan' => $this->input->post('namaJabatan')
		];

		$this->db->where('id', $this->input->post('id_jabatan'));
		$update = $this->db->update('jabatan', $data);

		if ($update) {
			$this->session->set_flashdata('toastr-sukses', 'Data berhasil diedit');
		} else {
			$this->session->set_flashdata('toastr-eror', 'Data gagal diedit');
		}

		redirect('admin/jabatan', 'refresh');
	}

	public function delete($id)
	{

		$this->db->where('id', $id);
		$delete = $this->db->delete('jabatan');

		if ($delete) {
			$this->session->set_flashdata('toastr-sukses', 'Data berhasil dihapus');
		} else {
			$this->session->set_flashdata('toastr-eror', 'Data gagal dihapus!!');
		}

		redirect('admin/jabatan', 'refresh');
	}
}

/* End of file Jabatan.php */
