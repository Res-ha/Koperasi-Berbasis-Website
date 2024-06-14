<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelHome;
use App\Models\ModelKoperasi;

class Home extends BaseController
{

    public function __construct()
    {
        // $this->ModelKoperasi = new ModelKoperasi();
        $this->ModelHome = new ModelHome();
        $this->ModelKoperasi = new ModelKoperasi();
        helper('form');
    }

    public function index()
    {
        $koperasiData = $this->ModelKoperasi->all_data();
        $data = [
            'judul'    => 'Login',
            'subjudul' => '',
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
        ];

        // if (session('level')) {
        //     return redirect()->to(site_url('dashboard'));
        // }
        return view('v_home', $data);
    }

    public function login()
    {
        if ($this->validate([
            'username'  => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'level'  => [
                'label' => 'Level',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
        ])) {
            //jika valid
            $username = $this->request->getPost('username');
            $password = md5($this->request->getPost('password'));
            $level = $this->request->getPost('level');
            $cekLogin = $this->ModelHome->Login($username, $password, $level);
            if ($cekLogin) {
                // Simpan data pengguna ke session
                session()->set('id_user', $cekLogin['id_user']);
                session()->set('level', $cekLogin['level']);
                session()->set('nama_lengkap', $cekLogin['nama_lengkap']);
                session()->set('foto_user', $cekLogin['foto_user']);
                return redirect()->to('Dashboard');
            } else {
                session()->setFlashdata('pesan', 'Username / Level / Password Salah  !!!');
                return redirect()->to('Home');
            }
        } else {
            //jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('home'));
        }
    }

    public function logout()
    {
        // Menghapus variabel sesi individu (jika diperlukan)
        session()->remove(['nama_lengkap', 'username', 'level', 'foto_user']);

        // Mengatur flash data
        session()->setFlashdata('pesan', 'Anda Berhasil Logout !!');

        // Mengarahkan setelah menghancurkan sesi
        return redirect()->to(base_url('home'));
    }
}
