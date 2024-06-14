<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelLaporan;
use App\Models\ModelAnggota;
use App\Models\ModelKoperasi;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;


class Laporan extends BaseController
{
    public function __construct()
    {
        $this->ModelKoperasi = new ModelKoperasi();
        $this->ModelAnggota = new ModelAnggota();
        $this->ModelLaporan = new ModelLaporan();
        helper('form');
    }

    // laporan anggota
    public function laporan_anggota()
    {
        $koperasiData = $this->ModelKoperasi->all_data();
        $data = [
            'judul' => 'Laporan Anggota',
            'subjudul' => '',
            'menu' => 'Laporan',
            'submenu' => 'Laporan Anggota',
            'page' => 'laporan/laporan_anggota/v_index',
            'data_anggota' => $this->ModelLaporan->data_anggota(),
            'jumlah_anggota' => $this->ModelLaporan->jumlah_anggota(),
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
        ];
        return view('template/v_template_admin', $data);
    }

    public function export_anggota_all_data()
    {
        $data_anggota = $this->ModelLaporan->data_anggota();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header style
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => '000000'], // Warna teks header
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFFF00'], // Warna kuning
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        // Set header
        $header = ['No', 'Kode Fakultas', 'Nama', 'Alamat', 'No Telepon', 'Gender', 'Bergabung',  'Status'];
        $sheet->fromArray([$header], null, 'A1');
        $sheet->getStyle('A1:H1')->applyFromArray($headerStyle); // Apply header style

        // Set data
        $row = 2;
        $no = 1;
        foreach ($data_anggota as $value) {
            $data = [
                $no++,
                $value['kode_fakultas'],
                $value['nama_anggota'],
                $value['alamat_anggota'],
                $value['no_tlpn'],
                ($value['jenis_kelamin'] == 'L') ? 'Laki-Laki' : 'Perempuan',
                $value['tanggal_gabung'],
                ($value['status'] == 'Aktif') ? 'Aktif' : 'Tidak Aktif'
            ];
            $sheet->fromArray([$data], null, 'A' . $row);
            $row++;
        }

        // Auto size columns
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Auto size rows
        foreach ($sheet->getRowDimensions() as $rd) {
            $rd->setRowHeight(-1);
        }

        // Add auto filter to the header row
        $sheet->setAutoFilter('A1:H1');

        $writer = new Xlsx($spreadsheet);
        $filename = 'Data_Anggota.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function print_pdf()
    {
        // Load the data
        $data['data_anggota'] = $this->ModelLaporan->data_anggota();

        // Load the Dompdf library
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);

        // Load the HTML view
        $html = view('laporan/laporan_anggota/pdf_template.php', $data);

        // Load the HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size (A4)
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (first pass to get total pages)
        $dompdf->render();

