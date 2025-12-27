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
                            <th class="px-4 py-3 text-center">Ranking</th>
                            <th>Nama Alternatif</th>
                            <th class="text-end px-4">Nilai Preferensi (V)</th>
                        </tr>
                    </thead>
                    <tbody>

<?php
/* ===============================
   1. AMBIL DATA KRITERIA
================================ */
$kriteria = [];
$qk = mysqli_query($koneksi, "SELECT * FROM kriteria");
while ($k = mysqli_fetch_assoc($qk)) {
    $kriteria[] = $k;
}

/* ===============================
   2. HITUNG TOTAL BOBOT
================================ */
$totalBobot = 0;
foreach ($kriteria as $k) {
    $totalBobot += $k['bobot'];
}

/* ===============================
   3. HITUNG VEKTOR S
================================ */
$S = [];
$qAlt = mysqli_query($koneksi, "SELECT * FROM alternatif");

while ($a = mysqli_fetch_assoc($qAlt)) {
    $nilaiS = 1;

    foreach ($kriteria as $k) {
        $idAlt = $a['id_alternatif'];
        $idKri = $k['id_kriteria'];

        $qn = mysqli_query(
            $koneksi,
            "SELECT nilai FROM nilai 
             WHERE id_alternatif='$idAlt' 
             AND id_kriteria='$idKri'"
        );
        $n = mysqli_fetch_assoc($qn);

        // nilai alternatif
        $x = ($n && $n['nilai'] > 0) ? $n['nilai'] : 1;

        // bobot ternormalisasi
        $w = $k['bobot'] / $totalBobot;

        // jika cost → negatif
        if ($k['sifat'] == 'cost') {
            $w = -$w;
        }

        $nilaiS *= pow($x, $w);
    }

    $S[$a['nama_alternatif']] = $nilaiS;
}

/* ===============================
   4. HITUNG VEKTOR V
================================ */
$totalS = array_sum($S);
$V = [];

foreach ($S as $nama => $nilaiS) {
    $V[$nama] = $nilaiS / $totalS;
}

/* ===============================
   5. RANKING
================================ */
arsort($V);
$rank = 1;

foreach ($V as $nama => $nilai) {
?>
<tr class="<?= ($rank == 1) ? 'table-success' : '' ?>">
    <td class="text-center px-4 fw-bold"><?= $rank ?></td>
    <td><?= $nama ?></td>
    <td class="text-end px-4 fw-bold text-primary">
        <?= number_format($nilai, 5) ?>
    </td>
</tr>
<?php
    $rank++;
}
?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
/* ===============================
   6. SIMPAN KE RIWAYAT
================================ */
if (!empty($V)) {
    $json = mysqli_real_escape_string($koneksi, json_encode($V));
    mysqli_query(
        $koneksi,
        "INSERT INTO riwayat VALUES (NULL, NOW(), '$json')"
    );
}

include '../template/footer.php';
?>
