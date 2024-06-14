<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLaporan extends Model
{
    function data_anggota()
    {
        return $this->db->table('tbl_anggota')
            ->join('tbl_fakultas', 'tbl_fakultas.id_fakultas = tbl_anggota.id_fakultas')
            ->orderBy('tbl_anggota.id_anggota') // Fully qualify the column name
            ->get()
            ->getResultArray();
    }

    public function jumlah_anggota()
    {
        return $this->db->table('tbl_anggota')
            ->countAllResults();
    }

    function data_simpanan()
    {
        return $this->db->table('tbl_simpanan')
            ->select('tbl_anggota.*, tbl_fakultas.*,SUM(tbl_jenis_simpanan.jumlah_jenis_simpanan) AS jumlah_simpanan')
            ->join('tbl_anggota', 'tbl_simpanan.id_anggota = tbl_anggota.id_anggota')
            ->join('tbl_jenis_simpanan', 'tbl_simpanan.id_jenis_simpanan = tbl_jenis_simpanan.id_jenis_simpanan')
            ->join('tbl_fakultas', 'tbl_anggota.id_fakultas = tbl_fakultas.id_fakultas')
            ->groupBy('tbl_anggota.id_anggota, tbl_anggota.nama_anggota')
            ->orderBy('tbl_anggota.id_anggota')
            ->get()
            ->getResultArray();
    }

    function all_data_simpanan()
    {
        return $this->db->table('tbl_simpanan')
            ->select('tbl_fakultas.kode_fakultas, tbl_anggota.nama_anggota, tbl_simpanan.tanggal_simpanan, tbl_jenis_simpanan.nama_jenis_simpanan, tbl_jenis_simpanan.jumlah_jenis_simpanan, tbl_jenis_simpanan.*, SUM(tbl_jenis_simpanan.jumlah_jenis_simpanan) AS jumlah_simpanan')
            ->join('tbl_anggota', 'tbl_simpanan.id_anggota = tbl_anggota.id_anggota')
            ->join('tbl_jenis_simpanan', 'tbl_simpanan.id_jenis_simpanan = tbl_jenis_simpanan.id_jenis_simpanan')
            ->join('tbl_fakultas', 'tbl_anggota.id_fakultas = tbl_fakultas.id_fakultas')
            ->groupBy('tbl_fakultas.kode_fakultas, tbl_anggota.nama_anggota, tbl_simpanan.tanggal_simpanan, tbl_jenis_simpanan.nama_jenis_simpanan')
            ->orderBy('tbl_simpanan.tanggal_simpanan', 'AESC') // Urutkan berdasarkan tanggal_simpanan secara descending
            ->get()
            ->getResultArray();
    }

    function getAnggotaById($id_anggota)
    {
        return $this->db->table('tbl_anggota')
            ->select('tbl_anggota.*, tbl_fakultas.*')
            ->join('tbl_fakultas', 'tbl_fakultas.id_fakultas = tbl_anggota.id_fakultas')
            ->where('id_anggota', $id_anggota)
            ->get()
            ->getResultArray();
    }

    public function getSimpananByAnggota($id_anggota, $tahun)
    {
        return $this->db->table('tbl_simpanan')
            ->select('tbl_fakultas.kode_fakultas, tbl_anggota.nama_anggota, tbl_simpanan.*')
            ->join('tbl_anggota', 'tbl_simpanan.id_anggota = tbl_anggota.id_anggota')
            ->join('tbl_jenis_simpanan', 'tbl_simpanan.id_jenis_simpanan = tbl_jenis_simpanan.id_jenis_simpanan')
            ->join('tbl_fakultas', 'tbl_anggota.id_fakultas = tbl_fakultas.id_fakultas')
            ->where('tbl_anggota.id_anggota', $id_anggota)
            ->where('YEAR(tbl_simpanan.tanggal_simpanan)', $tahun)
            ->get()
            ->getResultArray();
    }

    public function getSavingsForMonth($id_anggota, $month, $tahun)
    {
        return $this->db->table('tbl_simpanan')
            ->select('tbl_anggota.nama_anggota, tbl_fakultas.kode_fakultas')
            ->selectSum('tbl_jenis_simpanan.jumlah_jenis_simpanan', 'total_jumlah_simpanan')
            ->join('tbl_anggota', 'tbl_simpanan.id_anggota = tbl_anggota.id_anggota')
            ->join('tbl_jenis_simpanan', 'tbl_simpanan.id_jenis_simpanan = tbl_jenis_simpanan.id_jenis_simpanan')
            ->join('tbl_fakultas', 'tbl_anggota.id_fakultas = tbl_fakultas.id_fakultas')
            ->where('tbl_simpanan.id_anggota', $id_anggota)
            ->where('MONTH(tbl_simpanan.tanggal_simpanan)', $this->getMonthNumber($month))
            ->where('YEAR(tbl_simpanan.tanggal_simpanan)', $tahun)
            ->groupBy('tbl_anggota.nama_anggota, tbl_fakultas.kode_fakultas')
            ->get()
            ->getRowArray();
    }

    // Additional function to convert month names to numbers
    private function getMonthNumber($month)
    {
        $months = [
            'Januari' => 1,
            'Februari' => 2,
            'Maret' => 3,
            'April' => 4,
            'Mei' => 5,
            'Juni' => 6,
            'Juli' => 7,
            'Agustus' => 8,
            'September' => 9,
            'Oktober' => 10,
            'November' => 11,
            'Desember' => 12,
        ];

        return $months[$month];
    }

    public function pinjaman_all_data()
    {
        return $this->db->table('tbl_pinjaman')
            ->select('tbl_fakultas.kode_fakultas, tbl_anggota.nama_anggota, tbl_pinjaman.tanggal_pengajuan, tbl_detail_pinjaman.tanggal_detail_pinjaman, tbl_pinjaman.jumlah_pinjaman, tbl_pinjaman.bunga_pinjaman, tbl_detail_pinjaman.total_angsuran, tbl_detail_pinjaman.status_detail_pinjaman')
            ->join('tbl_anggota', 'tbl_pinjaman.id_anggota = tbl_anggota.id_anggota')
            ->join('tbl_fakultas', 'tbl_anggota.id_fakultas = tbl_fakultas.id_fakultas')
            ->join('tbl_detail_pinjaman', 'tbl_pinjaman.id_pinjaman = tbl_detail_pinjaman.id_pinjaman')
            ->orderBy('tbl_pinjaman.tanggal_pengajuan') // Mengurutkan berdasarkan tanggal_pengajuan
            ->get()
            ->getResultArray();
    }

    public function pinjaman_telat()
    {
        return $this->db->table('tbl_pinjaman')
            ->select('tbl_fakultas.kode_fakultas, tbl_anggota.nama_anggota, tbl_pinjaman.tanggal_pengajuan, tbl_detail_pinjaman.tanggal_detail_pinjaman, tbl_pinjaman.jumlah_pinjaman, tbl_pinjaman.bunga_pinjaman, tbl_detail_pinjaman.total_angsuran, tbl_detail_pinjaman.status_detail_pinjaman')
            ->join('tbl_anggota', 'tbl_pinjaman.id_anggota = tbl_anggota.id_anggota')
            ->join('tbl_fakultas', 'tbl_anggota.id_fakultas = tbl_fakultas.id_fakultas')
            ->join('tbl_detail_pinjaman', 'tbl_pinjaman.id_pinjaman = tbl_detail_pinjaman.id_pinjaman')
            ->where('tbl_detail_pinjaman.tanggal_detail_pinjaman <', date('Y-m-d'))
            ->where('tbl_detail_pinjaman.status_detail_pinjaman !=', 'lunas') // Exclude 'lunas' status
            ->orderBy('tbl_detail_pinjaman.tanggal_detail_pinjaman')
            ->get()
            ->getResultArray();
    }

    public function pinjaman_lunas()
    {
        return $this->db->table('tbl_pinjaman')
            ->select('tbl_fakultas.kode_fakultas, tbl_anggota.nama_anggota, tbl_pinjaman.tanggal_pengajuan, tbl_detail_pinjaman.tanggal_detail_pinjaman, tbl_pinjaman.jumlah_pinjaman, tbl_pinjaman.bunga_pinjaman, tbl_detail_pinjaman.total_angsuran, tbl_detail_pinjaman.status_detail_pinjaman')
            ->join('tbl_anggota', 'tbl_pinjaman.id_anggota = tbl_anggota.id_anggota')
            ->join('tbl_fakultas', 'tbl_anggota.id_fakultas = tbl_fakultas.id_fakultas')
            ->join('tbl_detail_pinjaman', 'tbl_pinjaman.id_pinjaman = tbl_detail_pinjaman.id_pinjaman')
            ->where('tbl_detail_pinjaman.status_detail_pinjaman', 'lunas') // Filter by 'lunas' status
            ->orderBy('tbl_pinjaman.tanggal_pengajuan')
            ->get()
            ->getResultArray();
    }

    public function pinjaman_belum_lunas()
    {
        return $this->db->table('tbl_pinjaman')
            ->select('tbl_fakultas.kode_fakultas, tbl_anggota.nama_anggota, tbl_pinjaman.tanggal_pengajuan, tbl_detail_pinjaman.tanggal_detail_pinjaman, tbl_pinjaman.jumlah_pinjaman, tbl_pinjaman.bunga_pinjaman, tbl_detail_pinjaman.total_angsuran, tbl_detail_pinjaman.status_detail_pinjaman')
            ->join('tbl_anggota', 'tbl_pinjaman.id_anggota = tbl_anggota.id_anggota')
            ->join('tbl_fakultas', 'tbl_anggota.id_fakultas = tbl_fakultas.id_fakultas')
            ->join('tbl_detail_pinjaman', 'tbl_pinjaman.id_pinjaman = tbl_detail_pinjaman.id_pinjaman')
            ->where('tbl_detail_pinjaman.status_detail_pinjaman', 'belum lunas') // Filter by 'lunas' status
            ->orderBy('tbl_pinjaman.tanggal_pengajuan')
            ->get()
            ->getResultArray();
    }
}
