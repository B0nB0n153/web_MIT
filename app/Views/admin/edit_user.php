<?= $this->extend('layout/template'); ?>

<?= $this->section('isi'); ?>

<!-- alert -->
<!-- <div class="mt-2">
    <?php if (session()->getFlashdata('alert')) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Maaf</strong> <?= session()->getFlashdata('alert'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
</div> -->

<h2 class="my-3">Form Edit Data User</h2>
<div class="col-8">
    <form action="/Admin/update_user/<?= $user['id_user']; ?>" method="post">
        <?= csrf_field(); ?>
        <div class="row mb-3">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= (old('username')) ? old('username') : $user['username']; ?>" autofocus>
                <div id="username" class="invalid-feedback">
                    <?= $validation->getError('username'); ?>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password" value="<?= (old('password')) ? old('password') : $user['password']; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="nama" value="<?= (old('nama')) ? old('nama') : $user['nama']; ?>">
            </div>
        </div>
        <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-2 pt-0">Level</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="level" id="level1" value="1" <?= ($user['lvl'] == 1) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="level1">
                        Admin
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="level" id="level2" value="2" <?= ($user['lvl'] == 2) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="level2">
                        User
                    </label>
                </div>
            </div>
        </fieldset>
        <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-2 pt-0">Status</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="status1" value="1" <?= ($user['status'] == 1) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="status1">
                        Aktif
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="status2" value="2" <?= ($user['status'] == 0) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="status2">
                        Non-Aktif
                    </label>
                </div>
            </div>
        </fieldset>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/Admin/user" class="btn btn-danger" name="simpan">Kembali</a>
    </form>
</div>
<?= $this->endSection(); ?>