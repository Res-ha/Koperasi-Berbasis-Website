<div class="col-md-12">
    <?php
    $errors = session()->getFlashdata('errors');
    if (!empty($errors)) { ?>
        <div class="alert alert-danger alert-dismissible" id="error-alert">
            <h5>Ada Kesalahan !!!</h5>
            <ul>
                <?php foreach ($errors as $key => $value) { ?>
                    <li><?= esc($value) ?></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title"><?= $subjudul ?></h3>
        </div>
        <?php echo form_open_multipart('anggota/update/' . $anggota['id_anggota']); ?>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Kode Fakultas</label>
                        <select name="id_fakultas" class="form-control">
                            <option value="<?= $anggota['id_fakultas'] ?>"><?= $anggota['kode_fakultas'] ?></option>
                            <?php foreach ($fakultas as $key => $value) { ?>
                                <option value="<?= $value['id_fakultas'] ?>"><?= $value['kode_fakultas'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Anggota</label>
                        <input name="nama_anggota" value="<?= $anggota['nama_anggota'] ?>" type="text" class="form-control" placeholder="Nama Anggota">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Alamat Anggota</label>
                        <input name="alamat_anggota" value="<?= $anggota['alamat_anggota'] ?>" type="text" class="form-control" placeholder="Alamat Anggota">
                    </div>
                    <div class="form-group">
                        <label>No Telepon Anggota</label>
                        <input name="no_tlpn" value="<?= $anggota['no_tlpn'] ?>" type="text" class="form-control" placeholder="No Telepon Anggota">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" style="width: 100%;">
                            <option value="" <?= (empty($anggota['jenis_kelamin'])) ? 'selected' : ''; ?>>-- Jenis Kelamin --</option>
                            <option value="L" <?= ($anggota['jenis_kelamin'] == 'L') ? 'selected' : ''; ?>>Laki - Laki</option>
                            <option value="P" <?= ($anggota['jenis_kelamin'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" style="width: 100%;">
                            <option value="" <?= (empty($anggota['status'])) ? 'selected' : ''; ?>>-- Status --</option>
                            <option value="1" <?= ($anggota['status'] == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                            <option value="2" <?= ($anggota['status'] == 'Tidak Aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tanggal Gabung Anggota</label>
                        <div class="input-group date" id="tanggal_gabung" data-target-input="nearest">
                            <!-- Set the value attribute to display the date from the database -->
                            <input type="date" value="<?= esc($anggota['tanggal_gabung']) ?>" name="tanggal_gabung" class="form-control datetimepicker-input" data-target="#tanggal_gabung" placeholder="Tanggal Gabung Anggota" />
                            <div class="input-group-append" data-target="#tanggal_gabung" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="<?= base_url('anggota') ?>" class="btn btn-success btn-flat">Kembali</a>
            <button type="submit" class="btn btn-primary btn-flat">Update</button>
        </div>
        <?php echo form_close() ?>
        <!-- /.card-body -->
    </div>
</div>