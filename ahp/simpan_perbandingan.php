<?php
include '../config/koneksi.php';

$data = $_POST['nilai'];

foreach ($data as $k1 => $arr) {
  foreach ($arr as $k2 => $nilai) {

    // simpan k1 vs k2
    mysqli_query($conn,
      "INSERT INTO ahp_perbandingan (kriteria_1, kriteria_2, nilai)
       VALUES ('$k1', '$k2', '$nilai')"
    );

    // simpan kebalikannya
    $kebalikan = 1 / $nilai;
    mysqli_query($conn,
      "INSERT INTO ahp_perbandingan (kriteria_1, kriteria_2, nilai)
       VALUES ('$k2', '$k1', '$kebalikan')"
    );
  }
}

header("Location: perbandingan.php?status=sukses");
