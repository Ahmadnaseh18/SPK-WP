<?php
session_start();
if(!isset($_SESSION['login'])){
header("location:auth/login.php");
}
include 'template/header.php';
include 'config/koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard SPK WP</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h2>Sistem Pendukung Keputusan</h2>
<p>Seleksi Calon Karyawan - Metode Weighted Product</p>


<ul class="menu">
<li><a href="pages/kriteria.php">Data Kriteria</a></li>
<li><a href="pages/alternatif.php">Data Alternatif</a></li>
<li><a href="pages/keputusan.php">Pencarian Keputusan</a></li>
<li><a href="pages/riwayat.php">Riwayat Keputusan</a></li>
<li><a href="auth/logout.php">Logout</a></li>
</ul>
</div>
</body>
</html>
<?php include 'template/footer.php'; ?>