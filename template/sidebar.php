<?php
// Mendapatkan nama file yang sedang dibuka (misal: kriteria.php)
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav id="sidebar">
    <div class="sidebar-header">
        <h4 class="mb-0 fw-bold text-center">SPK WP</h4>
    </div>

    <ul class="list-unstyled components mt-3">
        <li class="sidebar-label">
            <span>Dashboard</span>
        </li>
        
        <li class="<?= ($current_page == 'kriteria.php') ? 'active' : '' ?>">
            <a href="kriteria.php">Data Kriteria</a>
        </li>
        
        <li class="<?= ($current_page == 'alternatif.php') ? 'active' : '' ?>">
            <a href="alternatif.php">Data Alternatif</a>
        </li>
        
        <li class="<?= ($current_page == 'keputusan.php') ? 'active' : '' ?>">
            <a href="keputusan.php">Pencarian Keputusan</a>
        </li>
        
        <li class="<?= ($current_page == 'riwayat.php') ? 'active' : '' ?>">
            <a href="riwayat.php">Riwayat Keputusan</a>
        </li>
        
        <li class="mt-5">
            <a href="../auth/logout.php" class="logout-btn">Logout</a>
        </li>
    </ul>
</nav>

<div id="content" class="content">