<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex" id="wrapper">

    <?= $this->include('/layout/sidebar'); ?>

    <div id="page-content-wrapper">

        <?= $this->include('/layout/navbar'); ?>

        <div class="container-fluid px-3">
            <div class="row primary-bg px-5 mx-2 rounded shadow-sm mt-2">
                <div class="col-lg-4 mt-3 d-flex justify-content-center align-items-center">
                    <i class="fas fa-user icon-size text-white"></i>
                </div>
                <div class="col-lg-8 mt-3">
                    <div class="px-2 pt-3 pb-2 primary-bg">
                        <h3 class="px-2 fw-bold text-white">Profile Admin</h3>
                        <table class="table table-borderless">
                            <tbody class="text-white">
                                <tr>
                                    <td>Username</td>
                                    <td>:</td>
                                    <td><?= session()->get('username') ?></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td><?= session()->get('nama') ?></td>
                                </tr>
                                <tr>
                                    <td>E-mail</td>
                                    <td>:</td>
                                    <td><?= session()->get('email') ?></td>
                                </tr>
                                <tr>
                                    <td>No. Telephone</td>
                                    <td>:</td>
                                    <td><?= session()->get('no_telephone') ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 px-2 mt-3 pb-4">
                <div class="row d-flex">
                    <div class="col-3">
                        <div class="col-12 px-4 py-5 bg-body rounded shadow-sm d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="fs-5 third-text fw-bold">Admin</h5>
                                <h5 class="fs-6 third-text fw-bold"><?= $jmlAdmin; ?></h5>
                            </div>
                            <i class="fas fa-user fs-1 third-text"></i>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="col-12 px-4 py-5 bg-body rounded shadow-sm d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="fs-5 third-text fw-bold">Rumah Sakit</h5>
                                <h5 class="fs-6 third-text fw-bold"><?= $jmlRumahSakit; ?></h5>
                            </div>
                            <i class="fas fa-hospital fs-1 third-text"></i>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="col-12 px-4 py-5 bg-body rounded shadow-sm d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="fs-5 third-text fw-bold">Penyakit</h5>
                                <h5 class="fs-6 third-text fw-bold"><?= $jmlPenyakit; ?></h5>
                            </div>
                            <i class="fas fa-disease fs-1 third-text"></i>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="col-12 px-4 py-5 bg-body rounded shadow-sm d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="fs-5 third-text fw-bold">Diagnosa</h5>
                                <h5 class="fs-6 third-text fw-bold"><?= $jmlDiagnosa; ?></h5>
                            </div>
                            <i class="fas fa-stethoscope fs-1 third-text"></i>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="col-12 px-4 pt-3 pb-4 bg-body rounded shadow-sm">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('myChart').getContext('2d');

    var labels = []
    var jmlPerPenyakitL = [];
    var jmlPerPenyakitP = [];

    <?php foreach ($penyakit as $p) : ?>
        labels.push('<?= $p['nama_penyakit']; ?>');
        <?php $i = 0; ?>
        <?php foreach ($jmlPerPenyakitL as $value) : ?>
            <?php if ($p['nama_penyakit'] == $value->nama_penyakit) : ?>
                jmlPerPenyakitL.push(<?= $value->jml; ?>);
                <?php $i++ ?>
                <?php break; ?>
            <?php endif ?>
        <?php endforeach; ?>
        <?php if (!$i == 1) : ?>
            jmlPerPenyakitL.push(0)
        <?php endif ?>
    <?php endforeach; ?>

    <?php foreach ($penyakit as $p) : ?>
        <?php $i = 0; ?>
        <?php foreach ($jmlPerPenyakitP as $value) : ?>
            <?php if ($p['nama_penyakit'] == $value->nama_penyakit) : ?>
                jmlPerPenyakitP.push(<?= $value->jml; ?>);
                <?php $i++ ?>
                <?php break; ?>
            <?php endif ?>
        <?php endforeach; ?>
        <?php if (!$i == 1) : ?>
            jmlPerPenyakitP.push(0)
        <?php endif ?>
    <?php endforeach; ?>


    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                    label: 'Laki-Laki',
                    data: jmlPerPenyakitL,
                    backgroundColor: [
                        'rgba(20, 36, 89, 0.6)',
                    ],
                    borderColor: [
                        'rgba(20, 36, 89, 0.8)',
                    ],
                    borderWidth: 1.5,
                    barThickness: 35,
                    maxBarThickness: 37,
                    barPercentage: 1.0,
                    pointStyle: 'rect',
                },
                {
                    label: 'Perempuan',
                    data: jmlPerPenyakitP,
                    backgroundColor: [
                        'rgba(25, 170, 222, 0.6)',
                    ],
                    borderColor: [
                        'rgba(25, 170, 222, 0.8)',
                    ],
                    borderWidth: 1.5,
                    barThickness: 35,
                    maxBarThickness: 37,
                    barPercentage: 1.0,
                    pointStyle: 'rect',
                }
            ]
        },
        options: {
            scales: {
                x: {
                    grid: {
                        display: false,
                    },
                    ticks: {
                        font: {
                            size: 12,
                            family: "Montserrat",
                        },
                    },
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: {
                            family: "Montserrat",
                        },
                    }
                },
            },
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    padding: 20,
                    text: 'Hasil Diagnosa Per Penyakit',
                    font: {
                        size: 18,
                        family: "Montserrat"
                    }
                },
                legend: {
                    position: 'right',
                    align: 'center',
                    labels: {
                        font: {
                            size: 14,
                            family: "Montserrat",
                        },
                        usePointStyle: true,
                    },
                },
            }
        }
    });
</script>

<?= $this->include('/layout/modalLogout'); ?>
<?= $this->endSection(); ?>