<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAnggota;
use App\Models\ModelFakultas;
use App\Models\ModelKoperasi;

class Anggota extends BaseController
{

    public function __construct()
    {
        $this->ModelAnggota = new ModelAnggota();
        $this->ModelFakultas = new ModelFakultas();
        $this->ModelKoperasi = new ModelKoperasi();
        helper('form');
    }

    // Menampilkan daftar anggota
    public function index()
    {
        $koperasiData = $this->ModelKoperasi->all_data();
        $fakultasData = $this->ModelFakultas->all_data();
        $data = [
            'judul' => 'Anggota',
            'subjudul' => '',
            'menu' => 'Master Data',
            'submenu' => 'Anggota',
            'page' => 'anggota/v_index',
            'anggota' => $this->ModelAnggota->all_data(),
            'fakultasData' => $fakultasData,
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
        ];
        return view('template/v_template_admin', $data);
    }

    // Menampilkan daftar anggota berdasarkann fakultas
    public function anggota_by_fakultas($id_fakultas)
    {
        $koperasiData = $this->ModelKoperasi->all_data();

        // Fetch anggota data by fakultas
        $anggota_by_fakultas = $this->ModelAnggota->anggota_by_fakultas($id_fakultas);

        $data = [
            'judul' => 'Anggota', // Assuming 'nama_fakultas' is a column in tbl_fakultas
            'subjudul' => '',
            'menu' => 'Master Data',
            'submenu' => 'Anggota',
            'page' => 'anggota/v_anggota_fakultas',
            'anggota_by_fakultas' => $anggota_by_fakultas,
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
        ];

        return view('template/v_template_admin', $data);
    }

    // Menampilkan halaman input anggota
    public function input()
    {
        $koperasiData = $this->ModelKoperasi->all_data();
        $data = [
            'judul' => 'Tambah Anggota',
            'subjudul' => 'Tambah Anggota',
            'menu' => 'Anggota',
            'submenu' => 'Tambah Anggota',
            'page' => 'anggota/v_input',
            'fakultas' => $this->ModelFakultas->all_data(),
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
        ];
        return view('template/v_template_admin', $data);
    }

    // Memproses input data anggota
    public function insert()
    {
        // Validasi input data
        if ($this->validate([
            'id_fakultas' => [
                'label'  => 'Fakultas',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'nama_anggota' => [
                'label'  => 'Nama Anggota',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'alamat_anggota' => [
                'label'  => 'Alamat Anggota',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'no_tlpn' => [
                'label'  => 'No Telepon Anggota',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'jenis_kelamin' => [
                'label'  => 'Jenis Kelamin',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'tanggal_gabung' => [
                'label'  => 'Tanggal Bergabung',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'status' => [
                'label'  => 'Status Anggota',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
        ])) {
            $data = [
                'id_fakultas' => $this->request->getPost('id_fakultas'),
                'nama_anggota' => $this->request->getPost('nama_anggota'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'alamat_anggota' => $this->request->getPost('alamat_anggota'),
                'no_tlpn' => $this->request->getPost('no_tlpn'),
                'tanggal_gabung' => $this->request->getPost('tanggal_gabung'),
                'status' => $this->request->getPost('status'),
            ];
            $this->ModelAnggota->insert_data($data);
            session()->setFlashdata('insert', 'Data Berhasil Ditambahkan !!');
            return redirect()->to('anggota');
        } else {
            //jika validasi gagal
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('anggota/input')->withInput('validation', \Config\Services::validation());
        }
    }

    // Menampilkan halaman update anggota
    public function edit($id_anggota)
    {
        $koperasiData = $this->ModelKoperasi->all_data();
        $data = [
            'judul' => 'Edit Anggota',
            'subjudul' => 'Edit Anggota',
            'menu' => 'Anggota',
            'submenu' => 'Edit Anggota',
            'page' => 'anggota/v_update',
            'fakultas' => $this->ModelFakultas->all_data(),
            'anggota' => $this->ModelAnggota->detail_data($id_anggota),
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
        ];
        return view('template/v_template_admin', $data);
    }

    public function update($id_anggota)
    {
        // Validasi input data
        if ($this->validate([
            'id_fakultas' => [
                'label'  => 'Fakultas',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'nama_anggota' => [
                'label'  => 'Nama Anggota',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'alamat_anggota' => [
                'label'  => 'Alamat Anggota',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'no_tlpn' => [
                'label'  => 'No Telepon Anggota',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'jenis_kelamin' => [
                'label'  => 'Jenis Kelamin',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'tanggal_gabung' => [
                'label'  => 'Tanggal Bergabung',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'status' => [
                'label'  => 'Status Anggota',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
        ])) {
            // Ambil data dari form
            $data = [
                'id_anggota' => $id_anggota,
                'id_fakultas' => $this->request->getPost('id_fakultas'),
                'nama_anggota' => $this->request->getPost('nama_anggota'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'alamat_anggota' => $this->request->getPost('alamat_anggota'),
                'no_tlpn' => $this->request->getPost('no_tlpn'),
                'tanggal_gabung' => $this->request->getPost('tanggal_gabung'),
                'status' => $this->request->getPost('status'),
            ];
            // Update data ke database
            $this->ModelAnggota->update_data($data);
            session()->setFlashdata('update', 'Data Berhasil Diupdate');
            return redirect()->to('anggota');
        } else {
            //jika Tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('anggota/edit/' . $id_anggota));
        }
    }

    // Menghapus data anggota
    public function delete($id_anggota)
    {
        $data = array(
            'id_anggota' => $id_anggota,
        );
        $this->ModelAnggota->delete_data($data);
        session()->setFlashdata('delete', 'Data Berhasil Di Hapus !!!');
        return redirect()->to(base_url('anggota'));
    }

    public function import()
    {
        $file = $this->request->getFile('file_excel');
        $ext = $file->getClientExtension();

        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $render->load($file);
        $sheet = $spreadsheet->getActiveSheet()->toArray();

        foreach ($sheet as $x => $excel) {
            // Skip header data
            if ($x == 0) {
                continue;
            }

            // Check if data with the same "nama_anggota" exists
            $nama = $this->ModelAnggota->cekData($excel['2']);
            if ($nama) {
                // Set flash message for duplicate data
                session()->setFlashdata('import_duplicate', 'Data Skipped: Duplicate data found for ' . $excel['2']);
                continue;
            }

            $data = [
                'id_fakultas' => $excel['1'],
                'nama_anggota' => $excel['2'],
                'alamat_anggota' => $excel['3'],
                'no_tlpn' => $excel['4'],
                'jenis_kelamin' => $excel['5'],
                'tanggal_gabung' => $excel['6'], // Correct index for 'tanggal_gabung'
                'status' => $excel['7'], // Assuming 'status' is at index 7, update accordingly
            ];

            $this->ModelAnggota->import($data);
        }

        // Set flash message for successful import
        session()->setFlashdata('import', 'Data Berhasil Di Import !!!');
        return redirect()->to(base_url('anggota'));
    }
}
