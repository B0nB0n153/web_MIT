<?= $this->extend('layout/template'); ?>

<?= $this->section('isi'); ?>
<div class="col">
    <h1 class="my-2">Data User</h1>

    <a href="/Admin/create_user" class="btn btn-success mt-3">Tambah Data</a>

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
                <th scope="col">Username</th>
                <th scope="col">Nama</th>
                <th scope="col">Level</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 + (10 * ($jumlahPage - 1));
            foreach ($user as $u) : ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><?= $u['username']; ?></td>
                    <td><?= $u['nama']; ?></td>
                    <td><?php
                        if ($u['lvl'] == 1) {
                            echo "<span class='badge bg-primary'>Admin</span>";
                        } else {
                            echo "<span class='badge bg-info'>User</span>";
                        }
                        ?></td>
                    <td><?php
                        if ($u['status'] == 1) {
                            echo "<span class='badge bg-success'>Aktif</span>";
                        } else {
                            echo "<span class='badge bg-danger'>Nonaktif</span>";
                        }
                        ?></td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Aksi
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="dropdown-item">
                                        <a class=" btn btn-warning" href="/Admin/edit_user/<?= $u['id_user']; ?>">Edit</a>
                                    </div>
                                </li>
                                <li>
                                    <!-- keamana hapus -->
                                    <form class="dropdown-item" action="/Admin/delete_user/<?= $u['id_user']; ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda ingin menghapus nya?')"> Hapus </button>
                                    </form>
                                </li>
                                <!-- <hr class="dropdown-divider"> -->
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Nama</th>
                <th scope="col">Level</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </tfoot>
    </table>
    <?php
    $tombol = $pager->links('user', 'paging');
    // tombol paging
    if ($i >= 10) {

        echo "$tombol";
    } else {
        echo "";
    }
    ?>
</div>
<?= $this->endSection(); ?>