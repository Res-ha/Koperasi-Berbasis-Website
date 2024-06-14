<!-- app/Views/laporan/pdf_template.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        h3 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Divider */
        .divider {
            width: 100%;
            height: 2px;
            background-color: #ddd;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 10px;
            border-top: 1px solid #ddd;
        }
    </style>
    <!-- Include any additional styles or scripts here -->
</head>

<body>
    <div class="container">
        <h3>Data Anggota</h3>

        <!-- Divider -->
        <div class="divider"></div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Fakultas</th>
                    <th>Nama</th>
                    <th>Gender</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_anggota as $key => $value) : ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $value['kode_fakultas'] ?></td>
                        <td><?= $value['nama_anggota'] ?></td>
                        <td><?= ($value['jenis_kelamin'] == 'L') ? 'Laki-Laki' : 'Perempuan'; ?></td>
                        <td><?= ($value['status'] == 'Aktif') ? 'Aktif' : 'Tidak Aktif'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

   
</body>

</html>