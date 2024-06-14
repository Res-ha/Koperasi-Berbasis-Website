<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data <?= $judul ?></h3>
        </div>
        <div class="card-body">

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Kode Fakultas</th>
                        <th>Nama Anggota</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($anggota as $key => $value) {
                    ?>
                        <tr>
                            <td class="text-ceter"><?= $no++ ?></td>
                            <td><?= $value['kode_fakultas'] ?></td>
                            <td><?= $value['nama_anggota'] ?></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="<?= base_url('simpanan/detail/' . $value['id_anggota']) ?>" class="btn btn-info btn-sm btn-flat"><i class="fas fa-eye"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>