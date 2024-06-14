<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $nama_koperasi ?> | <?= $judul ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('back') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables & Plugins -->
    <link rel="stylesheet" href="<?= base_url('back') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('back') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('back') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('back') ?>/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?= base_url() ?>"><b>KOPERASI</b> UPAYA</a>
            <h5 class="login-box-msg">Universitas Palangka Raya</h5>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Silahkan Login</p>
                <?php
                $errors = session()->getFlashdata('errors');
                if (!empty($errors)) { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <ul>
                            <?php foreach ($errors as $key => $value) { ?>
                                <li><?= esc($value) ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <?php
                if (session()->getFlashdata('pesan')) {
                    echo '<div class="alert alert-danger alert-dismissible">';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                    echo session()->getFlashdata('pesan');
                    echo '</div>';
                }
                ?>
                <?php echo form_open('home/login') ?>
                <div class="input-group mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <select name="level" class="form-control">
                        <option selected="selected">--Level--</option>
                        <option value="1">Admin</option>
                        <option value="2">Bendahara</option>
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-level-down-alt"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?= base_url('back') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('back') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="<?= base_url('back') ?>/plugins/select2/js/select2.full.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('back') ?>/dist/js/adminlte.min.js"></script>

</body>

</html>