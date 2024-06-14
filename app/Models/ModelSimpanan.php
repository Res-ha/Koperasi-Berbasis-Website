<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSimpanan extends Model
{
    protected $table = 'tbl_simpanan';
    protected $primaryKey = 'id_simpanan';

    public function all_data()
    {
        return $this->db->table('tbl_simpanan')
            ->join('tbl_anggota', 'tbl_simpanan.id_anggota = tbl_anggota.id_anggota')
            ->join('tbl_jenis_simpanan', 'tbl_simpanan.id_jenis_simpanan = tbl_jenis_simpanan.id_jenis_simpanan')
            ->orderBy('tbl_simpanan.id_simpanan')
            ->get()
            ->getResultArray();
    }

    public function data_simpanan()
    {
        return $this->db->table('tbl_simpanan')
            ->get()
            ->getResultArray();
    }

    public function view()
    {
        return $this->db->table('tbl_simpanan')
            ->join('tbl_anggota', 'tbl_simpanan.id_anggota = tbl_anggota.id_anggota')
            ->join('tbl_jenis_simpanan', 'tbl_simpanan.id_jenis_simpanan = tbl_jenis_simpanan.id_jenis_simpanan')
            ->join('tbl_fakultas', 'tbl_anggota.id_fakultas = tbl_fakultas.id_fakultas') // Tambah join untuk tbl_fakultas
            ->orderBy('id_simpanan')
            ->get()
            ->getResultArray();
    }

    public function detail_data($id_simpanan)
    {
        return $this->db->table('tbl_simpanan')
            ->join('tbl_anggota', 'tbl_simpanan.id_anggota = tbl_anggota.id_anggota')
            ->join('tbl_jenis_simpanan', 'tbl_simpanan.id_jenis_simpanan = tbl_jenis_simpanan.id_jenis_simpanan')
            ->where('id_simpanan', $id_simpanan)
            ->get()->getResultArray();
    }

    public function insert_data($data)
    {
        $this->db->table('tbl_simpanan')->insert($data);
    }

    public function update_data($data)
    {
        $this->db->table('tbl_simpanan')
            ->where('id_simpanan', $data['id_simpanan'])
            ->update($data);
    }

    public function delete_data($id_simpanan)
    {
        $this->db->table('tbl_simpanan')
            ->where('id_simpanan', $id_simpanan)
            ->delete();
    }

    public function getAnggotaById($id_anggota)
    {
        // Mengambil data anggota berdasarkan id_anggota
        return $this->db->table('tbl_anggota')
            ->where('id_anggota', $id_anggota)
            ->get()
            ->getRowArray();
    }

    public function getSimpananByIdAnggota($id_anggota)
    {
        // Mengambil data simpanan berdasarkan id_anggota
        return $this->db->table('tbl_simpanan')
            ->join('tbl_jenis_simpanan', 'tbl_simpanan.id_jenis_simpanan = tbl_jenis_simpanan.id_jenis_simpanan')
            ->where('id_anggota', $id_anggota)
            ->get()
            ->getResultArray();
    }

    public function sum_total_simpanan($id_anggota)
    {
        return $this->selectSum('tbl_jenis_simpanan.jumlah_jenis_simpanan', 'total_simpanan')
            ->join('tbl_jenis_simpanan', 'tbl_simpanan.id_jenis_simpanan = tbl_jenis_simpanan.id_jenis_simpanan')
            ->where('tbl_simpanan.id_anggota', $id_anggota)
            ->get()
            ->getRowArray();
    }
}
