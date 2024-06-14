<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data <?= $judul ?></h3>
        </div>
        <div class="card-body">
            <?php
            if (session()->get('update')) {
                echo '<div id="update-alert" class="alert alert-warning alert-dismissible">';
                echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                echo session()->get('update'); // Echo the flash data message here
                echo '</div>';
            }
            ?>

            <table id="example1" class="table table-bordered table-striped">
                <!-- Table Header -->
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Koperasi</th>
                        <th>Alamat Koperasi</th>
                        <th>Logo Koperasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($koperasi as $key => $value) {
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $value['nama_koperasi'] ?></td>
                            <td><?= $value['alamat_koperasi'] ?></td>
                            <td class="text-center"><img src="<?= base_url('logo_koperasi/' . $value['logo_koperasi']) ?>" width="100px" height="100px"></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <!-- <a class="btn btn-info btn-sm btn-flat"><i class="fas fa-eye"></i></a> -->
                                    <a href="<?= base_url('koperasi/edit/' . $value['id_koperasi']) ?>  " class="btn btn-warning btn-sm btn-flat"><i class="fas fa-pencil-alt"></i></a>
                                    <!-- <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete<?= $value['id_koperasi']; ?>"><i class="fas fa-trash"></i></button> -->
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
