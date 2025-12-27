<?php
include '../config/koneksi.php';

/* =========================
   1. AMBIL DATA KRITERIA
========================= */
$kriteria = [];
$q = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY id_kriteria ASC");
while ($row = mysqli_fetch_assoc($q)) {
    $kriteria[] = $row;
}
$n = count($kriteria);

if ($n < 2) {
    die("Minimal harus ada 2 kriteria");
}

/* =========================
   2. BENTUK MATRIKS AHP
========================= */
$matriks = [];

for ($i = 0; $i < $n; $i++) {
    for ($j = 0; $j < $n; $j++) {

        if ($i == $j) {
            $matriks[$i][$j] = 1;
        } else {
            $id1 = $kriteria[$i]['id_kriteria'];
            $id2 = $kriteria[$j]['id_kriteria'];

            // Cek langsung
            $q1 = mysqli_query($koneksi,
                "SELECT nilai FROM ahp_perbandingan 
                 WHERE kriteria_1='$id1' AND kriteria_2='$id2'"
            );
            $d1 = mysqli_fetch_assoc($q1);

            if ($d1) {
                $matriks[$i][$j] = $d1['nilai'];
            } else {
                // Cek kebalikannya
                $q2 = mysqli_query($koneksi,
                    "SELECT nilai FROM ahp_perbandingan 
                     WHERE kriteria_1='$id2' AND kriteria_2='$id1'"
                );
                $d2 = mysqli_fetch_assoc($q2);

                $matriks[$i][$j] = $d2 ? (1 / $d2['nilai']) : 1;
            }
        }
    }
}

/* =========================
   3. NORMALISASI MATRIKS
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
   4. HITUNG BOBOT AHP
========================= */
$bobot = [];

for ($i = 0; $i < $n; $i++) {
    $bobot[$i] = array_sum($normal[$i]) / $n;
}

/* =========================
   5. SIMPAN BOBOT KE DB
   (TANPA CEK CR)
========================= */
for ($i = 0; $i < $n; $i++) {
    $id = $kriteria[$i]['id_kriteria'];
    $b  = round($bobot[$i], 6);

    mysqli_query(
        $koneksi,
        "UPDATE kriteria SET bobot='$b' WHERE id_kriteria='$id'"
    );
}

/* =========================
   6. REDIRECT
========================= */
header("Location: hitung.php?status=success");
exit;
