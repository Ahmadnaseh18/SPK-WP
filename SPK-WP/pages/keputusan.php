<?php
include '../template/header.php';
include '../template/sidebar.php';
include '../config/koneksi.php';
?>

<h2>Pencarian Keputusan</h2>

<table border="1" width="100%">
<tr>
  <th>Ranking</th>
  <th>Nama Alternatif</th>
  <th>Nilai Preferensi</th>
</tr>

<?php
$totalBobot = 0;
$kriteria = mysqli_query($koneksi,"SELECT * FROM kriteria");
while($k=mysqli_fetch_array($kriteria)){
  $totalBobot += $k['bobot'];
}

$hasil = [];
$alternatif = mysqli_query($koneksi,"SELECT * FROM alternatif");
while($a=mysqli_fetch_array($alternatif)){
  $S = 1;
  $kriteria = mysqli_query($koneksi,"SELECT * FROM kriteria");
  while($k=mysqli_fetch_array($kriteria)){
    $n = mysqli_fetch_array(mysqli_query($koneksi,"
      SELECT nilai FROM nilai 
      WHERE id_alternatif='$a[id_alternatif]' 
      AND id_kriteria='$k[id_kriteria]'
    "));

    $w = $k['bobot'] / $totalBobot;
    if($k['sifat']=='cost') $w = -$w;

    $S *= pow($n['nilai'], $w);
  }
  $hasil[$a['nama_alternatif']] = $S;
}

arsort($hasil);

$rank=1;
foreach($hasil as $nama=>$nilai){
?>
<tr>
  <td><?= $rank++ ?></td>
  <td><?= $nama ?></td>
  <td><?= round($nilai,4) ?></td>
</tr>
<?php } ?>

</table>

<?php
mysqli_query($koneksi,"
INSERT INTO riwayat VALUES(NULL,NOW(),'".json_encode($hasil)."')
");
?>

<?php include '../template/footer.php'; ?>
