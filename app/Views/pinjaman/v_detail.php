<div class="col-12 col-sm-12">
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

    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <a href="<?= base_url('pinjaman') ?>" class="btn btn-success btn-sm btn-flat ml-auto">Kembali</a>
            </div>
        </div>

        <div class="card-body">
            <!-- Display member information -->
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                <div class="card bg-light d-flex flex-fill">
                    <div class="card-header text-muted border-bottom-0">
                        Data Anggota
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h2><b><?= $detail_pinjaman[0]['nama_anggota'] ?></b></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Bulan</th>
                        <th>Tanggal Angsuran</th>
                        <th>Bunga</th>
                        <th>Sisa Pinjaman</th>
                        <th>Angsuran Pokok</th>
                        <th>Angsuran Bunga</th>
                        <th>Total Angsuran</th>
                        <th>Status Angsuran</th>
                        <th>Aksi</th>
                        <!-- ... Add other table headers as needed -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($detail_pinjaman as $key => $value) {
                    ?>
                        <tr>
                            <!-- ... Populate table rows with data -->
                            <td><?= $no++ ?></td>
                            <td><?= date("F", strtotime($value["tanggal_detail_pinjaman"])) ?></td>
                            <td><?= $value['tanggal_detail_pinjaman'] ?></td>
                            <td><?= number_format($value['bunga'] * 100, 2) ?>%</td>
                            <td><?= 'Rp ' . number_format($value['sisa_pinjam'], 0, ',', '.') ?></td>
                            <td><?= 'Rp ' . number_format($value['angsuran_pokok'], 0, ',', '.') ?></td>
                            <td><?= 'Rp ' . number_format($value['angsuran_bunga'], 0, ',', '.') ?></td>
                            <td><?= 'Rp ' . number_format($value['total_angsuran'], 0, ',', '.') ?></td>
                            <td class="text-center">
                                <?php if ($value['status_detail_pinjaman'] == 'Lunas') : ?>
                                    <span class="badge badge-success">Lunas</span>
                                <?php else : ?>
                                    <span class="badge badge-danger">Belum Lunas</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm btn-flat" data-toggle="modal" data-target="#update<?= $value['id_detail_pinjaman'] ?>"><i class="fas fa-pencil-alt"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Update -->
<?php foreach ($detail_pinjaman as $key => $value) { ?>
    <div class="modal fade" id="update<?= $value['id_detail_pinjaman'] ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="updateModalLabel">Edit Status Pinjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open('pinjaman/update_status/' . $value['id_detail_pinjaman'] . '/' . $value['id_pinjaman']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Status Detail Pinjaman</label>
                        <select name="status_detail_pinjaman" class="form-control select2" style="width: 100%;">
                            <option value="Lunas" <?= ($value['status_detail_pinjaman'] == 'Lunas') ? 'selected' : ''; ?>>Lunas</option>
                            <option value="Belum Lunas" <?= ($value['status_detail_pinjaman'] == 'Belum Lunas') ? 'selected' : ''; ?>>Belum Lunas</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
<?php } ?>