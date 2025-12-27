<?php
include '../template/header.php';
include '../template/sidebar.php';
include '../config/koneksi.php';
?>

<div class="container-fluid mt-4">
    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Proses Perhitungan Bobot AHP</h5>
        </div>
        <div class="card-body text-center py-5">
            <i class="fas fa-calculator fa-4x text-primary mb-3"></i>
            <h4>Perbandingan kriteria telah disimpan!</h4>
            <p class="text-muted">Klik tombol di bawah untuk menghitung bobot akhir dan memperbarui data kriteria secara otomatis.</p>
            
            <form action="proses_ahp.php" method="post" class="mt-4">
                <button type="submit" class="btn btn-success btn-lg px-5 shadow">
                    <i class="fas fa-sync-alt me-2"></i> Proses & Update Bobot Kriteria
                </button>
            </form>
        </div>
    </div>
</div>

<?php include '../template/footer.php'; ?>