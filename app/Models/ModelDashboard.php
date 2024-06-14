<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDashboard extends Model
{
    public function total_anggota()
    {
        return $this->db->table('tbl_anggota')->countAll();
    }

    public function total_fakultas()
    {
        return $this->db->table('tbl_fakultas')->countAll();
    }

    public function total_simpanan()
    {
        return $this->db->table('tbl_simpanan')
            ->join('tbl_jenis_simpanan', 'tbl_simpanan.id_jenis_simpanan = tbl_jenis_simpanan.id_jenis_simpanan')
            ->selectSum('tbl_jenis_simpanan.jumlah_jenis_simpanan', 'total_jumlah_simpanan')
            ->get()
            ->getRowArray();
    }

    public function total_angsuran($lunas)
    {
        return $this->db->table('tbl_detail_pinjaman')
            ->select('status_detail_pinjaman, SUM(total_angsuran) AS total_angsuran_lunas')
            ->where('status_detail_pinjaman', $lunas)
            ->orderBy('id_detail_pinjaman')
            ->get()
            ->getResultArray();
    }

    public function total_pinjaman()
    {
        return $this->db->table('tbl_pinjaman')
            ->selectSum('jumlah_pinjaman', 'total_jumlah_pinjaman')
            ->get()
            ->getRowArray();
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
}
