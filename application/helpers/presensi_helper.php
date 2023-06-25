<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

function hari($hari)
{
	if ($hari == 1) {
		$hari = "Senin";
	} else if ($hari == 2) {
		$hari = "Selasa";
	} else if ($hari == 3) {
		$hari = "Rabu";
	} else if ($hari == 4) {
		$hari = "Kamis";
	} else if ($hari == 5) {
		$hari = "Jum'at";
	} else if ($hari == 6) {
		$hari = "Sabtu";
	} else if ($hari == 7) {
		$hari = "Ahad";
	}
	return $hari;
}

function bulan($bulan)
{
	switch ($bulan) {
		case 1:
			$bulan = "Januari";
			break;
		case 2:
			$bulan = "Februari";
			break;
		case 3:
			$bulan = "Maret";
			break;
		case 4:
			$bulan = "April";
			break;
		case 5:
			$bulan = "Mei";
			break;
		case 6:
			$bulan = "Juni";
			break;
		case 7:
			$bulan = "Juli";
			break;
		case 8:
			$bulan = "Agustus";
			break;
		case 9:
			$bulan = "September";
			break;
		case 10:
			$bulan = "Oktober";
			break;
		case 11:
			$bulan = "November";
			break;
		case 12:
			$bulan = "Desember";
			break;

		default:
			$bulan = Date('F');
			break;
	}
	return $bulan;
}

function masuk($jam_masuk, $setting_jam_masuk)
{
	$awal  = date_create($jam_masuk);
	$akhir = date_create($setting_jam_masuk); // waktu sekarang
	$diff  = date_diff($awal, $akhir);

	if ($jam_masuk > $setting_jam_masuk) {
		$res = "Terlambat " . $diff->h . " jam, " . $diff->i . " menit, " . $diff->s . " detik";
	} else {
		$res = '';
	}

	return $res;
}

function berangkat($th, $bl, $idPeg)
{
	$CI = &get_instance();

	$CI->db->select('COUNT(presensiMasuk) as berangkat');

	$CI->db->where('idPegawai', $idPeg);

	$CI->db->group_start();
	$CI->db->where('YEAR(tanggal)', $th);
	$CI->db->where('MONTH(tanggal)', $bl);
	$CI->db->group_end();

	$CI->db->where('izin', null);

	$data = $CI->db->get('presensi')->row();

	return $data->berangkat;
}

function terlambat($th, $bl, $idPeg)
{
	$CI = &get_instance();

	$CI->db->select('jamMasuk');
	$setting = $CI->db->get('setting')->row();

	$CI->db->select('COUNT(presensiMasuk) as terlambat');

	$CI->db->where('idPegawai', $idPeg);
	$CI->db->where('presensiMasuk >', $setting->jamMasuk);

	$CI->db->group_start();
	$CI->db->where('YEAR(tanggal)', $th);
	$CI->db->where('MONTH(tanggal)', $bl);
	$CI->db->group_end();

	$CI->db->where('izin', null);

	$data = $CI->db->get('presensi')->row();

	return $data->terlambat;
}

function izin($th, $bl, $idPeg)
{
	$CI = &get_instance();

	$CI->db->select('COUNT(izin) as izin');

	$CI->db->where('idPegawai', $idPeg);

	$CI->db->group_start();
	$CI->db->where('YEAR(tanggal)', $th);
	$CI->db->where('MONTH(tanggal)', $bl);
	$CI->db->group_end();

	$data = $CI->db->get('presensi')->row();

	return $data->izin;
}
