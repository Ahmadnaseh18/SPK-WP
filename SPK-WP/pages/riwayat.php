<?php
include '../template/header.php';
include '../template/sidebar.php';
include '../config/koneksi.php';
?>

<h2>Riwayat Keputusan</h2>

<table border="1" width="100%">
<tr>
  <th>No</th>
  <th>Tanggal</th>
  <th>Hasil</th>
</tr>

<?php
$no=1;
$data = mysqli_query($koneksi,"SELECT * FROM riwayat ORDER BY tanggal DESC");
while($d=mysqli_fetch_array($data)){
?>
<tr>
  <td><?= $no++ ?></td>
  <td><?= $d['tanggal'] ?></td>
  <td><pre><?= $d['hasil'] ?></pre></td>
</tr>
<?php } ?>

</table>

<?php include '../template/footer.php'; ?>
