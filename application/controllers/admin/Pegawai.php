<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
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
			'title'   => 'Pegawai',
			'navbar'  => 'admin/navbar',
			'page'    => 'admin/pegawai',
			'jabatan' => $this->admin->getJabatan(),
			'pegawai' => $this->admin->getPegawai()
		];

		$this->load->view('index', $data);
	}

	public function add()
	{
		$data = [
			'email'     => $this->input->post('email'),
			'password'  => password_hash('pegawai123', PASSWORD_BCRYPT, ['const' => 14]),
			'nama'      => $this->input->post('nama'),
			'nip'       => $this->input->post('nip'),
			'jk'        => $this->input->post('jk'),
			'idJabatan' => $this->input->post('jabatan'),
			'status'    => $this->input->post('status'),
		];

		$insert = $this->db->insert('pegawai', $data);

		if ($insert) {
			$this->session->set_flashdata('toastr-sukses', 'Data berhasil ditambahkan');
		} else {
			$this->session->set_flashdata('toastr-eror', 'Data gagal ditambahkam');
		}

		redirect('admin/pegawai', 'refresh');
	}

	public function edit()
	{
		$data = [
			'email'     => $this->input->post('email'),
			'nama'      => $this->input->post('nama'),
			'nip'       => $this->input->post('nip'),
			'jk'        => $this->input->post('jk'),
			'idJabatan' => $this->input->post('jabatan'),
			'status'    => $this->input->post('status'),
		];

		$this->db->where('id', $this->input->post('id_pegawai'));
		$update = $this->db->update('pegawai', $data);

		if ($update) {
			$this->session->set_flashdata('toastr-sukses', 'Data berhasil diedit');
		} else {
			$this->session->set_flashdata('toastr-eror', 'Data gagal diedit');
		}

		redirect('admin/pegawai', 'refresh');
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$data = $this->db->get('pegawai')->row();

		$this->db->where('id', $id);
		$delete = $this->db->delete('pegawai');

		if ($delete) {
			if ($data->image != 'default.png') {
				unlink(FCPATH . 'uploads/profiles/' . $data->image);
			}

			$this->session->set_flashdata('toastr-sukses', 'Data berhasil dihapus');
		} else {
			$this->session->set_flashdata('toastr-eror', 'Data gagal dihapus!!');
		}

		redirect('admin/pegawai', 'refresh');
	}
}

/* End of file Pegawai.php */
