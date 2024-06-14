<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelHome extends Model
{
    public function Login($username, $password, $level)
    {
        return $this->db->table('tbl_user')
            ->where([
                'username' => $username,
                'password' => $password,
                'level' => $level,
            ])->get()->getRowArray();
    }
}
