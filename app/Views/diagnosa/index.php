<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex" id="wrapper">

    <?= $this->include('/layout/sidebar'); ?>

    <div id="page-content-wrapper">

        <?= $this->include('/layout/navbar'); ?>

        <div class="container-fluid px-4">
            <div class="row d-flex align-items-center justify-content-start">
                <div class="col-12 mt-3">
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
                                <th scope="col">Nama</th>
                                <th scope="col">Umur</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Nama Penyakit</th>
                                <th scope="col">Persentase CF (%)</th>
                                <th scope="col">Tanggal Diagnosa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($jumlah == 0) : ?>
                                <tr>
                                    <td colspan="7" class="text-center fw-bold"><?= $msg; ?></td>
                                </tr>
                            <?php else : ?>
                                <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                                <?php foreach ($diagnosa as $d) : ?>
                                    <tr class="align-middle">
                                        <th class="text-center" scope="row"><?= $i; ?>.</th>
                                        <td><?= $d['nama']; ?></td>
                                        <td><?= $d['umur']; ?> Tahun</td>
                                        <td><?= $d['jenis_kelamin']; ?></td>
                                        <td><?= $d['nama_penyakit']; ?></td>
                                        <td><?= $d['persentase_cf']; ?></td>
                                        <td><?= date_format(date_create($d['tanggal_diagnosa']), "d/m/Y") ?></td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                    <?= $pager->links('diagnosa', 'custom_pagination'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('/layout/modalLogout'); ?>

<?= $this->endSection(); ?>