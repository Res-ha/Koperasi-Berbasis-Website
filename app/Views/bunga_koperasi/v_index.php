<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data <?= $judul ?></h3>
        </div>
        <div class="card-body">
            <?php
            if (session()->get('update')) {
                echo '<div id="update-alert" class="alert alert-warning alert-dismissible">';
                echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                echo session()->get('update'); // Echo the flash data message here
                echo '</div>';
            }
            ?>

            <table id="example1" class="table table-bordered table-striped">
                <!-- Table Header -->
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Bunga</th>
                        <th>Besaran Bunga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($bunga as $key => $value) :
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $value['nama_bunga'] ?></td>
                            <td class="text-center"><?= number_format($value['besaran_bunga'] * 100, 2) ?>%</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $value['id_bunga']; ?>"><i class="fas fa-pencil-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Modals -->
<?php foreach ($bunga as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['id_bunga']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data Bunga Koperasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open('bungakoperasi/update/' . $value['id_bunga']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Bunga</label>
                        <input name="nama_bunga" value="<?= $value['nama_bunga']; ?>" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Besaran Bunga</label>
                        <input name="besaran_bunga" value="<?= $value['besaran_bunga']; ?>" type="text" class="form-control">
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