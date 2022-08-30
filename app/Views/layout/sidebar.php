<div class="bg-white shadow" id="sidebar-wrapper">
    <div class="sidebar-heading text-center primary-bg py-3 primary-text text-white fs-6 fw-bold text-uppercase">
        <div class="row">
            <div class="col-12 d-flex justify-content-center align-items-center p-2">
                <img src="/img/icon.png" alt="icon" width="49,7" height="50">
                <h4 class="fw-bold ms-2 mt-2">HeartCare</h4>
            </div>
        </div>
    </div>
    <div class="list-group list-group-flush my-3">
        <a href="/" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= ($activeMenu == 'home') ? 'active' : '' ?>"><i class="fas fa-home me-2"></i>Home</a>
        <a href="/admin" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= ($activeMenu == 'admin') ? 'active' : '' ?>"><i class="fas fa-user me-2"></i>Data Admin</a>
        <a href="/diagnosa" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= ($activeMenu == 'diagnosa') ? 'active' : '' ?>"><i class="fas fa-stethoscope me-2"></i></i>Data Diagnosa</a>
        <a href="/rumahsakit" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= ($activeMenu == 'rumahsakit') ? 'active' : '' ?>"><i class="fas fa-hospital me-2"></i>Data Rumah Sakit</a>
        <a href="/gejala" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= ($activeMenu == 'gejala') ? 'active' : '' ?>"><i class="fas fa-diagnoses me-2"></i>Data Gejala</a>
        <a href="/penyakit" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= ($activeMenu == 'penyakit') ? 'active' : '' ?>"><i class="fas fa-disease me-2"></i>Data Penyakit</a>
        <a href="/pengetahuan" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= ($activeMenu == 'pengetahuan') ? 'active' : '' ?>"><i class="fas fa-book-medical me-2"></i>Data Pengetahuan</a>
    </div>
</div>