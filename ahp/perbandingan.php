<?php
include '../template/header.php';
include '../template/sidebar.php';
include '../config/koneksi.php';

// Ambil data kriteria dari database
$q = mysqli_query($koneksi, "SELECT * FROM kriteria");
$kriteria = [];
while ($row = mysqli_fetch_assoc($q)) {
    $kriteria[] = $row;
}
?>

<div class="container-fluid mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Perbandingan Kriteria (AHP)</h5>
        </div>
        <div class="card-body">
            <form action="simpan_perbandingan.php" method="post">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th width="35%">Kriteria 1</th>
                                <th width="30%">Nilai Perbandingan</th>
                                <th width="35%">Kriteria 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n = count($kriteria);
                            for ($i = 0; $i < $n; $i++) {
                                for ($j = $i + 1; $j < $n; $j++) {
                            ?>
                                    <tr>
                                        <td><?= $kriteria[$i]['nama_kriteria']; ?></td>
                                        <td class="text-center">
                                            <select 
                                                name="nilai[<?= $kriteria[$i]['id_kriteria']; ?>][<?= $kriteria[$j]['id_kriteria']; ?>]" 
                                                class="form-select text-center" 
                                                required
                                            >
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
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-success px-4">
                        💾 Simpan Perbandingan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../template/footer.php'; ?>