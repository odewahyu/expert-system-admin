<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex" id="wrapper">

    <?= $this->include('/layout/sidebar'); ?>

    <div id="page-content-wrapper">

        <?= $this->include('/layout/navbar'); ?>

        <div class="container-fluid px-3 pb-4">
            <div class="row mx-2 mt-2 d-flex justify-content-center">
                <div class="col-6 px-4 py-3 bg-body rounded shadow">
                    <h5 class="fw-bold mb-3 third-text">Form Tambah Data Gejala</h5>
                    <hr>
                    <form action="/gejala/save" method="post">
                        <input type="hidden" name="hiddenkode" id="hiddenkode" value="<?= $kodeGejala; ?>">
                        <fieldset disabled>
                            <div class="mb-3">
                                <label for="kodegejala" class="form-label">Kode Gejala</label>
                                <input type="text" class="form-control" id="kodegejala" name="kodegejala" placeholder="<?= $kodeGejala; ?>">
                            </div>
                        </fieldset>
                        <div class="mb-3">
                            <label for="namagejala" class="form-label">Nama Gejala</label>
                            <input type="text" value="<?= old('namagejala'); ?>" class="form-control <?= ($validation->hasError('namagejala')) ? 'is-invalid' : ''; ?>" id="namagejala" name="namagejala" autocomplete="off">
                            <div class="invalid-feedback">
                                <?= $validation->getError('namagejala'); ?>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start">
                            <a href="/gejala" class="btn btn-secondary fw-bold me-1">Kembali</a>
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