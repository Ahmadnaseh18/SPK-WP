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

<table border="1" width="100%">
<tr>
  <th>No</th>
  <th>Nama Alternatif</th>
</tr>
<?php
$no=1;
$data = mysqli_query($koneksi,"SELECT * FROM alternatif");
while($d=mysqli_fetch_array($data)){
?>
<tr>
  <td><?= $no++ ?></td>
  <td><?= $d['nama_alternatif'] ?></td>
</tr>
<?php } ?>
</table>

<?php include '../template/footer.php'; ?>
