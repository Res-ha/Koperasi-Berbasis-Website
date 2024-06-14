<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelSimpanan;
use App\Models\ModelAnggota;
use App\Models\ModelJenisSimpanan;
use App\Models\ModelKoperasi;

class Simpanan extends BaseController
{

    public function __construct()
    {
        $this->ModelSimpanan = new ModelSimpanan();
        $this->ModelAnggota = new ModelAnggota();
        $this->ModelJenisSimpanan = new ModelJenisSimpanan();
        $this->ModelKoperasi = new ModelKoperasi();
        helper('form');
    }

    public function index()
    {
        $koperasiData = $this->ModelKoperasi->all_data();
        $data = [
            'judul'     => 'Simpanan',
            'subjudul'  => '',
            'menu'      => 'Transaksi',
            'submenu'   => 'Simpanan',
            'page'      => 'simpanan/v_index',
            // 'simpanan'  => $this->ModelSimpanan->all_data(),
            'anggota' => $this->ModelAnggota->anggota_aktif(),
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
        ];
        return view('template/v_template_admin', $data);
    }

    public function detail($id_anggota)
    {
        $koperasiData = $this->ModelKoperasi->all_data();
        $data = [
            'judul'     => 'Detail Simpanan',
            'subjudul'  => '',
            'menu'      => 'Simpanan',
            'submenu'   => 'Detail Simpanan',
            'page'      => 'simpanan/v_detail',
            'anggota' => $this->ModelSimpanan->getAnggotaById($id_anggota),
            'detail_simpanan' => $this->ModelSimpanan->getSimpananByIdAnggota($id_anggota),
            'jenis_simpanan' => $this->ModelJenisSimpanan->all_data(),
            // 'simpanan' => $this->ModelSimpanan->data_simpanan(),
            'sum_total_simpanan' => $this->ModelSimpanan->sum_total_simpanan($id_anggota),
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
        ];
        return view('template/v_template_admin', $data);
    }

    public function insert($id_anggota)
    {
        $validationRules = [
            'id_jenis_simpanan' => 'required',
            'tanggal_simpanan' => 'required',
        ];

        $validationMessages = [
            'id_jenis_simpanan' => [
                'required' => 'Nama Jenis Jenis Simpanan Wajib Diisi !!!'
            ],
            'tanggal_simpanan' => [
                'required' => 'Tanggal Simpanan Wajib Diisi !!!'
            ],
        ];
        if ($this->validate($validationRules, $validationMessages)) {
            $data = [
                'id_anggota' => $id_anggota,
                'id_jenis_simpanan' => $this->request->getPost('id_jenis_simpanan'),
                'tanggal_simpanan' => $this->request->getPost('tanggal_simpanan'),
            ];

            $this->ModelSimpanan->insert_data($data);
            session()->setFlashdata('insert', 'Data Berhasil Di Tambahkan !!!');
            return redirect()->to('simpanan/detail/' . $id_anggota);
        } else {
            // Jika validasi tidak berhasil
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('simpanan'));
        }
    }

    public function delete($id_simpanan, $id_anggota)
    {
        $data = array(
            '$id_simpanan' => $id_simpanan,
        );
        $this->ModelSimpanan->delete_data($data);
        session()->setFlashdata('delete', 'Data Berhasil Di Hapus !!!');
        return redirect()->to(base_url('simpanan/detail/' . $id_anggota));
    }
}
