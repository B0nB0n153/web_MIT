<?= $this->extend('layout/template'); ?>

<?= $this->section('isi'); ?>

<!-- alert -->
<div class="mt-2">
    <?php if (session()->getFlashdata('alert')) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Maaf</strong> <?= session()->getFlashdata('alert'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
</div>

<h2 class="my-3">Form Tambah Data User</h2>
<div class="col-8">
    <form action="/Admin/save_user" method="post">
        <div class="row mb-3">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= old('username'); ?>" autofocus>
                <div id="username" class="invalid-feedback">
                    <?= $validation->getError('username'); ?>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?= old('password'); ?>">
                <div id="password" class="invalid-feedback">
                    <?= $validation->getError('password'); ?>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= old('nama'); ?>">
                <div id="nama" class="invalid-feedback">
                    <?= $validation->getError('nama'); ?>
                </div>
            </div>
        </div>
        <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-2 pt-0">Level</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" type="radio" name="level" id="level1" value="1">
                    <label class="form-check-label" for="level1">
                        Admin
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" type="radio" name="level" id="level2" value="2">
                    <label class="form-check-label" for="level2">
                        User
                    </label>
                </div>
            </div>
        </fieldset>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/Admin/user" class="btn btn-danger" name="simpan">Kembali</a>
    </form>
</div>
<?= $this->endSection(); ?>