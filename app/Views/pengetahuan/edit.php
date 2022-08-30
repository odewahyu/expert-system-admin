<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex" id="wrapper">

    <?= $this->include('/layout/sidebar'); ?>

    <div id="page-content-wrapper">

        <?= $this->include('/layout/navbar'); ?>

        <div class="container-fluid px-3 pb-4">
            <div class="row mx-2 mt-2 d-flex justify-content-center">
                <div class="col-6 px-4 py-3 bg-body rounded shadow">
                    <h5 class="fw-bold mb-3 third-text">Form Edit Data Pengetahuan</h5>
                    <hr>
                    <form action="/pengetahuan/update" method="post">
                        <input type="hidden" name="id" id="id" value="<?= $pengetahuan['id_pengetahuan']; ?>">
                        <div class="form-group mb-3">
                            <label for="penyakit">Penyakit</label>
                            <select class="form-select" id="kodepenyakit" name="kodepenyakit">
                                <?php foreach ($penyakit as $p) : ?>
                                    <option value="<?= $p['kode_penyakit']; ?>" <?= ($p['kode_penyakit'] == $pengetahuan['kode_penyakit']) ? 'selected' : ''; ?>><?= $p['nama_penyakit']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="gejala">Gejala</label>
                            <select class="form-select" id="kodegejala" name="kodegejala">
                                <?php foreach ($gejala as $g) : ?>
                                    <option value="<?= $g['kode_gejala']; ?>" <?= ($g['kode_gejala'] == $pengetahuan['kode_gejala']) ? 'selected' : ''; ?>><?= $g['nama_gejala']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nilai_mb" class="form-label">Nilai MB</label>
                            <input type="number" step="0.01" value="<?= (old('nila_mb')) ? old('nila_mb') : $pengetahuan['nilai_mb'] ?>" class="form-control <?= ($validation->hasError('nila_mb')) ? 'is-invalid' : ''; ?>" id="nilai_mb" name="nilai_mb">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nilai_mb'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nilai_md" class="form-label">Nilai MD</label>
                            <input type="number" step="0.01" value="<?= (old('nilai_md')) ? old('nilai_md') : $pengetahuan['nilai_md'] ?>" class="form-control <?= ($validation->hasError('nilai_md')) ? 'is-invalid' : ''; ?>" id="nilai_md" name="nilai_md">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nilai_md'); ?>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1" <?= ($pengetahuan['status'] == 1) ? 'selected' : ''; ?>>Aktif</option>
                                <option value="0" <?= ($pengetahuan['status'] == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-start">
                            <a href="/pengetahuan" class="btn btn-secondary fw-bold me-1">Kembali</a>
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