<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAnggota extends Model
{

    // Mengambil semua data anggota dari tabel tbl_anggota
    public function anggota_by_fakultas($id_fakultas)
    {
        return $this->db->table('tbl_anggota')
            ->join('tbl_fakultas', 'tbl_fakultas.id_fakultas = tbl_anggota.id_fakultas')
            ->where('tbl_anggota.id_fakultas', $id_fakultas)
            ->orderBy('tbl_anggota.id_anggota') // Updated to 'tbl_anggota.id_anggota'
            ->get()
            ->getResultArray();
    }

    public function all_data()
    {
        return $this->db->table('tbl_anggota')
            ->join('tbl_fakultas', 'tbl_fakultas.id_fakultas = tbl_anggota.id_fakultas')
            ->orderBy('id_anggota')
            ->get()
            ->getResultArray();
    }

    public function anggota_aktif()
    {
        return $this->db->table('tbl_anggota')
            ->join('tbl_fakultas', 'tbl_fakultas.id_fakultas = tbl_anggota.id_fakultas')
            ->where('tbl_anggota.status', 'Aktif') // Add this line for the condition
            ->orderBy('id_anggota')
            ->get()
            ->getResultArray();
    }

    // Mengambil detail data anggota berdasarkan ID
    public function detail_data($id_anggota)
    {
        return $this->db->table('tbl_anggota')
            ->join('tbl_fakultas', 'tbl_fakultas.id_fakultas = tbl_anggota.id_fakultas')
            ->where('id_anggota', $id_anggota)
            ->get()
            ->getRowArray();
    }

    // Menyimpan data anggota ke dalam tabel tbl_anggota
    public function insert_data($data)
    {
        $this->db->table('tbl_anggota')->insert($data);
    }


    // Mengupdate data anggota berdasarkan ID
    public function update_data($data)
    {
        $this->db->table('tbl_anggota')
            ->where('id_anggota', $data['id_anggota'])
            ->update($data);
    }

    // Menghapus data anggota berdasarkan ID
    public function delete_data($id_anggota)
    {
        $this->db->table('tbl_anggota')
            ->where('id_anggota', $id_anggota)
            ->delete();
    }

    public function cek_data($nama)
    {
        return $this->db->table('tbl_anggota')
            ->where('nama_anggota', $nama)
            ->get()
            ->getRowArray();
    }

    public function import($data)
    {
        return $this->db->table('tbl_anggota')->insert($data);
    }

    public function cekData($nama)
    {
        return $this->db->table('tbl_anggota')
            ->select('nama_anggota')
            ->where('nama_anggota', $nama)
            ->get()
            ->getRow();
    }
}
