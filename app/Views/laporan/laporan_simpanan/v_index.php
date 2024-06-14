<div class="col-md-12">
    <?php
    if (session()->get('gagal')) {
        echo '<div id="update-alert" class="alert alert-warning alert-dismissible">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        echo session()->get('gagal'); // Change 'update' to 'gagal'
        echo '</div>';
    }
    ?>
    <div class="card card-default color-palette-box">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    Data Simpanan Berdasarkan Anggota
                </h3>
            </div>
        </div>
        <form action="<?= base_url('laporan/export_simpanan_by_anggota') ?>" method="post">
            <div class="card-body">
                <div class="row mb-3">
                    <!-- Form input for selecting the year -->
                    <div class="col-md-4">
                        <label for="tahun">Pilih Tahun Simpanan:</label>
                        <select class="form-control" name="tahun" id="tahun">
                            <!-- Add your options for years dynamically -->
                            <option value="">-- Pilih Tahun --</option>
                            <?php
                            $currentYear = date('Y');
                            for ($year = $currentYear; $year >= $currentYear - 10; $year--) {
                                echo "<option value='$year'>$year</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Form input for selecting member's name based on ID -->
                    <div class="col-md-4">
                        <label for="id_anggota">Pilih Nama Anggota:</label>
                        <select class="form-control select2" name="id_anggota" style="width: 100%;">
                            <option selected value="">-- Pilih Anggota --</option>
                            <?php foreach ($anggota as $d) : ?>
                                <option value="<?= esc($d['id_anggota']) ?>"><?= esc($d['nama_anggota']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-flat">Export</button>
            </div>
        </form>
    </div>
</div>

<div class="col-12">
    <div class="card card-default color-palette-box">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    Data Simpanan Semua Anggota
                </h3>
                <div>
                    <a href="<?= base_url('laporan/export_simpanan_all_data'); ?>" class="btn btn-success btn-sm">Export</a>
                </div>
            </div>
        </div>
        <div class="card-body col-md-12">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Kode Fakultas</th>
                        <th>Nama Anggota</th>
                        <th>Tanggal Simpanan</th>
                        <th>Nama Jenis Simpanan</th>
                        <th>Nominal Simpanan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $totalSimpanan = 0; // Initialize total savings
                    foreach ($all_data_simpanan as $key => $value) {
                    ?>
                        <tr>
                            <td class="text-ceter"><?= $no++ ?></td>
                            <td><?= $value['kode_fakultas'] ?></td>
                            <td><?= $value['nama_anggota'] ?></td>
                            <td><?= $value['tanggal_simpanan'] ?></td>
                            <td><?= $value['nama_jenis_simpanan'] ?></td>
                            <td><?= 'Rp ' . number_format($value['jumlah_jenis_simpanan'], 0, ',', '.') ?></td>
                        </tr>
                    <?php
                        $totalSimpanan += $value['jumlah_jenis_simpanan']; // Accumulate total savings
                    } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Total Simpanan</th>
                        <th><?= 'Rp ' . number_format($totalSimpanan, 0, ',', '.') ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>