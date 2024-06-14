<div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4><?= $anggota_by_fakultas[0]['nama_fakultas'] ?> (<?= $anggota_by_fakultas[0]['kode_fakultas'] ?>)</h4>
            <a href="<?= base_url('anggota') ?>" class="btn btn-success btn-sm btn-flat ml-auto">Kembali</a>
        </div>

        <div class="card-body">
            <!-- Table -->
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Kode Fakultas</th>
                        <th>Nama Anggota</th>
                        <th>Alamat Anggota</th>
                        <th>No Telepon</th>
                        <th>Jenis Kelamin</th>
                        <th>Bergabung</th>
                        <th>Status Anggota</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($anggota_by_fakultas as $value) :
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
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="<?= base_url('anggota/edit/' . $value['id_anggota']) ?>  " class="btn btn-warning btn-sm btn-flat"><i class="fas fa-pencil-alt"></i></a>
                                    <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete<?= $value['id_anggota']; ?>"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>