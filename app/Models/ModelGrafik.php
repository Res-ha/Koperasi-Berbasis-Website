<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelGrafik extends Model
{
    public function count_by_status($status)
    {
        return $this->db->table('tbl_anggota')
            ->join('tbl_fakultas', 'tbl_fakultas.id_fakultas = tbl_anggota.id_fakultas')
            ->where('tbl_anggota.status', $status)
            ->countAllResults();
    }

    public function count_by_gender($gender)
    {
        return $this->db->table('tbl_anggota')
            ->join('tbl_fakultas', 'tbl_fakultas.id_fakultas = tbl_anggota.id_fakultas')
            ->where('tbl_anggota.jenis_kelamin', $gender)
            ->countAllResults();
    }

    public function count_by_faculty()
    {
        return $this->db->table('tbl_fakultas')
            ->select('tbl_fakultas.kode_fakultas, COUNT(tbl_anggota.id_anggota) as jumlah_anggota')
            ->join('tbl_anggota', 'tbl_fakultas.id_fakultas = tbl_anggota.id_fakultas', 'left')
            ->groupBy('tbl_fakultas.kode_fakultas')
            ->orderBy('tbl_fakultas.kode_fakultas')
            ->get()
            ->getResultArray();
    }

    // public function get_total_simpanan_by_jenis()
    // {
    //     return $this->db->table('tbl_simpanan')
    //         ->select('tbl_jenis_simpanan.nama_jenis_simpanan, SUM(tbl_jenis_simpanan.jumlah_jenis_simpanan) as total_simpanan')
    //         ->join('tbl_jenis_simpanan', 'tbl_simpanan.id_jenis_simpanan = tbl_jenis_simpanan.id_jenis_simpanan')
    //         ->groupBy('tbl_jenis_simpanan.nama_jenis_simpanan')
    //         ->orderBy('tbl_simpanan.id_simpanan')
    //         ->get()
    //         ->getResultArray();
    // }

    public function get_total_jumlah_simpanan()
    {
        return $this->db->table('tbl_simpanan')
            ->join('tbl_jenis_simpanan', 'tbl_simpanan.id_jenis_simpanan = tbl_jenis_simpanan.id_jenis_simpanan')
            ->selectSum('tbl_jenis_simpanan.jumlah_jenis_simpanan', 'total_jumlah_simpanan')
            ->get()
            ->getRowArray();
    }

    public function get_total_angsuran_lunas($lunas)
    {
        return $this->db->table('tbl_detail_pinjaman')
            ->select('status_detail_pinjaman, SUM(total_angsuran) AS total_angsuran_lunas')
            ->where('status_detail_pinjaman', $lunas)
            ->orderBy('id_detail_pinjaman')
            ->get()
            ->getResultArray();
    }

    public function get_total_pengeluaran()
    {
        return $this->db->table('tbl_pinjaman')
            ->selectSum('jumlah_pinjaman', 'total_pengeluaran')
            ->get()
            ->getRowArray();
    }

    public function get_total_jumlah_pinjaman()
    {
        return $this->db->table('tbl_pinjaman')
            ->selectSum('jumlah_pinjaman', 'total_jumlah_pinjaman')
            ->get()
            ->getRowArray();
    }

    public function tahun_pinjaman()
    {
        return $this->db->table('tbl_pinjaman')
            ->select("YEAR(tbl_pinjaman.tanggal_pengajuan) AS tahun")
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get()
            ->getResultArray();
    }

    public function data_pinjaman($tahun = null)
    {
        $query = $this->db->table('tbl_pinjaman')
            ->select('YEAR(tanggal_pengajuan) AS tahun, SUM(jumlah_pinjaman) AS total_jumlah_pinjaman')
            ->groupBy('YEAR(tanggal_pengajuan)')
            ->orderBy('tahun', 'ASC');

        if ($tahun) {
            $query->where("DATE_FORMAT(tanggal_pengajuan, '%Y')", $tahun);
        }

        return $query->get()->getResultArray();
    }

    public function tahun_simpanan()
    {
        return $this->db->table('tbl_simpanan')
            ->distinct()
            ->select("YEAR(tanggal_simpanan) AS tahun_simpanan")
            ->orderBy('tahun_simpanan')
            ->get()
            ->getResultArray();
    }

    public function data_simpanan($tahun = null)
    {
        $query = $this->db->table('tbl_simpanan')
            ->select("DISTINCT YEAR(tanggal_simpanan) AS tahun_simpanan, nama_jenis_simpanan, SUM(jumlah_jenis_simpanan) AS total_simpanan")
            ->join('tbl_jenis_simpanan', 'tbl_simpanan.id_jenis_simpanan = tbl_jenis_simpanan.id_jenis_simpanan')
            ->groupBy('tahun_simpanan, nama_jenis_simpanan')
            ->orderBy('tahun_simpanan, MIN(id_simpanan)'); // Use MIN() to match the behavior of GROUP BY

        if ($tahun) {
            $query->where("YEAR(tanggal_simpanan)", $tahun);
        }

        return $query->get()->getResultArray();
    }


    public function tahun_anggota()
    {
        return $this->db->table('tbl_anggota')
            ->select('DISTINCT YEAR(tanggal_gabung) AS tahun')
            ->orderBy('tahun', 'ASC') // Urutkan tahun secara ascending (ASC)
            ->get()
            ->getResultArray();
    }

    public function data_status($status, $year)
    {
        $query = $this->db->table('tbl_anggota')
            ->select('YEAR(tbl_anggota.tanggal_gabung) as tahun, tbl_anggota.status, COUNT(*) as jumlah')
            ->join('tbl_fakultas', 'tbl_fakultas.id_fakultas = tbl_anggota.id_fakultas')
            ->whereIn('tbl_anggota.status', $status) // Menggunakan whereIn untuk multiple values
            ->groupBy('tahun, tbl_anggota.status') // Grup berdasarkan tahun dan status
            ->orderBy('tahun, MIN(id_anggota)'); // Use MIN() to match the behavior of GROUP BY

        if ($year) {
            $query->where("YEAR(tbl_anggota.tanggal_gabung)", $year);
        }

        return $query->get()->getResult();
    }

    public function data_jk($gender, $year)
    {
        $query = $this->db->table('tbl_anggota')
            ->select('YEAR(tbl_anggota.tanggal_gabung) as tahun, tbl_anggota.jenis_kelamin, COUNT(*) as jumlah')
            ->join('tbl_fakultas', 'tbl_fakultas.id_fakultas = tbl_anggota.id_fakultas')
            ->whereIn('tbl_anggota.jenis_kelamin', $gender) // Menggunakan whereIn untuk multiple values
            ->groupBy('tahun, tbl_anggota.jenis_kelamin')
            ->orderBy('tahun, MIN(tbl_anggota.id_anggota)');

        if ($year) {
            $query->where("YEAR(tbl_anggota.tanggal_gabung)", $year);
        }

        return $query->get()->getResult();
    }
}
