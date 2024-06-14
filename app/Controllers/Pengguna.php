<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPengguna;
use App\Models\ModelKoperasi;

class Pengguna extends BaseController
{
    public function __construct()
    {
        $this->ModelPengguna = new ModelPengguna();
        $this->ModelKoperasi = new ModelKoperasi();
        helper('form');
    }

    // Menampilkan halaman utama Pengguna
    public function index()
    {
        $koperasiData = $this->ModelKoperasi->all_data();
        $data = [
            'judul' => 'Pengguna',
            'subjudul' => '',
            'menu' => 'Master Data',
            'submenu' => 'Pengguna',
            'page' => 'pengguna/v_index',
            'pengguna' => $this->ModelPengguna->all_data(),
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
        ];
        return view('template/v_template_admin', $data);
    }

    // Menampilkan halaman input data Pengguna
    public function input()
    {
        $koperasiData = $this->ModelKoperasi->all_data();
        $data = [
            'judul' => 'Input Pengguna',
            'subjudul' => 'Input Pengguna',
            'menu' => 'Pengguna',
            'submenu' => 'Input Pengguna',
            'page' => 'pengguna/v_input',
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
        ];
        return view('template/v_template_admin', $data);
    }

    public function insert()
    {
        $validationRules = [
            'username' => 'required',
            'level' => 'required',
            'password' => 'required',
            'nama_lengkap' => 'required',
            'foto_user' => 'uploaded[foto_user]|max_size[foto_user,1024]|mime_in[foto_user,image/png,image/jpg,image/jpeg,image/gif]'
        ];

        $validationMessages = [
            'username' => [
                'required' => 'Username Wajib Diisi !!!'
            ],
            'level' => [
                'required' => 'Level Wajib Diisi !!!'
            ],
            'password' => [
                'required' => 'Password Wajib Diisi !!!'
            ],
            'nama_lengkap' => [
                'required' => 'Nama Pengguna Wajib Diisi !!!'
            ],
            'foto_user' => [
                'uploaded' => 'Foto Pengguna Wajib Diisi !!!',
                'max_size' => 'Ukuran Foto Pengguna Max 1024 KB !!!',
                'mime_in' => 'Format Foto Pengguna Wajib PNG, JPEG, JPG, GIF',
            ]
        ];

        if ($this->validate($validationRules, $validationMessages)) {
            $foto = $this->request->getFile('foto_user');
            $nama_file_foto = $foto->getRandomName();
            $foto->move('foto_user', $nama_file_foto);

            $data = [
                'username' => $this->request->getPost('username'),
                'password' => md5($this->request->getPost('password')),
                'level' => $this->request->getPost('level'),
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'foto_user' => $nama_file_foto,
            ];

            $this->ModelPengguna->insert_data($data);
            session()->setFlashdata('insert', 'Data Berhasil Ditambahkan !!');
            return redirect()->to('Pengguna');
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('pengguna/input'));
        }
    }

    public function edit($id_user)
    {
        $koperasiData = $this->ModelKoperasi->all_data();
        $data = [
            'judul' => 'Edit Pengguna',
            'subjudul' => 'Edit Pengguna',
            'menu' => 'Pengguna',
            'submenu' => 'Edit Pengguna',
            'page' => 'pengguna/v_update',
            'pengguna' => $this->ModelPengguna->detail_data($id_user),
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
        ];
        return view('template/v_template_admin', $data);
    }

    public function update($id_user)
    {
        $validationRules = [
            'username' => 'required',
            'level' => 'required',
            'password' => 'required',
            'nama_lengkap' => 'required',
            'foto_user' => 'max_size[foto_user,1024]|mime_in[foto_user,image/png,image/jpg,image/jpeg,image/gif]'
        ];

        $validationMessages = [
            'username' => [
                'required' => 'Username Wajib Diisi !!!'
            ],
            'level' => [
                'required' => 'Level Wajib Diisi !!!'
            ],
            'password' => [
                'required' => 'Password Wajib Diisi !!!'
            ],
            'nama_lengkap' => [
                'required' => 'Nama Pengguna Wajib Diisi !!!'
            ],
            'foto_user' => [
                'max_size' => 'Ukuran Foto Pengguna Max 1024 KB !!!',
                'mime_in' => 'Format Foto Pengguna Wajib PNG, JPEG, JPG, GIF',
            ]
        ];

        if ($this->validate($validationRules, $validationMessages)) {
            $foto = $this->request->getFile('foto_user');
            $data = [
                'id_user' => $id_user,
                'username' => $this->request->getPost('username'),
                'password' => md5($this->request->getPost('password')),
                'level' => $this->request->getPost('level'),
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            ];

            if (!$foto->getError() == 4) {
                // Menghapus foto lama jika ada
                $user = $this->ModelPengguna->detail_data($id_user);
                if ($user['foto_user'] != "") {
                    unlink('foto_user/' . $user['foto_user']);
                }
                // Membuat nama file baru dan memindahkan file foto
                $nama_file = $foto->getRandomName();
                $foto->move('foto_user', $nama_file);
                $data['foto_user'] = $nama_file;
            }

            $this->ModelPengguna->update_data($data);
            session()->setFlashdata('update', 'Data Berhasil Di Update !!!');
            return redirect()->to('pengguna');
        } else {
            // Jika validasi tidak berhasil
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('pengguna/edit/' . $id_user));
        }
    }


    // public function delete($id_user)
    // {
    //     $pengguna = $this->ModelPengguna->detail_data($id_user);
    //     if ($pengguna['level'] == 1) {
    //         session()->setFlashdata('error', 'Admin Tidak Dapat Menghapus Role Admin.');
    //         return redirect()->to(base_url('pengguna'));
    //     }

    //     // Jika bukan admin, lanjutkan dengan penghapusan
    //     if ($pengguna['foto_user'] != "") {
    //         unlink('foto_user/' . $pengguna['foto_user']);
    //     }

    //     $data = [
    //         'id_user' => $id_user,
    //     ];

    //     $this->ModelPengguna->delete_data($data);
    //     session()->setFlashdata('delete', 'Data Berhasil Di Hapus !!!');
    //     return redirect()->to(base_url('pengguna'));
    // }

    public function delete($id_user)
    {
        // Get details of the user being deleted
        $pengguna = $this->ModelPengguna->detail_data($id_user);

        // Get the ID of the currently logged-in user
        $loggedInUserId = session()->get('id_user');

        // Check if the user being deleted is the currently logged-in user
        if ($pengguna['id_user'] == $loggedInUserId) {
            session()->setFlashdata('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            return redirect()->to(base_url('pengguna'));
        }

        // If the user being deleted is not the currently logged-in user, proceed with deletion
        if ($pengguna['foto_user'] != "") {
            unlink('foto_user/' . $pengguna['foto_user']);
        }

        $data = [
            'id_user' => $id_user,
        ];

        $this->ModelPengguna->delete_data($data);
        session()->setFlashdata('delete', 'Data Berhasil Di Hapus !!!');
        return redirect()->to(base_url('pengguna'));
    }
}
