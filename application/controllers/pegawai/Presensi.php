<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Presensi extends CI_Controller
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
		$th_ini  = $this->uri->segment(3);
		$bln_ini = $this->uri->segment(4);

		if (!$th_ini) {
			$th_ini = $this->pegawai->getTahunIni();
		}
		if (!$bln_ini) {
			$bln_ini = $this->pegawai->getBulanIni($th_ini);
		}

		$data = [
			'title'           => 'Presensi',
			'navbar'          => 'pegawai/navbar',
			'page'            => 'pegawai/presensi',
			'setting'         => $this->pegawai->getSetting(),
			'presensiHariIni' => $this->pegawai->getPresensi([
				'idPegawai' => $this->dt_pegawai->id,
				'tanggal'   => date('Y-m-d'),
			]),
			'presensi' => $this->pegawai->getPresensi([
				'idPegawai'      => $this->dt_pegawai->id,
				'YEAR(tanggal)'  => $th_ini,
				'MONTH(tanggal)' => $bln_ini
			]),
			'tahun'   => $this->pegawai->getTahun(),
			'th_ini'  => $th_ini,
			'bln_ini' => $bln_ini
		];

		$this->load->view('index', $data);
	}

	public function detail($id)
	{
		$data = [
			'title'    => 'Detail Presensi',
			'navbar'   => 'pegawai/navbar',
			'page'     => 'pegawai/detail_presensi',
			'setting'  => $this->pegawai->getSetting(),
			'presensi' => $this->pegawai->getDetailPresensi($id),
		];

		$this->load->view('index', $data);
	}

	public function masuk()
	{
		$gambarPresensi = $_FILES['webcam']['name'];

		if ($gambarPresensi) {
			$this->load->library('upload');
			$config['upload_path']   = './uploads/presensi';
			$config['allowed_types'] = 'jpg|jpeg|png';
			// $config['max_size']             = 3072; // 3 mb
			$config['remove_spaces'] = TRUE;
			$config['detect_mime']   = TRUE;
			$config['encrypt_name']  = TRUE;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('webcam')) {
				$res = [
					'status' => 'error',
					'msg'    => $this->upload->display_errors()
				];
			} else {
				$upload_data = $this->upload->data();

				$data = [
					'idPegawai'     => $this->dt_pegawai->id,
					'tanggal'		=> date('Y-m-d'),
					'presensiMasuk' => date('H:i:s'),
					"pictureMasuk"  => $upload_data['file_name']
				];

				$insert = $this->db->insert('presensi', $data);

				if ($insert) {
					$res = [
						'status' => 'success',
						'msg'    => 'Presensi masuk berhasil'
					];
				} else {
					$res = [
						'status' => 'error',
						'msg'    => 'Server error!'
					];
				}
			}
		} else {
			$res = [
				'status' => 'error',
				'msg'    => 'Image not Found!'
			];
		}

		echo json_encode($res);
	}

	public function pulang()
	{
		$gambarPresensi = $_FILES['webcam']['name'];

		if ($gambarPresensi) {
			$this->load->library('upload');
			$config['upload_path']   = './uploads/presensi';
			$config['allowed_types'] = 'jpg|jpeg|png';
			// $config['max_size']             = 3072; // 3 mb
			$config['remove_spaces'] = TRUE;
			$config['detect_mime']   = TRUE;
			$config['encrypt_name']  = TRUE;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('webcam')) {
				$res = [
					'status' => 'error',
					'msg'    => $this->upload->display_errors()
				];
			} else {
				$upload_data = $this->upload->data();

				$this->db->where([
					'idPegawai' => $this->dt_pegawai->id,
					'tanggal'   => date('Y-m-d'),
				]);

				$cekPresensi = $this->db->get('presensi')->row();

				$data = [
					'presensiPulang' => date('H:i:s'),
					"picturePulang"  => $upload_data['file_name']
				];

				$this->db->where('id', $cekPresensi->id);
				$update = $this->db->update('presensi', $data);

				if ($update) {
					$res = [
						'status' => 'success',
						'msg'    => 'Presensi pulang berhasil'
					];
				} else {
					$res = [
						'status' => 'error',
						'msg'    => 'Server error!'
					];
				}
			}
		} else {
			$res = [
				'status' => 'error',
				'msg'    => 'Image not Found!'
			];
		}

		echo json_encode($res);
	}
}

/* End of file Presensi.php */
