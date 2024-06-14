<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKoperasi extends Model
{
    public function nama_koperasi()
    {
        // Logika untuk mendapatkan nama koperasi dari database
        $result = $this->db->table('tbl_koperasi')->select('nama_koperasi')->get()->getRow();

        if ($result) {
            return $result->nama_koperasi;
        } else {
            return ''; // Mengembalikan string kosong jika data tidak ditemukan
        }
    }

    public function all_data()
    {
        return $this->db->table('tbl_koperasi')
            ->get()->getResultArray();
    }

    public function insert_data($data)
    {
        $this->db->table('tbl_koperasi')->insert($data);
    }

    public function detail_data($id_koperasi)
    {
        return $this->db->table('tbl_koperasi')
            ->where('id_koperasi', $id_koperasi)
            ->get()->getRowArray();
    }

    public function update_data($data)
    {
        $this->db->table('tbl_koperasi')
            ->where('id_koperasi', $data['id_koperasi'])
            ->update($data);
    }

    public function delete_data($id_user)
    {
        $this->db->table('tbl_user')
            ->where('id_user', $id_user)
            ->delete();
    }
}
