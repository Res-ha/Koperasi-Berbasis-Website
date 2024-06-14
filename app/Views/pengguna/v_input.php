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
        <div class="card-body">

            <?php echo form_open_multipart('pengguna/insert') ?>
            <div class="form-group">
                <label>Username</label>
                <input name="username" type="text" class="form-control" placeholder="Username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input name="password" type="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="level">Level</label>
                <select name="level" id="level" class="form-control">
                    <option value="">-- Pilih Level --</option>
                    <option value="1">Admin</option>
                    <option value="2">Bendahara</option>
                </select>
            </div>
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input name="nama_lengkap" type="text" placeholder="Nama Pengguna" class="form-control">
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="foto_user">Foto Pengguna</label>
                        <input type="file" name="foto_user" id="foto_user" class="form-control" accept=".jpg, .jpeg, .png" onchange="previewImage(event)">
                    </div>
                </div>
                <div class="col-sm-8">
                    <img id="preview" alt="User Photo" width="150px">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="<?= base_url('pengguna') ?>" class="btn btn-success btn-flat">Kembali</a>
            <button type="submit" class="btn btn-primary btn-flat"><i class="nav-icon fas fa-solid fa-plus"></i> Tambah</button>
        </div>
        <?php echo form_close() ?>
        <!-- /.card-body -->
    </div>
</div>