<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPinjaman;
use App\Models\ModelKoperasi;
use App\Models\ModelAnggota;
use App\Models\ModelBunga;

class Pinjaman extends BaseController
{

    public function __construct()
    {
        $this->ModelPinjaman = new ModelPinjaman();
        $this->ModelKoperasi = new ModelKoperasi();
        $this->ModelAnggota = new ModelAnggota();
        $this->ModelBunga = new ModelBunga();
        helper('form');
    }

    public function index()
    {
        $koperasiData = $this->ModelKoperasi->all_data();
        $data = [
            'judul'     => 'Pinjaman & Angsuran',
            'subjudul'  => '',
            'menu'      => 'Transaksi',
            'submenu'   => 'Pinjaman & Angsuran',
            'page'      => 'pinjaman/v_index',
            'id_pinjaman' => $this->ModelPinjaman->pinjaman(),
            'pinjaman'  => $this->ModelPinjaman->all_data(),
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
        ];
        return view('template/v_template_admin', $data);
    }

    public function detail($id_pinjaman)
    {
        $koperasiData = $this->ModelKoperasi->all_data();
        $data = [
            'judul'           => 'Detail Pinjaman & Angsuran',
            'subjudul'        => '',
            'menu'            => 'Pinjaman',
            'submenu'         => 'Detail Pinjaman & Angsuran',
            'page'            => 'pinjaman/v_detail',
            'data_pinjaman' => $this->ModelPinjaman->detail_pinjaman(),
            'anggota' => $this->ModelPinjaman->data_anggota($id_pinjaman),
            'detail_pinjaman' => $this->ModelPinjaman->getPinjamanByIdAnggota($id_pinjaman),
            'nama_koperasi'   => $koperasiData[0]['nama_koperasi'],
        ];
        return view('template/v_template_admin', $data);
    }

    public function update_status($id_detail_pinjaman, $id_pinjaman)
    {
        $validationRules = [
            'status_detail_pinjaman' => 'required',
        ];

        $validationMessages = [
            'status_detail_pinjaman' => [
                'required' => 'Status Detail Pinjaman Wajib Diisi !!!'
            ],
        ];
        if ($this->validate($validationRules, $validationMessages)) {
            $data = array(
                'id_detail_pinjaman' => $id_detail_pinjaman,
                'status_detail_pinjaman' => $this->request->getPost('status_detail_pinjaman'),
            );
            $this->ModelPinjaman->update_detail_pinjaman($data);
            session()->setFlashdata('update', 'Data Berhasil Di Update !!!');
            return redirect()->to('pinjaman/detail/' . $id_pinjaman);
        } else {
            // Jika validasi tidak berhasil
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('pinjaman/detail/' . $id_pinjaman);
        }
    }

    public function input()
    {
        $koperasiData = $this->ModelKoperasi->all_data();
        $bunga_koperasi = $this->ModelBunga->all_data();
        $data = [
            'judul'     => 'Tambah Pinjaman & Angsuran',
            'subjudul'  => 'Tambah Pinjaman & Angsuran',
            'menu'      => 'Pinjaman & Angsuran',
            'submenu'   => 'Tambah Pinjaman & Angsuran',
            'page'      => 'pinjaman/v_input',
            'anggota'  => $this->ModelAnggota->all_data(),
            'bunga_koperasi'  => $bunga_koperasi[0]['besaran_bunga'],
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
        ];
        return view('template/v_template_admin', $data);
    }

