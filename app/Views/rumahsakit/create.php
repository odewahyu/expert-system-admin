<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex" id="wrapper">

    <?= $this->include('/layout/sidebar'); ?>

    <div id="page-content-wrapper">

        <?= $this->include('/layout/navbar'); ?>

        <div class="container-fluid px-3 pb-4">
            <div class="row mx-2 mt-2 d-flex justify-content-center">
                <div class="col-6 px-4 py-3 bg-body rounded shadow">
                    <h5 class="fw-bold mb-3 third-text">Form Tambah Data Rumah Sakit</h5>
                    <hr>
                    <form action="/rumahsakit/save" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Rumah Sakit</label>
                            <input type="text" value="<?= old('nama'); ?>" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="provinsi">Provinsi</label>
                            <select class="form-select" id="provinsi" name="provinsi">
                                <option value="Jakarta">Jakarta</option>
                                <option value="Jawa Barat">Jawa Barat</option>
                                <option value="Jawa Tengah">Jawa Tengah</option>
                                <option value="Jawa Timur">Jawa Timur</option>
                                <option value="Bali">Bali</option>
                                <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                                <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                                <option value="Kalimantan Barat">Kalimantan Barat</option>
                                <option value="Kalimantan Timur">Kalimantan Timur</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" value="<?= old('alamat'); ?>" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('alamat'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="notelp" class="form-label">No. Telephone</label>
                            <input type="text" value="<?= old('notelp'); ?>" class="form-control <?= ($validation->hasError('notelp')) ? 'is-invalid' : ''; ?>" id="notelp" name="notelp" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('notelp'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="number" step="any" value="<?= old('latitude'); ?>" class="form-control <?= ($validation->hasError('latitude')) ? 'is-invalid' : ''; ?>" id="latitude" name="latitude" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('latitude'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="number" step="any" value="<?= old('longitude'); ?>" class="form-control <?= ($validation->hasError('longitude')) ? 'is-invalid' : ''; ?>" id="longitude" name="longitude" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('longitude'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" id="gambar" name="gambar" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('gambar'); ?>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start">
                            <a href="/rumahsakit" class="btn btn-secondary fw-bold me-1">Kembali</a>
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