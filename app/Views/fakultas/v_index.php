<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-tools float-left">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add">
                    + Tambah
                </button>
            </div>
        </div>
        <!-- /.card-header -->
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
                        <th>Kode Fakultas</th>
                        <th>Nama Fakultas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($fakultas as $key => $value) {
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $value['kode_fakultas'] ?></td>
                            <td><?= $value['nama_fakultas'] ?></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $value['id_fakultas']; ?>"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $value['id_fakultas']; ?>"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
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
                <h4 class="modal-title">Tambah Data Fakultas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('fakultas/insert') ?>
                <div class="form-group">
                    <label>Kode Fakultas</label>
                    <input name="kode_fakultas" type="text" class="form-control" placeholder="Masukkan Kode Fakultas">
                </div>
                <div class="form-group">
                    <label>Nama Fakultas</label>
                    <input name="nama_fakultas" type="text" class="form-control" placeholder="Masukkan Nama Fakultas">
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
<?php foreach ($fakultas as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['id_fakultas']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data Fakultas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open('fakultas/update/' . $value['id_fakultas']) ?>
                    <div class="form-group">
                        <label>Kode Fakultas</label>
                        <input name="kode_fakultas" value="<?= $value['kode_fakultas']; ?>" type="text" class="form-control" placeholder="Masukkan Kode Fakultas">
                    </div>
                    <div class="form-group">
                        <label>Nama Fakultas</label>
                        <input name="nama_fakultas" value="<?= $value['nama_fakultas']; ?>" type="text" class="form-control" placeholder="Masukkan Nama Fakultas">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Delete Modals -->
<?php foreach ($fakultas as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id_fakultas']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Hapus Data Fakultas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda Yakin Ingin Hapus <b><?= $value['nama_fakultas']; ?></b>..?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('fakultas/delete/' . $value['id_fakultas']) ?>" type="submit" class="btn btn-primary">Ya</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>