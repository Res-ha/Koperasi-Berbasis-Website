<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBunga;
use App\Models\ModelKoperasi;

class BungaKoperasi extends BaseController
{
    public function __construct()
    {
        $this->ModelBunga = new ModelBunga();
        $this->ModelKoperasi = new ModelKoperasi();
        helper('form');
    }

    public function index()
    {
        $koperasiData = $this->ModelKoperasi->all_data();
        $data = [
            'judul' => 'Bunga Koperasi',
            'subjudul' => '',
            'menu' => 'Master Data',
            'submenu' => 'Bunga Koperasi',
            'page' => 'bunga_koperasi/v_index',
            'bunga' => $this->ModelBunga->all_data(),
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
        ];
        return view('template/v_template_admin', $data);
    }

    public function update($id_bunga)
    {
        $validationRules = [
            'nama_bunga' => 'required',
            'besaran_bunga' => 'required',
        ];

        $validationMessages = [
            'nama_bunga' => [
                'required' => 'Nama Jenis Simpanan Wajib Diisi !!!'
            ],
            'besaran_bunga' => [
                'required' => 'Jumlah Jenis Simpanan Wajib Diisi !!!'
            ],
        ];
        if ($this->validate($validationRules, $validationMessages)) {
            $data = array(
                'id_bunga' => $id_bunga,
                'nama_bunga' => $this->request->getPost('nama_bunga'),
                'besaran_bunga' => $this->request->getPost('besaran_bunga'),
            );
            $this->ModelBunga->update_data($data);
            session()->setFlashdata('update', 'Data Berhasil Di Update !!!');
            return redirect()->to(base_url('bungakoperasi'));
        } else {
            // Jika validasi tidak berhasil
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('bungakoperasi'));
        }
    }
}
