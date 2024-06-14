<div class="col-12">
    <div class="card">
        <div class="card-header">
            <a href="<?= base_url('simpanan/input') ?>" class="btn btn-primary btn-sm btn-flat">+ Tambah</a>
        </div>
        <div class="card-body">
            <?php
            if (session()->get('insert')) {
                echo '<div id="insert-alert" class="alert alert-success alert-dismissible">';
                echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                echo session()->get('insert'); // Echo the flash data message here
                echo '</div>';
            }

            if (session()->get('update')) {
                echo '<div id="update-alert" class="alert alert-warning alert-dismissible">';
                echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                echo session()->get('update'); // Echo the flash data message here
                echo '</div>';
            }

            if (session()->get('delete')) {
                echo '<div id="delete-alert" class="alert alert-danger alert-dismissible">';
                echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                echo session()->get('delete'); // Echo the flash data message here
                echo '</div>';
            }
            ?>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Jenis Simpanan</th>
                        <th>Tanggal Simpanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($simpanan as $key => $value) {
                    ?>
                        <tr>
                            <td class="text-ceter"><?= $no++ ?></td>
                            <td><?= $value['nama_anggota'] ?></td>
                            <td><?= $value['nama_jenis_simpanan'] ?></td>
                            <td><?= $value['tanggal_simpanan'] ?></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="<?= base_url('simpanan/view/' . $value['id_anggota']) ?>" class="btn btn-info btn-sm btn-flat"><i class="fas fa-eye"></i></a>
                                    <a href="<?= base_url('simpanan/edit/' . $value['id_anggota']) ?>  " class="btn btn-warning btn-sm btn-flat"><i class="fas fa-pencil-alt"></i></a>
                                    <button class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#delete"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>