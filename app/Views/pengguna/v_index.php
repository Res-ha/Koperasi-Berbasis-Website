<!-- Main Content Section -->
<div class="col-12">
    <div class="card">
        <!-- Card Header with "Tambah" Button -->
        <div class="card-header">
            <a href="<?= base_url('Pengguna/Input') ?>" class="btn btn-primary btn-sm btn-flat">+ Tambah</a>
        </div>
        <!-- Card Body Section -->
        <div class="card-body">
            <!-- Display Success, Warning, Error, or Info Messages -->
            <?php if (session()->get('insert')) : ?>
                <div class="alert alert-success alert-dismissible" id="insert-alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?= session()->get('insert'); ?>
                </div>
            <?php endif; ?>

            <?php if (session()->get('update')) : ?>
                <div class="alert alert-warning alert-dismissible" id="update-alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?= session()->get('update'); ?>
                </div>
            <?php endif; ?>

            <?php if (session()->get('delete')) : ?>
                <div class="alert alert-danger alert-dismissible" id="delete-alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?= session()->get('delete'); ?>
                </div>
            <?php endif; ?>

            <?php if (session()->get('error')) : ?>
                <div class="alert alert-danger alert-dismissible" id="error-alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?= session()->get('error'); ?>
                </div>
            <?php endif; ?>

            <!-- Table Section -->
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Username</th>
                        <th>Hak Akses</th>
                        <th>Nama Lengkap</th>
                        <th>Foto User</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pengguna as $key => $value) : ?>
                        <tr>
                            <td class="text-center"><?= $key + 1 ?></td>
                            <td><?= $value['username'] ?></td>
                            <td><?= ($value['level'] == 1) ? 'Admin' : 'Bendahara'; ?></td>
                            <td><?= $value['nama_lengkap'] ?></td>
                            <td class="text-center">
                                <!-- Display User's Photo -->
                                <img src="<?= base_url('foto_user/' . $value['foto_user']) ?>" alt="<?= $value['nama_lengkap'] ?>" class="img-thumbnail" width="100px" height="100px">
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <!-- Edit Button -->
                                    <a href="<?= base_url('pengguna/edit/' . $value['id_user']) ?>" class="btn btn-warning btn-sm btn-flat"><i class="fas fa-pencil-alt"></i></a>
                                    <!-- Delete Button with Modal -->
                                    <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete<?= $value['id_user']; ?>"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modals -->
<?php foreach ($pengguna as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id_user']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Hapus Data Pengguna</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda Yakin Ingin Hapus <b><?= $value['nama_lengkap']; ?></b>..?
                </div>
                <div class="modal-footer justify-content-between">
                    <!-- Close Button -->
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <!-- Delete Button -->
                    <a href="<?= base_url('pengguna/delete/' . $value['id_user']) ?>" type="submit" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>