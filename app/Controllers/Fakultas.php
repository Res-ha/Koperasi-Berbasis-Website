<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelFakultas;
use App\Models\ModelKoperasi;

class Fakultas extends BaseController
{
    public function __construct()
    {
        $this->ModelFakultas = new ModelFakultas();
        $this->ModelKoperasi = new ModelKoperasi();
        helper('form');
    }

    public function index()
    {
        $koperasiData = $this->ModelKoperasi->all_data();
        $data = [
            'judul' => 'Fakultas',
            'subjudul' => '',
            'menu' => 'Master Data',
            'submenu' => 'Fakultas',
            'page' => 'fakultas/v_index',
            'fakultas' => $this->ModelFakultas->all_data(),
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
        ];
        return view('template/v_template_admin', $data);
    }

    public function insert()
    {
        $validationRules = [
            'kode_fakultas' => 'required',
            'nama_fakultas' => 'required',
        ];

        $validationMessages = [
            'kode_fakultas' => [
                'required' => 'Kode Fakultas Wajib Diisi !!!'
            ],
            'nama_fakultas' => [
                'required' => 'Nama Fakultas Wajib Diisi !!!'
            ],
        ];
        if ($this->validate($validationRules, $validationMessages)) {
            $data = [
                'kode_fakultas' => $this->request->getPost('kode_fakultas'),
                'nama_fakultas' => $this->request->getPost('nama_fakultas'),
            ];

            $this->ModelFakultas->insert_data($data);
            session()->setFlashdata('insert', 'Data Berhasil Di Tambahkan !!!');
            return redirect()->to(base_url('fakultas'));
        } else {
            // Jika validasi tidak berhasil
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('fakultas'));
        }
    }

    public function update($id_fakultas)
    {
        $validationRules = [
            'kode_fakultas' => 'required',
            'nama_fakultas' => 'required',
        ];

        $validationMessages = [
            'kode_fakultas' => [
                'required' => 'Kode Fakultas Wajib Diisi !!!'
            ],
            'nama_fakultas' => [
                'required' => 'Nama Fakultas Wajib Diisi !!!'
            ],
        ];
        if ($this->validate($validationRules, $validationMessages)) {
            $data = array(
                'id_fakultas' => $id_fakultas,
                'kode_fakultas' => $this->request->getPost('kode_fakultas'),
                'nama_fakultas' => $this->request->getPost('nama_fakultas'),
            );
            $this->ModelFakultas->update_data($data);
            session()->setFlashdata('update', 'Data Berhasil Di Update !!!');
            return redirect()->to(base_url('fakultas'));
        } else {
            // Jika validasi tidak berhasil
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('fakultas'));
        }
    }

    public function delete($id_fakultas)
    {
        $data = array(
            'id_fakultas' => $id_fakultas,
        );
        $this->ModelFakultas->delete_data($data);
        session()->setFlashdata('delete', 'Data Berhasil Di Hapus !!!');
        return redirect()->to(base_url('fakultas'));
    }
}
