<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPinjaman extends Model
{
    public function pinjaman()
    {
        return $this->db->table('tbl_pinjaman')
            ->join('tbl_anggota', 'tbl_pinjaman.id_anggota = tbl_anggota.id_anggota')
            ->orderBy('id_pinjaman')
            ->get()
            ->getResultArray();
    }

    public function all_data()
    {
        return $this->db->table('tbl_pinjaman')
            ->join('tbl_anggota', 'tbl_pinjaman.id_anggota = tbl_anggota.id_anggota')
            ->orderBy('id_pinjaman')
            ->get()
            ->getResultArray();
    }

    public function detail_pinjaman()
    {
        return $this->db->table('tbl_pinjaman')
            ->join('tbl_anggota', 'tbl_pinjaman.id_anggota = tbl_anggota.id_anggota')
            ->join('tbl_detail_pinjaman', 'tbl_pinjaman.id_pinjaman = tbl_pinjaman.id_pinjaman')
            ->orderBy('tbl_detail_pinjaman.id_detail_pinjaman')
            ->get()
            ->getResultArray();
    }

    // Method to insert data into tbl_pinjaman
    public function insert_data_pinjaman($data_pinjaman)
    {
        $this->db->table('tbl_pinjaman')->insert($data_pinjaman);
        return $this->db->insertID(); // Get the last inserted ID
    }

    // Method to insert data into tbl_detail_pinjaman
    public function insert_detail_pinjaman($data)
    {
        $this->db->table('tbl_detail_pinjaman')->insert($data);
    }

    public function getAnggotaById($id_anggota)
    {
        return $this->db->table('tbl_anggota')
            ->where('id_anggota', $id_anggota)
            ->get()
            ->getRowArray();
    }

    public function getPinjamanByIdAnggota($id_pinjaman)
    {
        return $this->db->table('tbl_pinjaman')
            ->join('tbl_anggota', 'tbl_pinjaman.id_anggota = tbl_anggota.id_anggota')
            ->join('tbl_detail_pinjaman', 'tbl_pinjaman.id_pinjaman = tbl_detail_pinjaman.id_pinjaman')
            ->select('*') // Sesuaikan kolom yang diperlukan
            ->where('tbl_pinjaman.id_pinjaman', $id_pinjaman)
            ->get()
            ->getResultArray();
    }

    public function data_anggota($id_pinjaman)
    {
        $result = $this->db->table('tbl_pinjaman')
            ->join('tbl_anggota', 'tbl_pinjaman.id_anggota = tbl_anggota.id_anggota')
            ->select('tbl_pinjaman.*, tbl_anggota.nama_anggota, tbl_anggota.alamat_anggota')
            ->where('tbl_pinjaman.id_pinjaman', $id_pinjaman)
            ->orderBy('tbl_pinjaman.id_pinjaman')
            ->get()
            ->getResultArray();

        // Cek hasil model sebelum dikirim ke v_detail.php
        // var_dump($result);

        return $result;
    }

    public function update_pinjaman($data)
    {
        return $this->db->table('tbl_pinjaman')
            ->where('id_pinjaman', $data['id_pinjaman'])
            ->update($data);
    }

    public function update_detail_pinjaman($data)
    {
        $this->db->table('tbl_detail_pinjaman')
            ->where('id_detail_pinjaman', $data['id_detail_pinjaman'])
            ->update($data);
    }

    public function delete_data($id_pinjaman)
    {
        $this->db->table('tbl_pinjaman')
            ->where('id_pinjaman', $id_pinjaman)
            ->delete();

        $this->db->table('tbl_detail_pinjaman')
            ->where('id_pinjaman', $id_pinjaman)
            ->delete();
    }
}