        // Stream the file
        $dompdf->stream('laporan_data.pdf', array('Attachment' => 0));
    }

    // lapran simpanan
    public function laporan_simpanan()
    {
        $koperasiData = $this->ModelKoperasi->all_data();
        $data = [
            'judul' => 'Laporan Simpanan',
            'subjudul' => '',
            'menu' => 'Laporan',
            'submenu' => 'Laporan Simpanan',
            'page' => 'laporan/laporan_simpanan/v_index',
            'anggota' => $this->ModelAnggota->all_data(),
            // 'data_anggota' => $this->ModelLaporan->data_anggota(),
            // 'data_simpanan' => $this->ModelLaporan->data_simpanan(),
            'all_data_simpanan' => $this->ModelLaporan->all_data_simpanan(),
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
        ];
        return view('template/v_template_admin', $data);
    }

    public function export_simpanan_by_anggota()
    {
        // Get the form data
        $tahun = $this->request->getPost('tahun');
        $id_anggota = $this->request->getPost('id_anggota');

        // Fetch data from the models based on the selected year and member ID
        $anggotaData = $this->ModelLaporan->getAnggotaById($id_anggota);
        $simpananData = $this->ModelLaporan->getSimpananByAnggota($id_anggota, $tahun);

        if (empty($anggotaData)) {
            // Handle the case where no member data is found, perhaps show an error message
            session()->setFlashdata('gagal', 'Data Anggota Tidak Ada !!');
            return redirect()->to('laporan/laporan_simpanan');
        }

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers in the Excel file with styling
        $sheet->setCellValue('A1', 'Kode Fakultas')->getStyle('A1')->getFont()->setBold(true);
        $sheet->setCellValue('B1', 'Nama Anggota')->getStyle('B1')->getFont()->setBold(true);

        // Set month headers dynamically with styling
        $months = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $colIndex = 3;
        foreach ($months as $month) {
            $sheet->setCellValueByColumnAndRow($colIndex, 1, $month)->getStyleByColumnAndRow($colIndex, 1)->getFont()->setBold(true);
            $colIndex++;
        }

        // Fill data into the Excel file
        $rowIndex = 2;
        foreach ($anggotaData as $data) {
            $sheet->setCellValue('A' . $rowIndex, $data['kode_fakultas']);
            $sheet->setCellValue('B' . $rowIndex, $data['nama_anggota']);

            // Initialize total savings for each member
            $totalSavings = 0;

            $colIndex = 3;
            foreach ($months as $month) {
                // Get the savings for each month (you need to adjust this based on your data structure)
                $monthSavings = $this->ModelLaporan->getSavingsForMonth($id_anggota, $month, $tahun);

                // Add the savings for the month to the total savings
                $totalSavings += $monthSavings ? $monthSavings['total_jumlah_simpanan'] : 0;

                // Set the total savings for the month in the Excel file
                $sheet->setCellValueByColumnAndRow($colIndex, $rowIndex, $totalSavings);
                $colIndex++;
            }

            $rowIndex++;
        }

        // Set styling for the table
        $highestColumn = $sheet->getHighestColumn();
        $highestRow = $sheet->getHighestRow();

        // Add borders to the table
        $sheet->getStyle('A1:' . $highestColumn . $highestRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Set yellow background color for the header
        $sheet->getStyle('A1:' . $highestColumn . '1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');

        // Enable auto-filter for the header row
        $sheet->setAutoFilter('A1:' . $highestColumn . '1');

        // Set the filename for download
        $filename = 'laporan_simpanan_' . $anggotaData[0]['nama_anggota'] . '_' . $tahun . '.xlsx';

        // Set the MIME type and send the file to the browser for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }

    public function export_simpanan_all_data()
    {
        // Fetch data from the model
        $data = $this->ModelLaporan->all_data_simpanan();

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Add a worksheet
        $sheet = $spreadsheet->getActiveSheet();

        // Set the column headers with yellow background
        $sheet->getStyle('A1:F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Fakultas');
        $sheet->setCellValue('C1', 'Nama Anggota');
        $sheet->setCellValue('D1', 'Tanggal Simpanan');
        $sheet->setCellValue('E1', 'Nama Jenis Simpanan');
        $sheet->setCellValue('F1', 'Nominal Simpanan');

        // Populate the spreadsheet with data
        $row = 2;
        $totalSimpanan = 0; // Initialize total savings
        foreach ($data as $row_data) {
            $sheet->setCellValue('A' . $row, $row - 1); // Adjusted to start from 1
            $sheet->setCellValue('B' . $row, $row_data['kode_fakultas']);
            $sheet->setCellValue('C' . $row, $row_data['nama_anggota']);
            $sheet->setCellValue('D' . $row, $row_data['tanggal_simpanan']);
            $sheet->setCellValue('E' . $row, $row_data['nama_jenis_simpanan']);
            $sheet->setCellValue('F' . $row, 'Rp ' . number_format($row_data['jumlah_jenis_simpanan'], 0, ',', '.'));

            $totalSimpanan += $row_data['jumlah_jenis_simpanan']; // Accumulate total savings

            $row++;
        }

        // Add a row for Total Simpanan
        $sheet->setCellValue('E' . $row, 'Total Simpanan');
        $sheet->setCellValue('F' . $row, 'Rp ' . number_format($totalSimpanan, 0, ',', '.')); // Display total with Rp format

        // Set autofilter for the entire worksheet
        $lastColumn = $sheet->getHighestColumn();
        $lastRow = $sheet->getHighestRow();
        $sheet->setAutoFilter('A1:' . $lastColumn . $lastRow);

        // Set auto size for all columns
        foreach (range('A', $lastColumn) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Set the filename
        $filename = 'simpanan_data_export.xlsx';

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    // laporan Simpanan
    public function laporan_pinjaman()
    {
        $koperasiData = $this->ModelKoperasi->all_data();
        $data = [
            'judul' => 'Laporan Pinjaman',
            'subjudul' => '',
            'menu' => 'Laporan',
            'submenu' => 'Laporan Pinjaman',
            'page' => 'laporan/laporan_pinjaman/v_index',
            'all_data_pinjaman'  => $this->ModelLaporan->pinjaman_all_data(),
            'telat_data_pinjaman'  => $this->ModelLaporan->pinjaman_telat(),
            'nama_koperasi' => $koperasiData[0]['nama_koperasi'],
        ];
        return view('template/v_template_admin', $data);
    }

    public function export_pinjaman_all_data()
    {
        // Fetch data from the model
        $data = $this->ModelLaporan->pinjaman_all_data();

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Add a worksheet
        $sheet = $spreadsheet->getActiveSheet();

        // Set the column headers with yellow background
        $sheet->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Fakultas');
        $sheet->setCellValue('C1', 'Nama Anggota');
        $sheet->setCellValue('D1', 'Tanggal Pengajuan');
        $sheet->setCellValue('E1', 'Tanggal Pembayaran');
        $sheet->setCellValue('F1', 'Jumlah Pinjaman');
        $sheet->setCellValue('G1', 'Bunga');
        $sheet->setCellValue('H1', 'Total Angsuran');
        $sheet->setCellValue('I1', 'Status Pinjaman');

        // Populate the spreadsheet with data
        $row = 2;
        $totalSimpanan = 0; // Initialize total savings
        foreach ($data as $row_data) {
            $sheet->setCellValue('A' . $row, $row - 1); // Adjusted to start from 1
            $sheet->setCellValue('B' . $row, $row_data['kode_fakultas']);
            $sheet->setCellValue('C' . $row, $row_data['nama_anggota']);
            $sheet->setCellValue('D' . $row, $row_data['tanggal_pengajuan']);
            $sheet->setCellValue('E' . $row, $row_data['tanggal_detail_pinjaman']);
            $sheet->setCellValue('F' . $row, 'Rp ' . number_format($row_data['jumlah_pinjaman'], 0, ',', '.'));
            $sheet->setCellValue('G' . $row, $row_data['bunga_pinjaman'] * 100 . '%'); // Bunga dalam bentuk persen
            $sheet->setCellValue('H' . $row, 'Rp ' . number_format($row_data['total_angsuran'], 0, ',', '.'));
            $sheet->setCellValue('I' . $row, $row_data['status_detail_pinjaman']);

            // Uncomment the following line if you want to accumulate total savings
            // $totalSimpanan += $row_data['jumlah_jenis_simpanan']; 
            $row++;
        }

        // Add a row for Total Simpanan (uncomment if needed)
        // $sheet->setCellValue('E' . $row, 'Total Simpanan');
        // $sheet->setCellValue('F' . $row, 'Rp ' . number_format($totalSimpanan, 0, ',', '.')); // Display total with Rp format

        // Set autofilter for the entire worksheet
        $lastColumn = $sheet->getHighestColumn();
        $lastRow = $sheet->getHighestRow();
        $sheet->setAutoFilter('A1:' . $lastColumn . $lastRow);

        // Set auto size for all columns
        foreach (range('A', $lastColumn) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Set the filename
        $filename = 'pinjaman_data_export.xlsx';

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function export_pinjaman_telat()
    {
        // Fetch data from the model
        $data = $this->ModelLaporan->pinjaman_telat();

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Add a worksheet
        $sheet = $spreadsheet->getActiveSheet();

        // Set the column headers with yellow background
        $sheet->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Fakultas');
        $sheet->setCellValue('C1', 'Nama Anggota');
        $sheet->setCellValue('D1', 'Tanggal Pengajuan');
        $sheet->setCellValue('E1', 'Tanggal Pembayaran');
        $sheet->setCellValue('F1', 'Jumlah Pinjaman');
        $sheet->setCellValue('G1', 'Bunga');
        $sheet->setCellValue('H1', 'Total Angsuran');
        $sheet->setCellValue('I1', 'Status Pinjaman');

        // Populate the spreadsheet with data
        $row = 2;
        $totalSimpanan = 0; // Initialize total savings
        foreach ($data as $row_data) {
            $sheet->setCellValue('A' . $row, $row - 1); // Adjusted to start from 1
            $sheet->setCellValue('B' . $row, $row_data['kode_fakultas']);
            $sheet->setCellValue('C' . $row, $row_data['nama_anggota']);
            $sheet->setCellValue('D' . $row, $row_data['tanggal_pengajuan']);
            $sheet->setCellValue('E' . $row, $row_data['tanggal_detail_pinjaman']);
            $sheet->setCellValue('F' . $row, 'Rp ' . number_format($row_data['jumlah_pinjaman'], 0, ',', '.'));
            $sheet->setCellValue('G' . $row, $row_data['bunga_pinjaman'] * 100 . '%'); // Bunga dalam bentuk persen
            $sheet->setCellValue('H' . $row, 'Rp ' . number_format($row_data['total_angsuran'], 0, ',', '.'));
            $sheet->setCellValue('I' . $row, $row_data['status_detail_pinjaman']);

            // Uncomment the following line if you want to accumulate total savings
            // $totalSimpanan += $row_data['jumlah_jenis_simpanan']; 
            $row++;
        }

        // Add a row for Total Simpanan (uncomment if needed)
        // $sheet->setCellValue('E' . $row, 'Total Simpanan');
        // $sheet->setCellValue('F' . $row, 'Rp ' . number_format($totalSimpanan, 0, ',', '.')); // Display total with Rp format

        // Set autofilter for the entire worksheet
        $lastColumn = $sheet->getHighestColumn();
        $lastRow = $sheet->getHighestRow();
        $sheet->setAutoFilter('A1:' . $lastColumn . $lastRow);

        // Set auto size for all columns
        foreach (range('A', $lastColumn) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Set the filename
        $filename = 'pinjaman_data_telat_export.xlsx';

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function export_pinjaman_lunas()
    {
        // Fetch data from the model
        $data = $this->ModelLaporan->pinjaman_lunas();

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Add a worksheet
        $sheet = $spreadsheet->getActiveSheet();

        // Set the column headers with yellow background
        $sheet->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Fakultas');
        $sheet->setCellValue('C1', 'Nama Anggota');
        $sheet->setCellValue('D1', 'Tanggal Pengajuan');
        $sheet->setCellValue('E1', 'Tanggal Pembayaran');
        $sheet->setCellValue('F1', 'Jumlah Pinjaman');
        $sheet->setCellValue('G1', 'Bunga');
        $sheet->setCellValue('H1', 'Total Angsuran');
        $sheet->setCellValue('I1', 'Status Pinjaman');

        // Populate the spreadsheet with data
        $row = 2;
        $totalSimpanan = 0; // Initialize total savings
        foreach ($data as $row_data) {
            $sheet->setCellValue('A' . $row, $row - 1); // Adjusted to start from 1
            $sheet->setCellValue('B' . $row, $row_data['kode_fakultas']);
            $sheet->setCellValue('C' . $row, $row_data['nama_anggota']);
            $sheet->setCellValue('D' . $row, $row_data['tanggal_pengajuan']);
            $sheet->setCellValue('E' . $row, $row_data['tanggal_detail_pinjaman']);
            $sheet->setCellValue('F' . $row, 'Rp ' . number_format($row_data['jumlah_pinjaman'], 0, ',', '.'));
            $sheet->setCellValue('G' . $row, $row_data['bunga_pinjaman'] * 100 . '%'); // Bunga dalam bentuk persen
            $sheet->setCellValue('H' . $row, 'Rp ' . number_format($row_data['total_angsuran'], 0, ',', '.'));
            $sheet->setCellValue('I' . $row, $row_data['status_detail_pinjaman']);

            // Uncomment the following line if you want to accumulate total savings
            // $totalSimpanan += $row_data['jumlah_jenis_simpanan']; 
            $row++;
        }

        // Add a row for Total Simpanan (uncomment if needed)
        // $sheet->setCellValue('E' . $row, 'Total Simpanan');
        // $sheet->setCellValue('F' . $row, 'Rp ' . number_format($totalSimpanan, 0, ',', '.')); // Display total with Rp format

        // Set autofilter for the entire worksheet
        $lastColumn = $sheet->getHighestColumn();
        $lastRow = $sheet->getHighestRow();
        $sheet->setAutoFilter('A1:' . $lastColumn . $lastRow);

        // Set auto size for all columns
        foreach (range('A', $lastColumn) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Set the filename
        $filename = 'pinjaman_data_lunas_export.xlsx';

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function export_pinjaman_belum_lunas()
    {
        // Fetch data from the model
        $data = $this->ModelLaporan->pinjaman_belum_lunas();

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Add a worksheet
        $sheet = $spreadsheet->getActiveSheet();

        // Set the column headers with yellow background
        $sheet->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Fakultas');
        $sheet->setCellValue('C1', 'Nama Anggota');
        $sheet->setCellValue('D1', 'Tanggal Pengajuan');
        $sheet->setCellValue('E1', 'Tanggal Pembayaran');
        $sheet->setCellValue('F1', 'Jumlah Pinjaman');
        $sheet->setCellValue('G1', 'Bunga');
        $sheet->setCellValue('H1', 'Total Angsuran');
        $sheet->setCellValue('I1', 'Status Pinjaman');

        // Populate the spreadsheet with data
        $row = 2;
        $totalSimpanan = 0; // Initialize total savings
        foreach ($data as $row_data) {
            $sheet->setCellValue('A' . $row, $row - 1); // Adjusted to start from 1
            $sheet->setCellValue('B' . $row, $row_data['kode_fakultas']);
            $sheet->setCellValue('C' . $row, $row_data['nama_anggota']);
            $sheet->setCellValue('D' . $row, $row_data['tanggal_pengajuan']);
            $sheet->setCellValue('E' . $row, $row_data['tanggal_detail_pinjaman']);
            $sheet->setCellValue('F' . $row, 'Rp ' . number_format($row_data['jumlah_pinjaman'], 0, ',', '.'));
            $sheet->setCellValue('G' . $row, $row_data['bunga_pinjaman'] * 100 . '%'); // Bunga dalam bentuk persen
            $sheet->setCellValue('H' . $row, 'Rp ' . number_format($row_data['total_angsuran'], 0, ',', '.'));
            $sheet->setCellValue('I' . $row, $row_data['status_detail_pinjaman']);

            // Uncomment the following line if you want to accumulate total savings
            // $totalSimpanan += $row_data['jumlah_jenis_simpanan']; 
            $row++;
        }

        // Add a row for Total Simpanan (uncomment if needed)
        // $sheet->setCellValue('E' . $row, 'Total Simpanan');
        // $sheet->setCellValue('F' . $row, 'Rp ' . number_format($totalSimpanan, 0, ',', '.')); // Display total with Rp format

        // Set autofilter for the entire worksheet
        $lastColumn = $sheet->getHighestColumn();
        $lastRow = $sheet->getHighestRow();
        $sheet->setAutoFilter('A1:' . $lastColumn . $lastRow);

        // Set auto size for all columns
        foreach (range('A', $lastColumn) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Set the filename
        $filename = 'pinjaman_data_belum_lunas_export.xlsx';

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
