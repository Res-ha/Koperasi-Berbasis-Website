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
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $subjudul ?></h3>
        </div>
        <?php echo form_open('anggota/insert') ?>
        <div class="card card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="id_fakultas">Kode Fakultas</label>
                            <select name="id_fakultas" class="form-control select2" style="width: 100%;">
                                <option value="">-- Pilih Kode Fakultas --</option>
                                <?php foreach ($fakultas as $fakulta) : ?>
                                    <option value="<?= $fakultas['id_fakultas'] ?>"><?= $fakultas['kode_fakultas'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Anggota</label>
                            <input name="nama_anggota" type="text" class="form-control" placeholder="Nama Anggota">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Alamat Anggota</label>
                            <input name="alamat_anggota" type="text" class="form-control" placeholder="Alamat Anggota">
                        </div>
                        <div class="form-group">
                            <label>No Telepon Anggota</label>
                            <input name="no_tlpn" type="text" class="form-control" placeholder="No Telepon Anggota">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control select2" style="width: 100%;">
                                <option value="">-- Jenis Kelamin --</option>
                                <option value="L">Laki - Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control select2" style="width: 100%;">
                                <option value="">-- Status --</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Tanggal Gabung Anggota</label>
                            <div class="input-group date" id="tanggal_gabung" data-target-input="nearest">
                                <input type="date" name="tanggal_gabung" class="form-control datetimepicker-input" data-target="#tanggal_gabung" placeholder="Tanggal Gabung Anggota" />
                                <div class="input-group-append" data-target="#tanggal_gabung" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="<?= base_url('Anggota') ?>" class="btn btn-success btn-flat">Kembali</a>
            <button type="submit" class="btn btn-primary btn-flat">+ Tambah</button>
        </div>
        <?php echo form_close() ?>
        <!-- /.card-body -->
    </div>
</div>