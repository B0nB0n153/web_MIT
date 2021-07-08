<?= $this->extend('layout/template'); ?>

<?= $this->section('isi'); ?>
<h2 class="my-3">Form Edit Data Post</h2>
<div class="col-8">
    <form action="/Admin/update_post/<?= $post['id_post']; ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="row mb-3">
            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" value="<?= $post['tgl_post']; ?>" name="tanggal" aria-label="readonly input example" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <label for="judul" class="col-sm-2 col-form-label">Judul</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="judul" name="judul" value="<?= $post['judul']; ?>" autofocus>
            </div>
        </div>
        <div class="row mb-3">
            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="deskripsi" rows="3" name="deskripsi"><?= $post['deskripsi'] ?></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
            <input type="hidden" name="gambarLama" value="<?= $post['foto']; ?>">
            <div class="col-sm-4">
                <img src='/img/<?= $post['foto']; ?>' class="img-thumbnail gambar-preview">
            </div>
            <div class="col-sm-6">
                <input class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" type="file" id="gambar" name="gambar" onchange="previewGambar()">
                <div class="invalid-feedback">
                    <?= $validation->getError('gambar'); ?>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/Admin/post" class="btn btn-danger" name="simpan">Kembali</a>
</div>

<?= $this->endSection(); ?>