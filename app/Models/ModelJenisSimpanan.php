<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelJenisSimpanan extends Model
{
    // Mengambil semua data jenis simpanan dari tabel tbl_jenis_simpanan
    public function all_data()
    {
        return $this->db->table('tbl_jenis_simpanan')
            ->get()->getResultArray();
    }

    // Menyimpan data jenis simpanan ke dalam tabel tbl_jenis_simpanan
    public function insert_data($data)
    {
        $this->db->table('tbl_jenis_simpanan')->insert($data);
    }

    // Mengambil detail data jenis simpanan berdasarkan ID
    public function detail_data($id_jenis_simpanan)
    {
        return $this->db->table('tbl_jenis_simpanan')
            ->where('id_jenis_simpanan', $id_jenis_simpanan)
            ->get()->getRowArray();
    }

    // Mengupdate data jenis simpanan berdasarkan ID
    public function update_data($data)
    {
        $this->db->table('tbl_jenis_simpanan')
            ->where('id_jenis_simpanan', $data['id_jenis_simpanan'])
            ->update($data);
    }

    // Menghapus data jenis simpanan berdasarkan ID
    public function delete_data($id_jenis_simpanan)
    {
        $this->db->table('tbl_jenis_simpanan')
            ->where('id_jenis_simpanan', $id_jenis_simpanan)
            ->delete();
    }
}
