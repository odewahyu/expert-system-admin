<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex" id="wrapper">

    <?= $this->include('/layout/sidebar'); ?>

    <div id="page-content-wrapper">

        <?= $this->include('/layout/navbar'); ?>

        <div class="container-fluid px-3 pb-4">
            <div class="row mx-2 mt-2 d-flex justify-content-center">
                <div class="col-6 px-4 py-3 bg-body rounded shadow">
                    <h5 class="fw-bold mb-3 third-text">Form Edit Data Admin</h5>
                    <hr>
                    <form action="/admin/update" method="post">
                        <input type="hidden" value="<?= $admin['id_admin']; ?>" name="id" id="id">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" value="<?= (old('username')) ? old('username') : $admin['username'] ?>" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" value="<?= (old('nama')) ? old('nama') : $admin['nama'] ?>" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="text" value="<?= (old('email')) ? old('email') : $admin['email'] ?>" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('email'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="notelp" class="form-label">No. Telephone</label>
                            <input type="text" value="<?= (old('notelp')) ? old('notelp') : explode('+', $admin['no_telephone'])[1] ?>" class="form-control <?= ($validation->hasError('notelp')) ? 'is-invalid' : ''; ?>" id="notelp" name="notelp" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('notelp'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1" <?= ($admin['status'] == 1) ? 'selected' : ''; ?>>Aktif</option>
                                <option value="0" <?= ($admin['status'] == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-start">
                            <a href="/admin" class="btn btn-secondary fw-bold me-1">Kembali</a>
                            <button type="submit" class="btn primary-bg text-white fw-bold btnSave">Ubah Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('/layout/modalLogout'); ?>

<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function() {
        el.classList.toggle("toggled");
    };
</script>

<?= $this->endSection(); ?>