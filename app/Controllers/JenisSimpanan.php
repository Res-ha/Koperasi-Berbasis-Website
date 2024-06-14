<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelJenisSimpanan;
use App\Models\ModelKoperasi;

class JenisSimpanan extends BaseController
{
    public function __construct()
    {
        $this->ModelJenisSimpanan = new ModelJenisSimpanan();
        $this->ModelKoperasi = new ModelKoperasi();
        helper('form');
    }

    // Menampilkan halaman utama Jenis Simpanan
    public function index()
    {
        $koperasiData = $this->ModelKoperasi->all_data();
        $data = [
            'judul' => 'Jenis Simpanan',
            'subjudul' => '',
            'menu' => 'Master Data',
            'submenu' => 'Jenis Simpanan',
            'page' => 'jenis_simpanan/v_index',
            'jenis_simpanan' => $this->ModelJenisSimpanan->all_data(),
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
        ];

        return view('template/v_template_admin', $data);
    }

    public function insert()
    {
        $validationRules = [
            'nama_jenis_simpanan' => 'required',
            'jumlah_jenis_simpanan' => 'required',
        ];

        $validationMessages = [
            'nama_jenis_simpanan' => [
                'required' => 'Nama Jenis Simpanan Wajib Diisi !!!'
            ],
            'jumlah_jenis_simpanan' => [
                'required' => 'Jumlah Jenis Simpanan Wajib Diisi !!!'
            ],
        ];
        if ($this->validate($validationRules, $validationMessages)) {
            $data = [
                'nama_jenis_simpanan' => $this->request->getPost('nama_jenis_simpanan'),
                'jumlah_jenis_simpanan' => $this->request->getPost('jumlah_jenis_simpanan'),
            ];

            $this->ModelJenisSimpanan->insert_data($data);
            session()->setFlashdata('insert', 'Data Berhasil Di Tambahkan !!!');
            return redirect()->to('jenissimpanan');
        } else {
            // Jika validasi tidak berhasil
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('jenissimpanan'));
        }
    }

    public function update($id_jenis_simpanan)
    {
        $validationRules = [
            'nama_jenis_simpanan' => 'required',
            'jumlah_jenis_simpanan' => 'required',
        ];

        $validationMessages = [
            'nama_jenis_simpanan' => [
                'required' => 'Nama Jenis Simpanan Wajib Diisi !!!'
            ],
            'jumlah_jenis_simpanan' => [
                'required' => 'Jumlah Jenis Simpanan Wajib Diisi !!!'
            ],
        ];
        if ($this->validate($validationRules, $validationMessages)) {
            $data = array(
                'id_jenis_simpanan' => $id_jenis_simpanan,
                'nama_jenis_simpanan' => $this->request->getPost('nama_jenis_simpanan'),
                'jumlah_jenis_simpanan' => $this->request->getPost('jumlah_jenis_simpanan'),
            );
            $this->ModelJenisSimpanan->update_data($data);
            session()->setFlashdata('update', 'Data Berhasil Di Update !!!');
            return redirect()->to(base_url('jenissimpanan'));
        } else {
            // Jika validasi tidak berhasil
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('jenissimpanan'));
        }
    }

    public function delete($id_jenis_simpanan)
    {
        $data = array(
            'id_jenis_simpanan' => $id_jenis_simpanan,
        );
        $this->ModelJenisSimpanan->delete_data($data);
        session()->setFlashdata('delete', 'Data Berhasil Di Hapus !!!');
        return redirect()->to(base_url('jenissimpanan'));
    }
}
