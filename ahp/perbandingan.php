<?php
include '../template/footer.php';
include '../template/header.php';
include '../template/sidebar.php';
include '../config/koneksi.php';

// ambil kriteria
$q = mysqli_query($koneksi, "SELECT * FROM kriteria");
$kriteria = [];
while ($row = mysqli_fetch_assoc($q)) {
    $kriteria[] = $row;
}
?>

<h3>Perbandingan Kriteria (AHP)</h3>

<form action="simpan_perbandingan.php" method="post">
    <table border="1" cellpadding="8">
        <tr>
            <th>Kriteria 1</th>
            <th>Nilai</th>
            <th>Kriteria 2</th>
        </tr>

        <?php
        for ($i = 0; $i < count($kriteria); $i++) {
            for ($j = $i + 1; $j < count($kriteria); $j++) {
        ?>
                <tr>
                    <td><?= $kriteria[$i]['nama_kriteria']; ?></td>
                    <td>
                        <select name="nilai[<?= $kriteria[$i]['id']; ?>][<?= $kriteria[$j]['id']; ?>]" required>
                            <option value="">-- Pilih --</option>
                            <option value="1">1 - Sama penting</option>
                            <option value="3">3 - Sedikit lebih penting</option>
                            <option value="5">5 - Lebih penting</option>
                            <option value="7">7 - Sangat penting</option>
                            <option value="9">9 - Mutlak lebih penting</option>
                        </select>
                    </td>
                    <td><?= $kriteria[$j]['nama_kriteria']; ?></td>
                </tr>
        <?php }
        } ?>
    </table>

    <br>
    <button type="submit">Simpan Perbandingan</button>
</form>