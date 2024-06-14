<div class="col-md-12">
    <?php
    // Display error messages, if any
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

        <?php echo form_open_multipart('pengguna/update/' . $pengguna['id_user']) ?>
        <div class="card-body">
            <!-- Form Section: User Information -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Username</label>
                        <input name="username" value="<?= $pengguna['username'] ?>" type="text" class="form-control" placeholder="Username">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Password</label>
                        <input name="password" value="<?= $pengguna['password'] ?>" type="password" class="form-control" placeholder="Password">
                    </div>
                </div>
            </div>

            <!-- Form Section: User Level and Name -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select name="level" id="level" class="form-control select2" style="width: 100%;">
                            <?php if ($pengguna['level'] == 1) : ?>
                                <option value="1" selected>Admin</option>
                                <option value="2">Bendahara</option>
                            <?php else : ?>
                                <option value="1">Admin</option>
                                <option value="2" selected>Bendahara</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nama Pengguna</label>
                        <input name="nama_lengkap" value="<?= $pengguna['nama_lengkap'] ?>" type="text" class="form-control" placeholder="Nama User">
                    </div>
                </div>
            </div>

            <!-- Form Section: User Photo and Preview -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="foto_user">Ganti Foto</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="foto_user" name="foto_user" accept=".jpg, .jpeg, .png" onchange="previewImage(event)">
                            <label class="custom-file-label" for="foto_user">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Preview</label>
                        <div class="img-thumbnail" style="width: 150px; height: 150px; overflow: hidden;">
                            <img id="preview" src="<?= base_url('foto_user/' . $pengguna['foto_user']) ?>" alt="User Photo" class="w-100 h-100">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <!-- Buttons for form submission and navigation -->
            <a href="<?= base_url('Pengguna') ?>" class="btn btn-success btn-flat">Kembali</a>
            <button type="submit" class="btn btn-primary btn-flat">Update</button>
        </div>
        <?php echo form_close() ?>
    </div>
</div>