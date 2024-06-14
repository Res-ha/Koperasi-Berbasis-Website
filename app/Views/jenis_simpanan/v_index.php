<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="card-tools float-left">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add">
                    + Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            <?php if (session()->get('insert')) : ?>
                <div id="insert-alert" class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?= session()->get('insert'); ?>
                </div>
            <?php endif; ?>

            <?php if (session()->get('update')) : ?>
                <div id="update-alert" class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?= session()->get('update'); ?>
                </div>
            <?php endif; ?>

            <?php if (session()->get('delete')) : ?>
                <div id="delete-alert" class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?= session()->get('delete'); ?>
                </div>
            <?php endif; ?>

            <?php
            $errors = session()->getFlashdata('errors');
            if (!empty($errors)) : ?>
                <div class="alert alert-danger alert-dismissible" id="error-alert">
                    <h5>Ada Kesalahan !!!</h5>
                    <ul>
                        <?php foreach ($errors as $key => $value) : ?>
                            <li><?= esc($value) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Jenis Simpanan</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($jenis_simpanan as $key => $value) :
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $value['nama_jenis_simpanan'] ?></td>
                            <td><?= 'Rp ' . number_format($value['jumlah_jenis_simpanan'], 0, ',', '.') ?></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $value['id_jenis_simpanan']; ?>"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $value['id_jenis_simpanan']; ?>"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Jenis Simpanan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('jenissimpanan/insert') ?>
                <div class="form-group">
                    <label>Jenis Simpanan</label>
                    <input name="nama_jenis_simpanan" type="text" class="form-control" placeholder="Nama Jenis Simpanan">
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input name="jumlah_jenis_simpanan" type="text" class="form-control" placeholder="Jumlah Simpanan">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modals -->
<?php foreach ($jenis_simpanan as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['id_jenis_simpanan']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data Jenis Simpanan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open('jenissimpanan/update/' . $value['id_jenis_simpanan']) ?>
                    <div class="form-group">
                        <label>Jenis Simpanan</label>
                        <input name="nama_jenis_simpanan" value="<?= $value['nama_jenis_simpanan']; ?>" type="text" class="form-control" placeholder="Masukkan Jenis Simpanan">
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input name="jumlah_jenis_simpanan" value="<?= $value['jumlah_jenis_simpanan']; ?>" type="text" class="form-control" placeholder="Masukkan Jumlah Simpanan">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Delete Modals -->
<?php foreach ($jenis_simpanan as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id_jenis_simpanan']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Hapus Data Jenis Simpanan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda Yakin Ingin Hapus <b><?= $value['nama_jenis_simpanan']; ?></b>..?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('jenissimpanan/delete/' . $value['id_jenis_simpanan']) ?>" type="submit" class="btn btn-primary">Ya</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>