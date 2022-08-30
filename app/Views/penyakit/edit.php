<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex" id="wrapper">

    <?= $this->include('/layout/sidebar'); ?>

    <div id="page-content-wrapper">

        <?= $this->include('/layout/navbar'); ?>

        <div class="container-fluid px-3 pb-4">
            <div class="row mx-2 mt-2 d-flex justify-content-center">
                <div class="col-6 px-4 py-3 bg-body rounded shadow">
                    <h5 class="fw-bold mb-3 third-text">Form Edit Data Penyakit</h5>
                    <hr>
                    <form action="/penyakit/update" method="post">
                        <input type="hidden" name="hiddenkode" id="hiddenkode" value="<?= $penyakit['kode_penyakit']; ?>">
                        <fieldset disabled>
                            <div class="mb-3">
                                <label for="kodepenyakit" class="form-label">Kode Penyakit</label>
                                <input type="text" class="form-control" id="kodepenyakit" name="kodepenyakit" placeholder="<?= $penyakit['kode_penyakit']; ?>">
                            </div>
                        </fieldset>
                        <div class="mb-3">
                            <label for="namapenyakit" class="form-label">Nama Penyakit</label>
                            <input type="text" value="<?= (old('namapenyakit')) ? old('namapenyakit') : $penyakit['nama_penyakit'] ?>" class="form-control <?= ($validation->hasError('namapenyakit')) ? 'is-invalid' : ''; ?>" id="namapenyakit" name="namapenyakit" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('namapenyakit'); ?>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="penanganan" class="form-label">Penanganan</label>
                            <textarea class="form-control <?= ($validation->hasError('penanganan')) ? 'is-invalid' : ''; ?>" id="penanganan" name="penanganan" rows="3"><?= (old('penanganan')) ? old('penanganan') : $penyakit['penanganan'] ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('penanganan'); ?>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>" id="keterangan" name="keterangan" rows="3"><?= (old('keterangan')) ? old('keterangan') : $penyakit['keterangan'] ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('keterangan'); ?>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1" <?= ($penyakit['status'] == 1) ? 'selected' : ''; ?>>Aktif</option>
                                <option value="0" <?= ($penyakit['status'] == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-start">
                            <a href="/penyakit" class="btn btn-secondary fw-bold me-1">Kembali</a>
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