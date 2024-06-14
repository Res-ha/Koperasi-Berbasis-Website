<?php

namespace App\Controllers;

use App\Models\ModelDashboard;
use App\Models\ModelKoperasi;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->ModelDashboard = new ModelDashboard();
        $this->ModelKoperasi = new ModelKoperasi();
        helper('form');
    }

    public function index()
    {
        $koperasiData = $this->ModelKoperasi->all_data();
        $angsuran_telat = $this->ModelDashboard->pinjaman_telat();
        $simpanan = $this->ModelDashboard->total_simpanan()['total_jumlah_simpanan'];
        $angsuran = $this->ModelDashboard->total_angsuran('lunas')[0]['total_angsuran_lunas'];
        $pengeluaran = $this->ModelDashboard->total_pinjaman()['total_jumlah_pinjaman'];

        // Jumlahkan total simpanan dan total angsuran lunas
        $pemasukkan = $simpanan + $angsuran;

        $data = [
            'judul'    => 'Dashboard',
            'subjudul' => '',
            'menu'     => 'Dashboard',
            'submenu'  => 'Dashboard',
            'page'     => 'dashboard/v_index',
            'total_anggota' => $this->ModelDashboard->total_anggota(),
            'total_fakultas' => $this->ModelDashboard->total_fakultas(),
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
            'pemasukkan' => $pemasukkan,
            'pengeluaran' => $pengeluaran,
            'angsuran_telat' => $angsuran_telat,
        ];
        return view('template/v_template_admin', $data);
    }
}
