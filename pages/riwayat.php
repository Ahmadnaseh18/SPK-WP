<?php
include '../template/header.php';
include '../template/sidebar.php';
include '../config/koneksi.php';
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Riwayat Perhitungan</h2>
        <button onclick="window.print()" class="btn btn-outline-secondary btn-sm d-print-none">
            Cetak Laporan
        </button>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="px-4 py-3 text-center" width="80">No</th>
                            <th class="py-3" width="200">Tanggal & Waktu</th>
                            <th class="py-3">Hasil Perangkingan (Nama : Nilai)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        // Mengambil data terbaru di atas
                        $data = mysqli_query($koneksi, "SELECT * FROM riwayat ORDER BY tanggal DESC");
                        
                        if (mysqli_num_rows($data) > 0) {
                            while ($d = mysqli_fetch_array($data)) {
                                // Cek apakah data hasil ada di kolom 'hasil' atau 'hasil_json'
                                $raw_json = $d['hasil'] ?? $d['hasil_json'] ?? '';
                                $hasil_array = json_decode($raw_json, true);
                        ?>
                        <tr>
                            <td class="px-4 text-center text-muted"><?= $no++ ?></td>
                            <td>
                                <div class="fw-bold"><?= date('d M Y', strtotime($d['tanggal'])) ?></div>
                                <small class="text-muted"><?= date('H:i', strtotime($d['tanggal'])) ?> WIB</small>
                            </td>
                            <td class="py-3">
                                <div class="d-flex flex-wrap gap-2">
                                    <?php 
                                    if (is_array($hasil_array)) {
                                        $i = 1;
                                        foreach ($hasil_array as $nama => $nilai) {
                                            // Hanya tampilkan 3 besar di riwayat agar tidak terlalu panjang, atau tampilkan semua
                                            $color = ($i == 1) ? 'bg-success' : 'bg-light text-dark border';
                                            echo "<span class='badge $color p-2'>$i. $nama (".round($nilai, 4).")</span>";
                                            $i++;
                                        }
                                    } else {
                                        echo "<span class='text-danger small italic'>Data korup atau format salah</span>";
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <?php 
                            } 
                        } else {
                            echo "<tr><td colspan='3' class='text-center py-5 text-muted'>Belum ada riwayat keputusan disimpan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* Style tambahan untuk cetak agar sidebar hilang saat diprint */
    @media print {
        #sidebar, .d-print-none {
            display: none !important;
        }
        .content {
            width: 100% !important;
            padding: 0 !important;
        }
        .card {
            border: none !important;
            shadow: none !important;
        }
    }
</style>

<?php include '../template/footer.php'; ?>