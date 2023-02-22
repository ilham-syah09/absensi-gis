<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
    public function getAllUser()
    {
        return $this->db->get('tb_user')->result();
    }

    public function getJabatan()
    {
        $this->db->order_by('namaJabatan', 'asc');

        return $this->db->get('jabatan')->result();
    }

    public function getPegawai()
    {
        $this->db->select('pegawai.*, jabatan.namaJabatan');
        $this->db->join('jabatan', 'jabatan.id = pegawai.idJabatan', 'inner');

        $this->db->order_by('jabatan.namaJabatan, pegawai.nama', 'asc');

        return $this->db->get('pegawai')->result();
    }

    public function getSetting()
    {
        return $this->db->get('setting')->row();
    }

    public function getTahunIni()
    {
        $this->db->select('YEAR(tanggal) as tahun');
        $this->db->order_by('tahun', 'desc');
        $this->db->limit(1);

        $data = $this->db->get('presensi')->row();
        return $data->tahun;
    }

    public function getBulanIni($tahun)
    {
        $this->db->select('MONTH(tanggal) as bulan');
        $this->db->where('YEAR(tanggal)', $tahun);

        $this->db->order_by('bulan', 'desc');
        $this->db->limit(1);

        $data = $this->db->get('presensi')->row();
        return $data->bulan;
    }

    public function getTahun()
    {
        $this->db->select('YEAR(tanggal) as tahun');
        $this->db->group_by('tahun');
        $this->db->order_by('tahun', 'desc');

        return $this->db->get('presensi')->result();
    }

    public function getPresensi($tahun, $bulan, $hari = null)
    {
        $this->db->select('tanggal, COUNT(presensiMasuk) as jumlahMasuk, COUNT(presensiPulang) as jumlahPulang, COUNT(izin) as jumlahIzin, COUNT(idPegawai) as total');

        $this->db->group_start();
        $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->where('MONTH(tanggal)', $bulan);
        if ($hari != null) {
            $this->db->where('DAY(tanggal)', $hari);
        }
        $this->db->group_end();

        $this->db->group_by('tanggal');
        $this->db->order_by('tanggal', 'asc');

        return $this->db->get('presensi')->result();
    }

    public function getListPresensi($tanggal)
    {
        $this->db->select('presensi.*, pegawai.nama');
        $this->db->join('pegawai', 'pegawai.id = presensi.idPegawai', 'inner');

        $this->db->where('presensi.tanggal', $tanggal);
        $this->db->order_by('pegawai.nama', 'asc');

        return $this->db->get('presensi')->result();
    }

    public function getDetailPresensi($id)
    {
        $this->db->select('presensi.*, pegawai.nama');
        $this->db->join('pegawai', 'pegawai.id = presensi.idPegawai', 'inner');

        $this->db->where('presensi.id', $id);

        return $this->db->get('presensi')->row();
    }
}

/* End of file M_admin.php */
