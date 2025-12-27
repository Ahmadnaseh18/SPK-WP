<?php
// Mendapatkan nama file yang sedang dibuka
$current_page = basename($_SERVER['PHP_SELF']);
// Mendapatkan nama folder tempat file ini dijalankan
$current_dir = basename(dirname($_SERVER['PHP_SELF']));

// Logika prefix: jika di dalam folder (pages/ahp/auth), naik 1 tingkat. Jika di root, kosongkan.
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
      <a href="javascript:void(0)" id="btnHybrid">
        SPK Hybrid ▾
      </a>

      <ul id="submenu" class="submenu" style="<?= $isAHP ? 'display:block' : 'display:none' ?>">
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

<div id="content" class="content">

<script>
// Skrip untuk toggle submenu hybrid
document.getElementById('btnHybrid').addEventListener('click', function() {
    var submenu = document.getElementById('submenu');
    if (submenu.style.display === 'none' || submenu.style.display === '') {
        submenu.style.display = 'block';
    } else {
        submenu.style.display = 'none';
    }
});
</script>