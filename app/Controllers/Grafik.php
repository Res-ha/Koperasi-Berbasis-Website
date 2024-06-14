<?php

namespace App\Controllers;

use App\Models\ModelDashboard;
use App\Models\ModelKoperasi;
use App\Models\ModelGrafik;

class Grafik extends BaseController
{
    public function __construct()
    {
        $this->ModelDashboard = new ModelDashboard();
        $this->ModelKoperasi = new ModelKoperasi();
        $this->ModelGrafik = new ModelGrafik();
        helper('form');
    }

    public function grafik_keuangan()
    {
        $koperasiData = $this->ModelKoperasi->all_data();
        // $jenisSimpananData = $this->ModelGrafik->get_total_simpanan_by_jenis();
        // $pinjamanData = $this->ModelGrafik->get_total_jumlah_pinjaman();
        $simpanan = $this->ModelGrafik->get_total_jumlah_simpanan()['total_jumlah_simpanan'];
        $angsuran = $this->ModelGrafik->get_total_angsuran_lunas('lunas')[0]['total_angsuran_lunas'];

        // Jumlahkan total simpanan dan total angsuran lunas
        $pemasukkan = $simpanan + $angsuran;

        // pengeluaran
        $pengeluaran = $this->ModelGrafik->get_total_pengeluaran('total_pengeluaran');
        $total_pengeluaran = $pengeluaran['total_pengeluaran'];

        // Get data for pinjaman
        $tahunPinjaman = $this->ModelGrafik->tahun_pinjaman();
        $selectedYearPinjaman = $this->request->getGet('tahun_pinjaman'); // Get the selected year from the URL parameters
        $pinjamanDataFiltered = $this->ModelGrafik->data_pinjaman($selectedYearPinjaman);

        // Get data for simpanan
        $tahunSimpanan = $this->ModelGrafik->tahun_simpanan();
        $selectedYearSimpanan = $this->request->getGet('tahun_simpanan');
        $simpananDataFiltered = $this->ModelGrafik->data_simpanan($selectedYearSimpanan);
        $data = [
            'judul'               => 'Grafik Keuangan',
            'subjudul'            => '',
            'menu'                => 'Grafik',
            'submenu'             => 'Grafik Keuangan',
            'page'                => 'grafik/grafik_saldo/v_index',
            'nama_koperasi'       => $koperasiData[0]['nama_koperasi'],
            // 'jenisSimpananData'   => json_encode($jenisSimpananData),
            // 'pinjamanData'        => json_encode($pinjamanData),
            'pengeluaran'         => $total_pengeluaran,
            'pemasukkan'          => $pemasukkan,

            'tahunPinjaman'       => $tahunPinjaman,
            'selectedYearPinjaman'        => $selectedYearPinjaman,
            'pinjamanDataFiltered' => $pinjamanDataFiltered,
            'tahunSimpanan'       => $tahunSimpanan,
            'selectedYearSimpanan'       => $selectedYearSimpanan,
            'simpananDataFiltered'       => $simpananDataFiltered,
        ];

        return view('template/v_template_admin', $data);
    }


    public function grafik_anggota()
    {
        $koperasiData = $this->ModelKoperasi->all_data();

        // Data anggota berdasarkan aktif dan tidak aktif
        $statusData = [
            'Aktif' => $this->ModelGrafik->count_by_status('Aktif'),
            'Tidak Aktif' => $this->ModelGrafik->count_by_status('Tidak Aktif'),
        ];
        $genderData = [
            'Laki - Laki' => $this->ModelGrafik->count_by_gender('L'),
            'Perempuan' => $this->ModelGrafik->count_by_gender('P'),
        ];

        // Data anggota berdasarkan kode fakultas
        $facultyData = $this->ModelGrafik->count_by_faculty();

        $data = [
            'judul' => 'Grafik Anggota',
            'subjudul' => '',
            'menu' => 'Grafik',
            'submenu' => 'Grafik Anggota',
            'page' => 'grafik/grafik_anggota/v_index',
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
            'statusData' => $statusData,
            'genderData' => $genderData,
            'facultyData' => json_encode($facultyData),
        ];

        // Load library Chart.js (pastikan sudah diinstal atau gunakan CDN)
        // Memastikan variabel $this->data diinisialisasi dengan array kosong sebelumnya
        $this->data = [];

        // Menggunakan helper view() untuk memanggil view dengan multiple data
        return view('template/v_template_admin', $data, $this->data);
    }
}
