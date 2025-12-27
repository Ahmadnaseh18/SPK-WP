<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location: auth/login.php");
    exit;
}
include 'template/header.php';
include 'template/sidebar.php';
?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 p-4">
                <h2 class="fw-bold">Selamat Datang, <?= $_SESSION['username']; ?>!</h2>
                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle me-2"></i>
                    Silakan gunakan menu di samping untuk mengelola data kriteria, alternatif, dan melihat hasil keputusan.
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php'; ?>