<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $subjudul ?></h3>
        </div>
        <?php
        session();
        $validasi = \Config\Services::validation();
        ?>
        <?php echo form_open('JenisSimpanan/UpdateData/' . $jenis_simpanan['id_jenis']) ?>
        <div class="card-body">
            <div class="form-group">
                <label>Jenis Simpanan</label>
                <input name="jenis_simpanan" value="<?= $jenis_simpanan['jenis_simpanan'] ?>" type="text" class="form-control" placeholder="Masukkan Jenis Simpanan">
                <p class="text-danger"><?= $validasi->getError('jenis_simpanan') ?></p>
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <input name="jumlah" value="<?= $jenis_simpanan['jumlah'] ?>" type="text" class="form-control" placeholder="Masukkan Jumlah Simpanan">
                <p class="text-danger"><?= $validasi->getError('jumlah') ?></p>
            </div>
        </div>
        <div class="card-footer">
            <a href="<?= base_url('JenisSimpanan') ?>" class="btn btn-success btn-flat">Kembali</a>
            <button type="submit" class="btn btn-primary btn-flat">+ Tambah</button>
        </div>
        <?php echo form_close() ?>
        <!-- /.card-body -->
    </div>
</div>