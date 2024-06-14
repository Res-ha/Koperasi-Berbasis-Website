<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPengguna extends Model
{
    // Mengambil semua data pengguna dari tabel tbl_user
    public function all_data()
    {
        return $this->db->table('tbl_user')
            ->get()->getResultArray();
    }

    // Menyimpan data pengguna ke dalam tabel tbl_user
    public function insert_data($data)
    {
        $this->db->table('tbl_user')->insert($data);
    }

    // Mengambil detail data pengguna berdasarkan ID
    public function detail_data($id_user)
    {
        return $this->db->table('tbl_user')
            ->where('id_user', $id_user)
            ->get()->getRowArray();
    }

    // Mengupdate data pengguna berdasarkan ID
    public function update_data($data)
    {
        $this->db->table('tbl_user')
            ->where('id_user', $data['id_user'])
            ->update($data);
    }

    // Menghapus data pengguna berdasarkan ID
    public function delete_data($id_user)
    {
        $this->db->table('tbl_user')
            ->where('id_user', $id_user)
            ->delete();
    }
}
