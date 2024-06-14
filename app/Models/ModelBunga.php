<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBunga extends Model
{
    public function all_data()
    {
        return $this->db->table('tbl_bunga')
            ->orderBy('id_bunga')
            ->get()
            ->getResultArray();
    }


    public function detail_data($id_bunga)
    {
        return $this->db->table('tbl_bunga')
            ->where('id_bunga', $id_bunga)
            ->get()->getRowArray();
    }

    public function update_data($data)
    {
        $this->db->table('tbl_bunga')
            ->where('id_bunga', $data['id_bunga'])
            ->update($data);
    }
}
