<div class="col-12">
    <div class="card">
        <div class="card-header d-flex p-0">
            <h3 class="card-title p-3">Data Semua Pinjaman</h3>
            <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item">
                    <a class="nav-link active" href="#semua" data-toggle="tab">Semua</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#telat" data-toggle="tab">Telat</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Export Data Pinjaman
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= base_url('laporan/export_pinjaman_all_data'); ?>"><i class="fas fa-download mr-2"></i>Export Semua</a>
                        <a class="dropdown-item" href="<?= base_url('laporan/export_pinjaman_telat'); ?>"><i class="fas fa-download mr-2"></i>Export Telat</a>
                        <a class="dropdown-item" href="<?= base_url('laporan/export_pinjaman_lunas'); ?>"><i class="fas fa-download mr-2"></i>Export lunas</a>
                        <a class="dropdown-item" href="<?= base_url('laporan/export_pinjaman_belum_lunas'); ?>"><i class="fas fa-download mr-2"></i>Export Belum Lunas</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="semua">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Jumlah Pinjaman</th>
                                <th>Bunga</th>
                                <th>Total Angsuran</th>
                                <th>Status Pinjaman</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($all_data_pinjaman as $key => $value) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value['kode_fakultas'] ?></td>
                                    <td><?= $value['nama_anggota'] ?></td>
                                    <td><?= $value['tanggal_pengajuan'] ?></td>
                                    <td><?= $value['tanggal_detail_pinjaman'] ?></td>
                                    <td><?= 'Rp ' . number_format($value['jumlah_pinjaman'], 0, ',', '.') ?></td>
                                    <td><?= number_format($value['bunga_pinjaman'] * 100, 2) ?>%</td>
                                    <td><?= 'Rp ' . number_format($value['total_angsuran'], 0, ',', '.') ?></td>
                                    <td class="text-center">
                                        <?php if ($value['status_detail_pinjaman'] == 'Lunas') : ?>
                                            <span class="badge badge-success">Lunas</span>
                                        <?php else : ?>
                                            <span class="badge badge-danger">Belum Lunas</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="telat">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Jumlah Pinjaman</th>
                                <th>Bunga</th>
                                <th>Total Angsuran</th>
                                <th>Status Pinjaman</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($telat_data_pinjaman as $key => $value) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value['kode_fakultas'] ?></td>
                                    <td><?= $value['nama_anggota'] ?></td>
                                    <td><?= $value['tanggal_pengajuan'] ?></td>
                                    <td><?= $value['tanggal_detail_pinjaman'] ?></td>
                                    <td><?= 'Rp ' . number_format($value['jumlah_pinjaman'], 0, ',', '.') ?></td>
                                    <td><?= number_format($value['bunga_pinjaman'] * 100, 2) ?>%</td>
                                    <td><?= 'Rp ' . number_format($value['total_angsuran'], 0, ',', '.') ?></td>
                                    <td>
                                        <?php if ($value['status_detail_pinjaman'] == 'Lunas') : ?>
                                            <span class="badge badge-success">Lunas</span>
                                        <?php else : ?>
                                            <span class="badge badge-danger">Belum Lunas</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>