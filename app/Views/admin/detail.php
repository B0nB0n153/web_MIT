<?= $this->extend('layout/template'); ?>

<?= $this->section('isi'); ?>

<!-- Detail Post -->
<div class="col">
    <h1 class="mt-2">Detail Post</h1>
    <div class="card mb-3">
        <img src="/img/<?= $post['foto']; ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><b><?= $post['judul']; ?></b></h5>
            <p class="card-text"><?= $post['deskripsi']; ?></p>
            <p class="card-text"><small class="text-muted">Tanggal Post : <?= $post['tgl_post']; ?></small></p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-warning" href="/Admin/edit_post/<?= $post['id_post']; ?>" type="button">Edit</a>
                <!-- keamana hapus -->
                <form action="/Admin/delete_post/<?= $post['id_post']; ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda ingin menghapus nya?')"> Hapus </button>
                </form>
                <a href="/Admin/post" class="btn btn-info" type="button">Kembali</a>
            </div>
        </div>
    </div>
</div>




<?= $this->endSection(); ?>