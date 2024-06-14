<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelFakultas extends Model
{
    public function all_data()
    {
        return $this->db->table('tbl_fakultas')
            ->orderBy('id_fakultas')
            ->get()
            ->getResultArray();
    }

    public function insert_data($data)
    {
        $this->db->table('tbl_fakultas')->insert($data);
    }

    public function detail_data($id_fakultas)
    {
        return $this->db->table('tbl_fakultas')
            ->where('id_fakultas', $id_fakultas)
            ->get()->getRowArray();
    }

    public function update_data($data)
    {
        $this->db->table('tbl_fakultas')
            ->where('id_fakultas', $data['id_fakultas'])
            ->update($data);
    }

    public function delete_data($id_fakultas)
    {
        $this->db->table('tbl_fakultas')
            ->where('id_fakultas', $id_fakultas)
            ->delete();
    }
}
