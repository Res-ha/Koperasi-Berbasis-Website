<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKoperasi;

class Koperasi extends BaseController
{
    public function __construct()
    {
        $this->ModelKoperasi = new ModelKoperasi();
        helper('form');
    }

    public function index()
    {

        $koperasiData = $this->ModelKoperasi->all_data();
        $data = [
            'judul' => 'Koperasi',
            'subjudul' => '',
            'menu' => 'Master Data',
            'submenu' => 'Koperasi',
            'page' => 'koperasi/v_index',
            'koperasi' => $this->ModelKoperasi->all_data(),
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
        ];
        return view('template/v_template_admin', $data);
    }

    public function edit($id_koperasi)
    {
        $koperasiData = $this->ModelKoperasi->all_data();
        $data = [
            'judul' => 'Edit Koperasi',
            'subjudul' => 'Edit Koperasi',
            'menu' => 'Koperasi',
            'submenu' => 'Edit Koperasi',
            'page' => 'koperasi/v_update',
            'koperasi' => $this->ModelKoperasi->detail_data($id_koperasi),
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
        ];
        return view('template/v_template_admin', $data);
    }

    public function update($id_koperasi)
    {
        $validationRules = [
            'nama_koperasi' => [
                'label'  => 'Nama Koperasi',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'alamat_koperasi' => [
                'label'  => 'Alamat Koperasi',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'logo_koperasi' => [
                'label'  => 'Logo Koperasi',
                'rules'  => 'max_size[logo_koperasi,1024]|mime_in[logo_koperasi,image/png,image/jpg,image/jpeg,image/gif]',
                'errors' => [
                    'max_size' => 'Ukuran {field} Max 1024 KB !!!',
                    'mime_in' => 'Format {field} Wajib PNG,JPEG,JPG,GIF',
                ]
            ],
        ];

        if ($this->validate($validationRules)) {
            $logo = $this->request->getFile('logo_koperasi');
            if ($logo->getError() == 4) {
                $data = [
                    'id_koperasi' => $id_koperasi,
                    'nama_koperasi' => $this->request->getPost('nama_koperasi'),
                    'alamat_koperasi' => $this->request->getPost('alamat_koperasi'),
                ];
            } else {
                $koperasi = $this->ModelKoperasi->detail_data($id_koperasi);
                if ($koperasi['logo_koperasi'] != "") {
                    unlink('logo_koperasi/' . $koperasi['logo_koperasi']);
                }
                $nama_file = $logo->getRandomName();
                $data = [
                    'id_koperasi' => $id_koperasi,
                    'nama_koperasi' => $this->request->getPost('nama_koperasi'),
                    'alamat_koperasi' => $this->request->getPost('alamat_koperasi'),
                    'logo_koperasi' => $nama_file,
                ];
                $logo->move('logo_koperasi', $nama_file);
            }

            $this->ModelKoperasi->update_data($data);
            session()->setFlashdata('update', 'Data Berhasil Di Update !!!');
            return redirect()->to('koperasi');
        } else {
            // Jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('koperasi/edit/' . $id_koperasi));
        }
    }
}
