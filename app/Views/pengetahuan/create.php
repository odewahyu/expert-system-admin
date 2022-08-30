<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex" id="wrapper">

    <?= $this->include('/layout/sidebar'); ?>

    <div id="page-content-wrapper">

        <?= $this->include('/layout/navbar'); ?>

        <div class="container-fluid px-3 pb-4">
            <div class="row mx-2 mt-2 d-flex justify-content-center">
                <div class="col-6 px-4 py-3 bg-body rounded shadow">
                    <h5 class="fw-bold mb-3 third-text">Form Tambah Data Pengetahuan</h5>
                    <hr>
                    <form action="/pengetahuan/save" method="post">
                        <div class="form-group mb-3">
                            <label for="penyakit">Penyakit</label>
                            <select class="form-select" id="kodepenyakit" name="kodepenyakit">
                                <?php foreach ($penyakit as $p) : ?>
                                    <option value="<?= $p['kode_penyakit']; ?>"><?= $p['nama_penyakit']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="gejala">Gejala</label>
                            <select class="form-select" id="kodegejala" name="kodegejala">
                                <?php foreach ($gejala as $g) : ?>
                                    <option value="<?= $g['kode_gejala']; ?>"><?= $g['nama_gejala']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nilai_mb" class="form-label">Nilai MB</label>
                            <input type="number" step="0.01" value="<?= old('nilai_mb'); ?>" class="form-control <?= ($validation->hasError('nilai_mb')) ? 'is-invalid' : ''; ?>" id="nilai_mb" name="nilai_mb">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nilai_mb'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nilai_md" class="form-label">Nilai MD</label>
                            <input type="number" step="0.01" value="<?= old('nilai_md'); ?>" class="form-control <?= ($validation->hasError('nilai_md')) ? 'is-invalid' : ''; ?>" id="nilai_md" name="nilai_md">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nilai_md'); ?>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start">
                            <a href="/pengetahuan" class="btn btn-secondary fw-bold me-1">Kembali</a>
                            <button type="submit" class="btn primary-bg text-white fw-bold btnSave">Tambah Data</button>
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