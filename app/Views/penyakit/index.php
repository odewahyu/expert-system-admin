<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex" id="wrapper">

    <?= $this->include('/layout/sidebar'); ?>

    <div id="page-content-wrapper">

        <?= $this->include('/layout/navbar'); ?>

        <div class="container-fluid px-4">
            <div class="row">
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="col-4">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashData('pesan'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="row d-flex align-items-center justify-content-between">
                <div class="col-auto">
                    <a href="penyakit/create" class="btn secondary-bg text-white mt-3 p-2 fw-bold">
                        <i class="fas fa-user-plus me-2"></i>
                        Tambah Data
                    </a>
                </div>
                <div class="col-10 mt-3">
                    <form action="" method="post">
                        <div class="input-group">
                            <input type="search" name="keyword" class="form-control p-2" value="<?= $keyword; ?>" placeholder="Search" aria-label="Search" aria-describedby="button-addon2" autocomplete="off">
                            <button class="btn primary-bg text-white" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-md table-responsive">
                    <table class="table table-hover bg-white rounded-2 shadow-sm">
                        <thead class="secondary-bg text-white sticky-top">
                            <tr class="align-middle">
                                <th class="text-center" scope="col">No.</th>
                                <th scope="col">Kode Penyakit</th>
                                <th scope="col">Nama Penyakit</th>
                                <th scope="col">Penanganan</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($jumlah == 0) : ?>
                                <tr>
                                    <td colspan="7" class="text-center fw-bold"><?= $msg; ?></td>
                                </tr>
                            <?php else : ?>
                                <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                                <?php foreach ($penyakit as $p) : ?>
                                    <tr class="align-middle">
                                        <th class="text-center" scope="row"><?= $i; ?>.</th>
                                        <td><?= $p['kode_penyakit']; ?></td>
                                        <td><?= $p['nama_penyakit']; ?></td>
                                        <td><?= $p['penanganan']; ?></td>
                                        <td><?= $p['keterangan']; ?></td>
                                        <td>
                                            <?php if ($p['status'] == 1) : ?>
                                                <span class="badge primary-bg">Aktif</span>
                                            <?php else : ?>
                                                <span class="badge bg-danger">Tidak Aktif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="/penyakit/edit/<?= $p['kode_penyakit']; ?>" class="btn yellow-bg text-white fw-bold">
                                                <i class=" fas fa-edit me-1"></i>
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                    <?= $pager->links('penyakit', 'custom_pagination'); ?>
                </div>
            </div>
        </div>

    </div>

</div>

<?= $this->include('/layout/modalLogout'); ?>

<?= $this->endSection(); ?>