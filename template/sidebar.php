<?php
$current_page = basename($_SERVER['PHP_SELF']);
$current_dir = basename(dirname($_SERVER['PHP_SELF']));
$prefix = ($current_dir != 'SPK-WP' && $current_dir != 'htdocs') ? '../' : '';
$isAHP = in_array($current_page, [
    'perbandingan.php',
    'hitung.php'
]);
?>

<nav id="sidebar">
    <div class="sidebar-header">
        <h4 class="mb-0 fw-bold text-center">SPK WP</h4>
    </div>

    <ul class="list-unstyled components mt-3">
        <li class="<?= ($current_page == 'dashboard.php') ? 'active' : '' ?>">
            <a href="<?= $prefix ?>dashboard.php">Dashboard</a>
        </li>

        <hr class="mx-3 my-2 text-white-50">

        <li class="<?= ($current_page == 'kriteria.php') ? 'active' : '' ?>">
            <a href="<?= $prefix ?>pages/kriteria.php">Data Kriteria</a>
        </li>

        <li class="<?= ($current_page == 'alternatif.php') ? 'active' : '' ?>">
            <a href="<?= $prefix ?>pages/alternatif.php">Data Alternatif</a>
        </li>

        <li class="menu-item <?= $isAHP ? 'active' : '' ?>">
            <a id="btnHybrid">
                SPK Hybrid <span class="float-end">▾</span>
            </a>
            <ul class="submenu <?= $isAHP ? 'show-submenu' : '' ?>">
                <li class="<?= ($current_page == 'perbandingan.php') ? 'active' : '' ?>">
                    <a href="<?= $prefix ?>ahp/perbandingan.php">Perbandingan AHP</a>
                </li>
                <li class="<?= ($current_page == 'hitung.php') ? 'active' : '' ?>">
                    <a href="<?= $prefix ?>ahp/hitung.php">Hitung Bobot</a>
                </li>
            </ul>
        </li>

        <li class="<?= ($current_page == 'keputusan.php') ? 'active' : '' ?>">
            <a href="<?= $prefix ?>pages/keputusan.php">Pencarian Keputusan</a>
        </li>

        <li class="<?= ($current_page == 'riwayat.php') ? 'active' : '' ?>">
            <a href="<?= $prefix ?>pages/riwayat.php">Riwayat Keputusan</a>
        </li>

        <li class="mt-5">
            <a href="<?= $prefix ?>auth/logout.php" class="logout-btn">Logout</a>
        </li>
    </ul>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('btnHybrid');
    const submenu = btn.nextElementSibling; // ambil <ul class="submenu">

    if (!btn || !submenu) return;

    btn.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        submenu.classList.toggle('show-submenu');
    });
});
</script>

<style>
/* Pastikan submenu menggunakan style header.css */
.submenu {
    display: none;
}
.submenu.show-submenu {
    display: block;
}
</style>
