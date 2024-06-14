<div class="col-12 col-sm-12">
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
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#add<?= $anggota['id_anggota']; ?>">
                    + Tambah Simpanan Anggota
                </button>
                <a href="<?= base_url('simpanan') ?>" class="btn btn-success btn-sm btn-flat ml-auto">Kembali</a>
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
                                <h2><b><?= $anggota['nama_anggota'] ?></b></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Jenis Simpanan</th>
                        <th>Tanggal</th>
                        <th>Jumlah Simpanan</th>
                        <th>Aksi</th>
                        <!-- ... tambahkan kolom lainnya sesuai kebutuhan -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($detail_simpanan as $key => $value) {
                    ?>
                        <tr>
                            <td class="text-ceter"><?= $no++ ?></td>
                            <td><?= $value['nama_jenis_simpanan'] ?></td>
                            <td><?= $value['tanggal_simpanan'] ?></td>
                            <td><?= 'Rp ' . number_format($value['jumlah_jenis_simpanan'], 0, ',', '.') ?></td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete<?= $value['id_simpanan'] . $value['id_anggota']; ?>"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Jumlah Simpanan :
                            <?= 'Rp ' . number_format($sum_total_simpanan['total_simpanan'], 0, ',', '.') ?>
                        </th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="add<?= $anggota['id_anggota'] ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Simpanan Anggota</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('simpanan/insert/' . $anggota['id_anggota']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input name="id_anggota" value="<?= $anggota['nama_anggota'] ?>" type="text" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="id_anggota">Jenis Simpanan</label>
                    <select name="id_jenis_simpanan" class="form-control" required>
                        <option value="">-- Pilih Jenis Simpanan --</option>
                        <?php foreach ($jenis_simpanan as $d) : ?>
                            <?php
                            $formattedAmount = number_format($d['jumlah_jenis_simpanan'], 2, ',', '.');
                            $optionText = $d['nama_jenis_simpanan'] . ' - Rp ' . $formattedAmount;
                            ?>
                            <option value="<?= $d['id_jenis_simpanan'] ?>"><?= esc($optionText) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tanggal Simpanan</label>
                    <input name="tanggal_simpanan" type="date" class="form-control" placeholder="Tanggal Simpanan">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>

<?php foreach ($detail_simpanan as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id_simpanan'] . $value['id_anggota']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Delete Data Simpanan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda Yakin Ingin Hapus <b><?= $value['nama_jenis_simpanan']; ?></b>..?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('simpanan/delete/' . $value['id_simpanan'] . '/' . $value['id_anggota']) ?>" class="btn btn-primary">Ya</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>