    public function insert()
    {
        $validationRules = [
            'id_anggota' => 'required',
            'tanggal_pengajuan' => 'required',
            'jumlah_pinjaman' => 'required',
            // 'bunga_pinjaman' => 'required',
            'tenor_pinjaman' => 'required',
            'status_pinjaman' => 'required',
        ];

        $validationMessages = [
            'id_anggota' => [
                'required' => 'Nama Anggota Wajib Diisi !!!'
            ],
            'tanggal_pengajuan' => [
                'required' => 'Tanggal Pengajuan Wajib Diisi !!!'
            ],
            'jumlah_pinjaman' => [
                'required' => 'Jumlah Pinjaman Wajib Diisi !!!'
            ],
            // 'bunga_pinjaman' => [
            //     'required' => 'Bunga Pinjaman Wajib Diisi !!!'
            // ],
            'tenor_pinjaman' => [
                'required' => 'Tenor Pinjaman Wajib Diisi !!!'
            ],
            'status_pinjaman' => [
                'required' => 'Status Pinjaman Wajib Diisi !!!'
            ],
        ];

        if ($this->validate($validationRules, $validationMessages)) {
            $bunga_koperasi =  $this->ModelBunga->all_data();
            // Retrieve data from the form
            $data_pinjaman = [
                'id_anggota' => $this->request->getPost('id_anggota'),
                'tanggal_pengajuan' => $this->request->getPost('tanggal_pengajuan'),
                'jumlah_pinjaman' => $this->request->getPost('jumlah_pinjaman'),
                'bunga_pinjaman' => $bunga_koperasi[0]['besaran_bunga'],
                'tenor_pinjaman' => $this->request->getPost('tenor_pinjaman'),
                'status_pinjaman' => $this->request->getPost('status_pinjaman'),
            ];

            // Call the model function to insert data into the database
            $id_pinjaman = $this->ModelPinjaman->insert_data_pinjaman($data_pinjaman);

            // Menghitung angsuran_bunga, total_angsuran, dan sisa_pinjaman
            $pinjaman_awal = floatval($data_pinjaman['jumlah_pinjaman']);
            $tenor = intval($data_pinjaman['tenor_pinjaman']);
            $bunga = floatval($data_pinjaman['bunga_pinjaman']);
            $tanggal_pengajuan = new \DateTime($data_pinjaman['tanggal_pengajuan']);
            $sisa_pinjaman = $pinjaman_awal;
            $angsuran_pokok = $pinjaman_awal / $tenor;

            // Mulai dari bulan setelah bulan pengajuan
            $tanggal_mulai = clone $tanggal_pengajuan;
            // Maju satu bulan dari tanggal_pengajuan
            $tanggal_mulai->add(new \DateInterval('P1M'));
            for ($bulan = 1; $bulan <= $tenor; $bulan++) {
                // Format tanggal sesuai dengan database (jika menggunakan MySQL)
                $formatted_date = $tanggal_mulai->format('Y-m-d');
                $angsuran_bunga = $sisa_pinjaman * $bunga;
                $total_angsuran = $angsuran_pokok + $angsuran_bunga;
                $sisa_pinjaman -= $angsuran_pokok;

                // Data untuk disimpan ke database
                $data_detail = [
                    'id_pinjaman' => $id_pinjaman,
                    'bulan' => $bulan,
                    'tanggal_detail_pinjaman' => $formatted_date,
                    'sisa_pinjam' => $sisa_pinjaman,
                    'bunga' => $bunga,
                    'angsuran_pokok' => $angsuran_pokok,
                    'angsuran_bunga' => $angsuran_bunga,
                    'total_angsuran' => $total_angsuran,
                    'status_detail_pinjaman' => $data_pinjaman['status_pinjaman'],
                ];

                $this->ModelPinjaman->insert_detail_pinjaman($data_detail);
                // Tambah satu bulan untuk tanggal selanjutnya
                $tanggal_mulai->add(new \DateInterval('P1M'));
            }

            // Set flash data for success message
            session()->setFlashdata('insert', 'Data Berhasil Ditambahkan !!!');
            return redirect()->to('pinjaman');
        } else {
            // Jika validasi gagal, set flash data untuk error dan redirect kembali ke form dengan input sebelumnya
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('pinjaman/input')->withInput();
        }
    }

    public function update($id_pinjaman)
    {
        $validationRules = [
            'status_pinjaman' => 'required',
        ];

        $validationMessages = [
            'status_pinjaman' => [
                'required' => 'Status Pinjaman Wajib Diisi !!!'
            ],
        ];
        if ($this->validate($validationRules, $validationMessages)) {
            $data = array(
                'id_pinjaman' => $id_pinjaman,
                'status_pinjaman' => $this->request->getPost('status_pinjaman'),
            );
            $this->ModelPinjaman->update_pinjaman($data);
            session()->setFlashdata('update', 'Data Berhasil Di Update !!!');
            return redirect()->to('pinjaman');
        } else {
            // Jika validasi tidak berhasil
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to('pinjaman');
        }
    }

    public function delete($id_pinjaman)
    {
        $data = array(
            'id_pinjaman' => $id_pinjaman,
        );
        $this->ModelPinjaman->delete_data($data);
        session()->setFlashdata('delete', 'Data Berhasil Di Hapus !!!');
        return redirect()->to(base_url('pinjaman'));
    }
}
