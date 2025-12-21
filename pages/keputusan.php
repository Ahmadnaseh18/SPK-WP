<?php
include '../template/header.php';
include '../template/sidebar.php';
include '../config/koneksi.php';
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Pencarian Keputusan</h2>
        <span class="badge bg-info text-dark p-2">Metode: Weighted Product (WP)</span>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="px-4 py-3 text-center" width="100">Ranking</th>
                            <th class="py-3">Nama Alternatif</th>
                            <th class="py-3 text-end px-4">Nilai Preferensi (V)</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    // 1. Hitung Total Bobot
                    $totalBobot = 0;
                    $kriteria_data = mysqli_query($koneksi,"SELECT * FROM kriteria");
                    while($k=mysqli_fetch_array($kriteria_data)){
                        $totalBobot += $k['bobot'];
                    }

                    // 2. Hitung Nilai S untuk setiap alternatif
                    $hasil = [];
                    $alternatif = mysqli_query($koneksi,"SELECT * FROM alternatif");
                    
                    if (mysqli_num_rows($alternatif) > 0) {
                        while($a=mysqli_fetch_array($alternatif)){
                            $S = 1;
                            $kriteria_query = mysqli_query($koneksi,"SELECT * FROM kriteria");
                            while($k=mysqli_fetch_array($kriteria_query)){
                                // Ambil nilai berdasarkan id_alternatif dan id_kriteria
                                $n_query = mysqli_query($koneksi,"SELECT nilai FROM nilai WHERE id_alternatif='$a[id_alternatif]' AND id_kriteria='$k[id_kriteria]'");
                                $n = mysqli_fetch_array($n_query);

                                // Normalisasi Bobot (W)
                                $w = $k['bobot'] / $totalBobot;
                                
                                // Jika sifat 'cost', pangkat menjadi negatif
                                // Sesuaikan 'sifat' dengan nama kolom di DB anda (tadi di gambar terlihat 'sifat')
                                if(strtolower($k['sifat']) == 'cost') {
                                    $w = -$w;
                                }

                                // Ambil nilai, jika kosong anggap 1 agar pow() tidak error
                                $val = (isset($n['nilai']) && $n['nilai'] > 0) ? $n['nilai'] : 1;
                                $S *= pow($val, $w);
                            }
                            $hasil[$a['nama_alternatif']] = $S;
                        }

                        // 3. Ranking (Sortir dari terbesar ke terkecil)
                        arsort($hasil);

                        $rank=1;
                        foreach($hasil as $nama => $nilai){
                            $bg_row = ($rank == 1) ? 'table-success' : '';
                        ?>
                        <tr class="<?= $bg_row ?>">
                            <td class="px-4 text-center">
                                <?php if($rank == 1): ?>
                                    <span class="badge bg-warning text-dark border border-dark">1</span>
                                <?php else: ?>
                                    <?= $rank ?>
                                <?php endif; ?>
                            </td>
                            <td class="fw-bold"><?= $nama ?></td>
                            <td class="text-end px-4 fw-bold text-primary"><?= number_format($nilai, 4) ?></td>
                        </tr>
                        <?php 
                            $rank++;
                        } 
                    } else {
                        echo "<tr><td colspan='3' class='text-center py-4'>Belum ada data alternatif.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
// Simpan ke riwayat HANYA jika ada hasil
if (!empty($hasil)) {
    $json_hasil = mysqli_real_escape_string($koneksi, json_encode($hasil));
    
    // Coba simpan dengan nama kolom 'hasil' (sesuaikan jika di DB anda namanya berbeda)
    // Saya menghapus nama kolom spesifik agar SQL mencoba masuk ke urutan kolom yang ada
    mysqli_query($koneksi, "INSERT INTO riwayat VALUES (NULL, NOW(), '$json_hasil')");
}

include '../template/footer.php'; 
?>