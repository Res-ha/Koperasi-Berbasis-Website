<div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <a href="<?= base_url('anggota/input') ?>" class="btn btn-primary btn-sm">+ Tambah</a>
                <div class="btn-group">
                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Import Excel
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" data-toggle="modal" data-target="#import">
                            <i class="fas fa-upload mr-2"></i> Upload Excel
                        </a>
                    </div>
                </div>
            </div>

            <div class="btn-group ml-auto">
                <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Filter Kode Fakultas
                </button>
                <div class="dropdown-menu">
                    <?php foreach ($fakultasData as $fakultas) : ?>
                        <a class="dropdown-item" href="<?= base_url('anggota/anggota_by_fakultas/' . $fakultas['id_fakultas']) ?>"> <i class="fas fa-university mr-2"></i> <?= $fakultas['kode_fakultas'] ?></a>
                    <?php endforeach; ?>
                </div>
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
                    foreach ($anggota as $value) :
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

<!-- Import Excel Modal -->
<div class="modal fade" id="import">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Data from Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Import Excel Form -->
            <form action="<?= site_url('anggota/import') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file_excel" class="col-form-label">File Excel</label>
                        <div class="custom-file">
                            <input required type="file" class="custom-file-input" id="file_excel" name="file_excel" accept=".xlsx, .xls" onchange="updateFileName()">
                            <label class="custom-file-label" for="file_excel" id="fileLabel">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function updateFileName() {
        var input = document.getElementById('file_excel');
        var label = document.getElementById('fileLabel');
        var fileName = input.files[0].name;
        label.innerHTML = fileName;
    }
</script>


<?php foreach ($anggota as $key => $value) { ?>
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="delete<?= $value['id_anggota']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Hapus Data Anggota</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda Yakin Ingin Hapus <b><?= $value['nama_anggota']; ?></b>..?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('anggota/delete/' . $value['id_anggota']) ?>" type="submit" class="btn btn-primary">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>