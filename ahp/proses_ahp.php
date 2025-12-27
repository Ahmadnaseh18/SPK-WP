<?php
include '../template/footer.php';
include '../template/header.php';
include '../template/sidebar.php';
include '../config/koneksi.php';

/* =========================
   1. AMBIL DATA KRITERIA
========================= */
$q = mysqli_query($koneksi, "SELECT * FROM kriteria");
$kriteria = [];
while ($row = mysqli_fetch_assoc($q)) {
    $kriteria[] = $row;
}
$n = count($kriteria);

/* =========================
   3.1 BENTUK MATRIKS AHP
========================= */
$matriks = [];

for ($i = 0; $i < $n; $i++) {
    for ($j = 0; $j < $n; $j++) {
        if ($i == $j) {
            $matriks[$i][$j] = 1;
        } else {
            $id1 = $kriteria[$i]['id'];
            $id2 = $kriteria[$j]['id'];

            $q = mysqli_query(
                $conn,
                "SELECT nilai FROM ahp_perbandingan 
         WHERE kriteria_1='$id1' AND kriteria_2='$id2'"
            );
            $d = mysqli_fetch_assoc($q);
            $matriks[$i][$j] = $d['nilai'] ?? 1;
        }
    }
}

/* =========================
   3.2 NORMALISASI
========================= */
$normal = [];
$jumlahKolom = [];

for ($j = 0; $j < $n; $j++) {
    $jumlahKolom[$j] = 0;
    for ($i = 0; $i < $n; $i++) {
        $jumlahKolom[$j] += $matriks[$i][$j];
    }
}

for ($i = 0; $i < $n; $i++) {
    for ($j = 0; $j < $n; $j++) {
        $normal[$i][$j] = $matriks[$i][$j] / $jumlahKolom[$j];
    }
}

/* =========================
   3.3 HITUNG BOBOT
========================= */
$bobot = [];

for ($i = 0; $i < $n; $i++) {
    $bobot[$i] = array_sum($normal[$i]) / $n;
}

/* =========================
   4. HITUNG CR
========================= */
$lambdaMax = 0;
for ($i = 0; $i < $n; $i++) {
    $total = 0;
    for ($j = 0; $j < $n; $j++) {
        $total += $matriks[$i][$j] * $bobot[$j];
    }
    $lambdaMax += $total / $bobot[$i];
}
$lambdaMax /= $n;

$CI = ($lambdaMax - $n) / ($n - 1);
$RI = [0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41];
$CR = $CI / $RI[$n];

/* =========================
   5. SIMPAN BOBOT
========================= */
if ($CR <= 0.1) {
    for ($i = 0; $i < $n; $i++) {
        $id = $kriteria[$i]['id'];
        $b = $bobot[$i];
        mysqli_query(
            $conn,
            "UPDATE kriteria SET bobot='$b' WHERE id='$id'"
        );
    }
    header("Location: hitung.php?status=success");
} else {
    header("Location: hitung.php?status=gagal");
}
