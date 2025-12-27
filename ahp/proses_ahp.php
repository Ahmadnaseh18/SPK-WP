<?php
include '../config/koneksi.php';

/* 1. Ambil Semua Data Kriteria */
$kriteria = [];
$q = mysqli_query($koneksi, "SELECT id_kriteria FROM kriteria ORDER BY id_kriteria ASC");
while ($row = mysqli_fetch_assoc($q)) {
    $kriteria[] = $row['id_kriteria'];
}
$n = count($kriteria);

if ($n < 2) { die("Kriteria minimal harus 2."); }

/* 2. Hitung Jumlah per Kolom Matriks */
$jml_kolom = [];
foreach ($kriteria as $k2) {
    $total = 0;
    foreach ($kriteria as $k1) {
        $res = mysqli_query($koneksi, "SELECT nilai FROM ahp_perbandingan WHERE kriteria_1='$k1' AND kriteria_2='$k2'");
        $data = mysqli_fetch_assoc($res);
        $total += ($data ? $data['nilai'] : 1);
    }
    $jml_kolom[$k2] = $total;
}

/* 3. Normalisasi & Hitung Bobot (Eigenvector) */
foreach ($kriteria as $k1) {
    $jml_normalisasi = 0;
    foreach ($kriteria as $k2) {
        $res = mysqli_query($koneksi, "SELECT nilai FROM ahp_perbandingan WHERE kriteria_1='$k1' AND kriteria_2='$k2'");
        $data = mysqli_fetch_assoc($res);
        $nilai = ($data ? $data['nilai'] : 1);
        
        // Normalisasi: Nilai dibagi total kolomnya
        $jml_normalisasi += ($nilai / $jml_kolom[$k2]);
    }
    
    // Nilai Bobot Akhir
    $bobot_akhir = $jml_normalisasi / $n;

    // 4. UPDATE KE DATABASE
    mysqli_query($koneksi, "UPDATE kriteria SET bobot = '$bobot_akhir' WHERE id_kriteria = '$k1'");
}

// Kembali ke halaman kriteria untuk melihat perubahan
header("Location: ../pages/kriteria.php?status=update_bobot_berhasil");
exit();
?>