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
        <?= form_open('simpanan/insert') ?>
        <div class="card-body">
            <div class="form-group">
                <label for="id_anggota">Nama Anggota</label>
                <select name="id_anggota" class="form-control">
                    <option value="">-- Pilih Nama Anggota --</option>
                    <?php foreach ($anggota as $d) : ?>
                        <option value="<?= $d['id_anggota'] ?>"><?= $d['nama_anggota'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_jenis_simpanan">Jenis Simpanan</label>
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
                <input type="date" name="tanggal_simpanan" class="form-control" required>
            </div>
        </div>
        <div class="card-footer">
            <a href="<?= base_url('simpanan') ?>" class="btn btn-success btn-flat">Kembali</a>
            <button type="submit" class="btn btn-primary btn-flat">+ Tambah</button>
        </div>
        <?= form_close() ?>
        <!-- /.card-body -->
    </div>
</div>