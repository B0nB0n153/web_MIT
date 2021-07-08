<?= $this->extend('layout/template'); ?>

<?= $this->section('isi'); ?>
<div class="col">
    <h1 class="my-2">Data Orang</h1>

    <!-- <a href="/Admin/create_user" class="btn btn-success mt-3">Tambah Data</a> -->

    <!-- notif -->
    <div class="mt-2">
        <?php if (session()->getFlashdata('notif')) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil.</strong> <?= session()->getFlashdata('notif'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
    </div>
    <table class="table">
        <hr class="dropdown-divider">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 + (10 * ($jumlahPage - 1));
            foreach ($orang as $o) : ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><?= $o['nama']; ?></td>
                    <td><?= $o['alamat']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
            </tr>
        </tfoot>
    </table>
    <?php
    // tombol paging
    $tombol = $pager->links('dataorang', 'paging');
    if ($i >= 10) {

        echo "$tombol";
    } else {
        echo "";
    }
    ?>
</div>
<?= $this->endSection(); ?>