<div class="col-md-12">
    <?php
    $errors = session()->getFlashdata('errors');
    if (!empty($errors)) {
    ?>
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
        <?= form_open_multipart('koperasi/update/' . $koperasi['id_koperasi']) ?>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nama_koperasi">Nama Koperasi</label>
                        <input name="nama_koperasi" value="<?= $koperasi['nama_koperasi'] ?>" type="text" class="form-control" id="nama_koperasi" placeholder="Masukkan Nama Koperasi">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="alamat_koperasi">Alamat Koperasi</label>
                        <input name="alamat_koperasi" value="<?= $koperasi['alamat_koperasi'] ?>" type="text" class="form-control" id="alamat_koperasi" placeholder="Masukkan Alamat Koperasi">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="logo_koperasi">Ganti Logo</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="logo_koperasi" name="logo_koperasi" accept=".jpg, .jpeg, .png" onchange="previewImage(event); updateFileName()">
                            <label class="custom-file-label" id="fileLabel" for="logo_koperasi">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <img id="preview" src="<?= base_url('logo_koperasi/' . $koperasi['logo_koperasi']) ?>" alt="Logo Koperasi" width="150px">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="<?= base_url('koperasi') ?>" class="btn btn-success btn-flat">Kembali</a>
            <button type="submit" class="btn btn-primary btn-flat">Update</button>
        </div>
        <?= form_close() ?>
    </div>
</div>
<script>
    function updateFileName() {
        var fileName = document.getElementById("logo_koperasi").files[0].name;
        document.getElementById("fileLabel").innerText = fileName;
    }
</script>