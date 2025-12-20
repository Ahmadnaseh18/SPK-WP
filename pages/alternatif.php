<?php
include '../template/header.php';
include '../template/sidebar.php';
include '../config/koneksi.php';

// simpan alternatif
if(isset($_POST['simpan'])){
  mysqli_query($koneksi,"INSERT INTO alternatif VALUES(NULL,'$_POST[nama]')");
  $id_alt = mysqli_insert_id($koneksi);

  $kriteria = mysqli_query($koneksi,"SELECT * FROM kriteria");
  while($k = mysqli_fetch_array($kriteria)){
    $nilai = $_POST['nilai'][$k['id_kriteria']];
    mysqli_query($koneksi,"INSERT INTO nilai VALUES(NULL,'$id_alt','$k[id_kriteria]','$nilai')");
  }
}
?>

<h2>Data Alternatif (Calon Karyawan)</h2>

<form method="post">
  <input type="text" name="nama" placeholder="Nama Calon Karyawan" required>

  <h4>Nilai Kriteria</h4>
  <?php
  $kriteria = mysqli_query($koneksi,"SELECT * FROM kriteria");
  while($k=mysqli_fetch_array($kriteria)){
  ?>
    <label><?= $k['nama_kriteria'] ?></label>
    <input type="number" name="nilai[<?= $k['id_kriteria'] ?>]" required>
  <?php } ?>

  <br><br>
  <button type="submit" name="simpan">Simpan</button>
</form>

<hr>
<?php

$alternatif = mysqli_query($koneksi,"SELECT * FROM alternatif");

function getNilai($koneksi, $id_alternatif, $id_kriteria) {
  $query = mysqli_query($koneksi, "SELECT nilai FROM nilai Where id_alternatif = '$id_alternatif' AND id_kriteria = '$id_kriteria'");

  $data = mysqli_fetch_assoc($query);
  return $data['nilai'] ?? '-';
}
?>
<table border="1" width="100%">
<tr>
  <th>No</th>
  <th>Nama Alternatif</th>
  <?php
  $kriteria = mysqli_query($koneksi,"SELECT * FROM kriteria");
  while($krite = mysqli_fetch_assoc($kriteria)){
    echo "<th>{$krite['nama_kriteria']}</th>";
  }
  ?>
</tr>
<?php
$no=1;
while($d=mysqli_fetch_array($alternatif)){
?>
<tr>
  <td><?= $no++ ?></td>
  <td><?= $d['nama_alternatif'] ?></td>
  <?php
  $kriteria2 = mysqli_query($koneksi,"SELECT * FROM kriteria");
  while($krite2 = mysqli_fetch_assoc($kriteria2)){
    echo "<td>".getNilai($koneksi, $d['id_alternatif'], $krite2['id_kriteria']) . "</td>";
  }
  ?>
</tr>
<?php } ?>
</table>

<?php include '../template/footer.php'; ?>
