<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAngsuran;
use App\Models\ModelKoperasi;

class Angsuran extends BaseController
{

    public function __construct()
    {
        $this->ModelAngsuran = new ModelAngsuran();
        $this->ModelKoperasi = new ModelKoperasi();
        helper('form');
    }

    public function index()
    {
        $koperasiData = $this->ModelKoperasi->all_data();
        $data = [
            'judul'     => 'Angsuran',
            'subjudul'  => '',
            'menu'      => 'Transaksi',
            'submenu'   => 'Angsuran',
            'page'      => 'angsuran/v_index',
            // 'simpanan'  => $this->ModelSimpanan->AllData(),
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
        ];
        return view('template/v_template_admin', $data);
    }
}
