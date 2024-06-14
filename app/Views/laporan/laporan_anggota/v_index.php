<div class="col-12">
    <div class="card card-default color-palette-box">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    Data Anggota:
                    <button class="btn btn-primary btn-sm">
                        <?= $jumlah_anggota ?>
                    </button>
                </h3>
                <div>
                    <a href="<?= base_url('laporan/export_anggota_all_data'); ?>" class="btn btn-success btn-sm">Export</a>
                </div>
            </div>
        </div>
        <div class="card-body col-md-12">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Kode Fakultas</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No Telepon</th>
                        <th>Gender</th>
                        <th>Bergabung</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data_anggota as $key => $value) {
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $value['kode_fakultas'] ?></td>
                            <td><?= $value['nama_anggota'] ?></td>
                            <td><?= $value['alamat_anggota'] ?></td>
                            <td><?= number_format($value['no_tlpn'], 0, '', '') ?></td>
                            <td><?= ($value['jenis_kelamin'] == 'L') ? 'Laki-Laki' : 'Perempuan'; ?></td>
                            <td><?= $value['tanggal_gabung'] ?></td>
                            <td class="text-center">
                                <?php if ($value['status'] == 'Aktif') : ?>
                                    <span class="badge badge-success">Aktif</span>
                                <?php else : ?>
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>