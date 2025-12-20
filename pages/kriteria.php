<?php
include '../template/header.php';
include '../template/sidebar.php';
include '../config/koneksi.php';

if(isset($_POST['simpan'])){
  mysqli_query($koneksi,"INSERT INTO kriteria VALUES(
    NULL,
    '$_POST[kode]',
    '$_POST[nama]',
    $_POST[bobot],
    '$_POST[label]'
  )");
}
?>

<h2>Setting Data Kriteria</h2>

<form method="post">
  <input type="text" name="kode" placeholder="Kode Kriteria" required>
  <input type="text" name="nama" placeholder="Nama Kriteria" required>
  <select name="label">
    <option value="benefit">Benefit</option>
    <option value="cost">Cost</option>
  </select>
  <input type="number" step="0.01" name="bobot" placeholder="Bobot" required>
  <button type="submit" name="simpan">Simpan</button>
</form>

<br>

<table border="1" width="100%">
<tr>
  <th>No</th>
  <th>Kode</th>
  <th>Nama Kriteria</th>
  <th>Label</th>
  <th>Bobot</th>
</tr>

<?php
$no=1;
$data = mysqli_query($koneksi,"SELECT * FROM kriteria");
while($d=mysqli_fetch_array($data)){
?>
<tr>
  <td><?= $no++ ?></td>
  <td><?= $d['kode_kriteria'] ?></td>
  <td><?= $d['nama_kriteria'] ?></td>
  <td><?= ucfirst($d['sifat']) ?></td>
  <td><?= $d['bobot'] ?></td>
</tr>
<?php } ?>
</table>

<?php include '../template/footer.php'; ?>
