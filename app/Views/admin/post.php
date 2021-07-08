<?= $this->extend('layout/template'); ?>

<?= $this->section('isi'); ?>
<div class="col">
    <h1 class="my-2">Data Posting</h1>

    <a href="/Admin/create_post" class="btn btn-success mt-3">Tambah Data</a>

    <!-- notif -->
    <div class="mt-2">
        <?php if (session()->getFlashdata('notif')) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil</strong> <?= session()->getFlashdata('notif'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
    </div>

    <table class="table">
        <hr class="dropdown-divider">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Gambar</th>
                <th scope="col">Judul</th>
                <th scope="col">Tanggal Post</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 + (10 * ($jumlahPage - 1));
            foreach ($post as $p) : ?>
                <tr>
                    <td scope="row"><?= $i++; ?></td>
                    <td><img src="/img/<?= $p['foto']; ?>" alt="" class="gambar"></td>
                    <td><?= $p['judul']; ?></td>
                    <td><?= $p['tgl_post']; ?></td>
                    <td><a class="btn btn-primary" href="/Admin/post/<?= $p['id_post']; ?>">Lihat Detail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Gambar</th>
                <th scope="col">Judul</th>
                <th scope="col">Tanggal Post</th>
                <th scope="col">Aksi</th>
            </tr>
        </tfoot>
    </table>
    <?php
    $tombol = $pager->links('post', 'paging');
    // tombol paging
    if ($i >= 10) {

        echo "$tombol";
    } else {
        echo "";
    }
    ?>
</div>
<?= $this->endSection(); ?>