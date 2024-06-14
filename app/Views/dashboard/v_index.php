<!-- Overview Section -->
<div class="container mt-4">
    <div class="row">
        <!-- Fakultas Box -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="small-box bg-info">
                <div class="inner">
                    <h2><?= $total_fakultas ?></h2>
                    <p>Fakultas</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-university"></i>
                </div>
                <?php if (session('level') == 1) { ?>
                    <!-- ... -->
                <?php } elseif (session('level') == 2) { ?>
                    <!-- ... -->
                    <a href="<?= site_url('fakultas') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                <?php } ?>
            </div>
        </div>

        <!-- Anggota Box -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="small-box bg-success">
                <div class="inner">
                    <h2><?= $total_anggota ?></h2>
                    <p>Anggota</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-users"></i>
                </div>
                <?php if (session('level') == 1) { ?>
                    <!-- ... -->
                <?php } elseif (session('level') == 2) { ?>
                    <!-- ... -->
                    <a href="<?= site_url('anggota') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                <?php } ?>
            </div>
        </div>

        <!-- Kas Masuk Box -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h2><?= "Rp " . number_format($pemasukkan, 0, ',', '.') ?></h2>
                    <p>Kas Masuk</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-wallet"></i>
                </div>
                <?php if (session('level') == 1) { ?>
                    <!-- ... -->
                <?php } elseif (session('level') == 2) { ?>
                    <!-- ... -->
                    <a href="<?= site_url('grafik/grafik_keuangan') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                <?php } ?>
            </div>
        </div>

        <!-- Kas Keluar Box -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h2><?= "Rp " . number_format($pengeluaran, 0, ',', '.') ?></h2>
                    <p>Kas Keluar</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-donate"></i>
                </div>
                <?php if (session('level') == 1) { ?>
                    <!-- ... -->
                <?php } elseif (session('level') == 2) { ?>
                    <!-- ... -->
                    <a href="<?= site_url('grafik/grafik_keuangan') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- Transaction History Section -->
<?php if (session('level') == 2) { ?>
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Histori Transaksi Angsuran Telat</h3>
            </div>
            <div class="card-body">
                <!-- Display Transaction History Table -->
                <?php if (!empty($angsuran_telat)) : ?>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Kode Fakultas</th>
                                <th>Nama Anggota</th>
                                <th>Tanggal Detail Pinjaman</th>
                                <th>Jumlah Pinjaman</th>
                                <th>Total Angsuran</th>
                                <th>Status Detail Pinjaman</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (array_reverse($angsuran_telat) as $row) : ?>
                                <tr>
                                    <td><?= $row['kode_fakultas'] ?></td>
                                    <td><?= $row['nama_anggota'] ?></td>
                                    <td><?= $row['tanggal_detail_pinjaman'] ?></td>
                                    <td><?= 'Rp ' . number_format($row['jumlah_pinjaman'], 0, ',', '.') ?></td>
                                    <td><?= 'Rp ' . number_format($row['total_angsuran'], 0, ',', '.') ?></td>
                                    <td><?= $row['status_detail_pinjaman'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <!-- Display No Transaction History Message -->
                    <p>No transaction history found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php } ?>