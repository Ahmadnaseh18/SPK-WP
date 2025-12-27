<?php
// Mengaktifkan laporan error untuk debugging jika terjadi masalah
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../config/koneksi.php';

// Pastikan variabel koneksi Anda adalah $koneksi. Jika di koneksi.php namanya $conn, ganti di bawah ini.
if (isset($_POST['nilai'])) {
    $data = $_POST['nilai'];

    // 1. Hapus data lama agar tidak menumpuk
    mysqli_query($koneksi, "DELETE FROM ahp_perbandingan");

    foreach ($data as $k1 => $arr) {
        foreach ($arr as $k2 => $nilai) {
            // Simpan perbandingan K1 vs K2
            mysqli_query($koneksi, "INSERT INTO ahp_perbandingan (kriteria_1, kriteria_2, nilai) VALUES ('$k1', '$k2', '$nilai')");

            // Simpan kebalikannya (1/nilai) agar matriks AHP lengkap
            $kebalikan = 1 / $nilai;
            mysqli_query($koneksi, "INSERT INTO ahp_perbandingan (kriteria_1, kriteria_2, nilai) VALUES ('$k2', '$k1', '$kebalikan')");
        }
    }

    // 2. Tambahkan nilai diagonal (Kriteria yang sama vs dirinya sendiri = 1)
    mysqli_query($koneksi, "INSERT INTO ahp_perbandingan (kriteria_1, kriteria_2, nilai) 
                            SELECT id_kriteria, id_kriteria, 1 FROM kriteria");

    // 3. Redirect menggunakan JavaScript jika header() gagal atau blank
    echo "<script>window.location.href='hitung.php?status=sukses';</script>";
    exit();

} else {
    echo "Tidak ada data yang dikirim.";
    echo "<br><a href='perbandingan.php'>Kembali</a>";
}
?>