<div class="col-12">
    <?php
    if (session()->get('insert')) {
        echo '<div id="insert-alert" class="alert alert-success alert-dismissible">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        echo session()->get('insert'); // Echo the flash data message here
        echo '</div>';
    }

    if (session()->get('update')) {
        echo '<div id="update-alert" class="alert alert-warning alert-dismissible">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        echo session()->get('update'); // Echo the flash data message here
        echo '</div>';
    }

    if (session()->get('delete')) {
        echo '<div id="delete-alert" class="alert alert-danger alert-dismissible">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        echo session()->get('delete'); // Echo the flash data message here
        echo '</div>';
    }
    ?>

    <div class="card">
        <div class="card-header">
            <a href="<?= base_url('pinjaman/input') ?>" class="btn btn-primary btn-sm btn-flat">+ Tambah</a>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Jumlah Pinjaman</th>
                        <th>Bunga</th>
                        <th>Tenor</th>
                        <th>Status Pinjaman</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($pinjaman as $key => $value) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['nama_anggota'] ?></td>
                            <td><?= $value['tanggal_pengajuan'] ?></td>
                            <td><?= 'Rp ' . number_format($value['jumlah_pinjaman'], 0, ',', '.') ?></td>
                            <td><?= number_format($value['bunga_pinjaman'] * 100, 2) ?>%</td>
                            <td class="text-center"><?= $value['tenor_pinjaman'] ?> Bulan</td>
                            <td class="text-center">
                                <?php if ($value['status_pinjaman'] == 'Lunas') : ?>
                                    <span class="badge badge-success">Lunas</span>
                                <?php else : ?>
                                    <span class="badge badge-danger">Belum Lunas</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="<?= base_url('pinjaman/detail/' . $value['id_pinjaman']) ?>" class="btn btn-info btn-sm btn-flat"><i class="fas fa-eye"></i></a>
                                    <button class="btn btn-warning btn-sm btn-flat" data-toggle="modal" data-target="#edit<?= $value['id_pinjaman']; ?>"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete<?= $value['id_pinjaman']; ?>"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php foreach ($id_pinjaman as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id_pinjaman']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Hapus Data Pinjaman</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda Yakin Ingin Hapus <b><?= $value['nama_anggota']; ?></b>..?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('pinjaman/delete/' . $value['id_pinjaman']) ?>" type="submit" class="btn btn-primary">Ya</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php foreach ($pinjaman as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['id_pinjaman']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Edit Data Pinjaman Anggota</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open('pinjaman/update/' . $value['id_pinjaman']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Status Pinjaman</label>
                        <select name="status_pinjaman" class="form-control select2" style="width: 100%;">
                            <option value="Lunas" <?= ($value['status_pinjaman'] == 'Lunas') ? 'selected' : ''; ?>>Lunas</option>
                            <option value="Belum Lunas" <?= ($value['status_pinjaman'] == 'Belum Lunas') ? 'selected' : ''; ?>>Belum Lunas</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
<?php } ?>