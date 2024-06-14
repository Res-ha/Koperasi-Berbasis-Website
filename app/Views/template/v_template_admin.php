<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $nama_koperasi ?> | <?= $judul ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('back') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('back') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('back') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('back') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('back') ?>/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('Home/Logout') ?>" role="button">
                        <i class="fas fa-sign-out-alt"></i> Log Out
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <?php
            // Ambil data logo dari tabel tbl_koperasi menggunakan CodeIgniter 4 Query Builder
            $db = \Config\Database::connect(); // Mengambil koneksi database
            $query = $db->table('tbl_koperasi')->get();
            if ($query->getResult()) {
                $results = $query->getResult();
                foreach ($results as $row) {
                    $nama_koperasi = $row->nama_koperasi;
                    $logoPath = base_url('logo_koperasi/' . $row->logo_koperasi);
                }
            }
            $db->close(); // Menutup koneksi database
            ?>

            <a href="<?= base_url('Dashboard') ?>" class="brand-link">
                <img src="<?= $logoPath ?>" alt="<?= $nama_koperasi ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?= $nama_koperasi ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url('foto_user') ?>/<?= session()->get('foto_user') ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a class="d-block"><?= session()->get('nama_lengkap')  ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= base_url('Dashboard') ?>" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <?php if (session('level') == 1) { ?>
                            <li class="nav-item <?= $menu == 'Master Data' ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= $menu == 'master-data' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-th-large"></i>
                                    <p>
                                        Master Data
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('Koperasi') ?>" class="nav-link <?= $submenu == 'Koperasi' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Koperasi</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('Pengguna') ?>" class="nav-link <?= $submenu == 'Pengguna' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Pengguna</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } else if (session('level') == 2) { ?>
                            <li class="nav-header">KOPERASI</li>
                            <li class="nav-item <?= $menu == 'Master Data' ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= $menu == 'master-data' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-th-large"></i>
                                    <p>
                                        Master Data
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('bungakoperasi') ?>" class="nav-link <?= $submenu == 'Bunga Koperasi' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Bunga Koperasi</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('JenisSimpanan') ?>" class="nav-link <?= $submenu == 'Jenis Simpanan' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Jenis Simpanan</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('fakultas') ?>" class="nav-link <?= $submenu == 'Fakultas' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Fakultas</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('Anggota') ?>" class="nav-link <?= $submenu == 'Anggota' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Anggota</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item <?= $menu == 'Transaksi' ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= $menu == 'Transaksi' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-credit-card"></i>
                                    <p>
                                        Transaksi
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('Simpanan') ?>" class="nav-link <?= $submenu == 'Simpanan' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Simpanan</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('Pinjaman') ?>" class="nav-link <?= $submenu == 'Pinjaman & Angsuran' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Pinjaman & Angsuran</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-header">BUKU KAS UMUM</li>
                            <li class="nav-item <?= $menu == 'Laporan' ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= $menu == 'Laporan' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-print"></i>
                                    <p>
                                        Laporan
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="<?= base_url('laporan/laporan_anggota') ?>" class="nav-link <?= $submenu == 'Laporan Anggota' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data Anggota</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="<?= base_url('laporan/laporan_simpanan') ?>" class="nav-link <?= $submenu == 'Laporan Simpanan' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data Simpanan</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="<?= base_url('laporan/laporan_pinjaman') ?>" class="nav-link <?= $submenu == 'Laporan Pinjaman' ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data Pinjaman</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item <?= $menu == 'Grafik' ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= $menu == 'Grafik' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-chart-bar"></i>
                                    <p>
                                        Grafik
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= base_url('grafik/grafik_keuangan') ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Grafik Keuangan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('grafik/grafik_anggota') ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Grafik Anggota</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= $judul ?></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#"><?= $menu ?></a></li>
                                <li class="breadcrumb-item active"><?= $submenu ?></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <?php
                        if ($page) {
                            echo view($page);
                        }
                        ?>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">

            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2023 <a>KOPERASI UPR UPAYA</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url('back') ?>/plugins/jquery/jquery.min.js"></script>

    <!-- Select2 -->
    <script src="../../plugins/select2/js/select2.full.min.js"></script>
    <!-- Include jQuery (required for Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Select2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('back') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url('back') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('back') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('back') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('back') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url('back') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('back') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url('back') ?>/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url('back') ?>/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url('back') ?>/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url('back') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url('back') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url('back') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('back') ?>/dist/js/adminlte.min.js"></script>
    <!-- Load Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "paging": true,
                "searching": true,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "searching": true,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        // Menghilangkan alert setelah 5 detik (5000 milidetik)
        setTimeout(function() {
            document.getElementById("insert-alert").style.display = "none";
        }, 5000);

        setTimeout(function() {
            document.getElementById("update-alert").style.display = "none";
        }, 5000);

        setTimeout(function() {
            document.getElementById("delete-alert").style.display = "none";
        }, 5000);
    </script>

    <script>
        // Menghilangkan pesan error setelah 3 detik
        setTimeout(function() {
            document.getElementById('error-alert').style.display = 'none';
        }, 5000);
    </script>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <script>
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>


</body>

</html>