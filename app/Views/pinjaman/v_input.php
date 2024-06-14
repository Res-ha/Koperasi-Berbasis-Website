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
        <?= form_open('pinjaman/insert') ?>
        <div class="card-body">
            <div class="form-group">
                <label for="id_anggota">Nama Anggota:</label>
                <select name="id_anggota" class="form-control select2" style="width: 100%;">
                    <option selected value="">-- Pilih Anggota --</option>
                    <?php foreach ($anggota as $d) : ?>
                        <option value="<?= esc($d['id_anggota']) ?>"><?= esc($d['nama_anggota']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tanggal Pengajuan:</label>
                <input name="tanggal_pengajuan" type="date" class="form-control">
            </div>
            <div class="form-group">
                <label for="jumlah_pinjaman">Jumlah Pinjaman : </label>
                <input name="jumlah_pinjaman" type="number" class="form-control">
            </div>
            <div class="form-group">
                <label for="bunga_pengajuan">Bunga (2%):</label>
                <input value="<?= $bunga_koperasi ?>" type="number" step="0.01" name="bunga_pinjaman" class="form-control" disabled>
            </div>
            <div class="form-group">
                <label for="tenor_pinjaman">Tenggat Waktu (Bulan) </label>
                <select id="tenor_pinjaman" name="tenor_pinjaman" class="form-control">
                    <option value="">-- Tenggat Waktu (Bulan) --</option>
                    <option value="6">6 bulan</option>
                    <option value="12">12 bulan</option>
                    <option value="18">18 bulan</option>
                    <option value="24">24 bulan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status_pinjaman">Status Pinjaman</label>
                <select id="status_pinjaman" name="status_pinjaman" class="form-control">
                    <option value="">-- Status Pinjaman --</option>
                    <option value="1">Lunas</option>
                    <option value="2">Belum Lunas</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <a href="<?= base_url('pinjaman') ?>" class="btn btn-success btn-flat">Kembali</a>
            <button type="submit" class="btn btn-primary btn-flat">+ Tambah</button>
        </div>
        <?= form_close() ?>
    </div>
    <!-- /.card-body -->
</div>