<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid third-bg">
    <div class="row d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class=" col-3 bg-body px-3 py-5 shadow">
            <div class="col-12 d-flex justify-content-center mb-2">
                <h2 class="fw-bold third-text">HeartCare</h2>
            </div>
            <div class="col-12 d-flex justify-content-center mb-2">
                <img src="/img/icon.png" alt="icon" width="199" height="200">
            </div>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="col-12">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= session()->getFlashData('pesan'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php endif; ?>
            <hr>
            <form action="/login/loginProcess" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button class="btn secondary-bg text-white fw-bold col-12 mt-2" type="submit">
                    Sign In
                </button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>