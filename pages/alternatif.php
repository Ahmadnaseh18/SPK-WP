<?php
include '../template/header.php';
include '../template/sidebar.php';
include '../config/koneksi.php';

// Logika Hapus
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM nilai WHERE id_alternatif='$id'");
    mysqli_query($koneksi, "DELETE FROM alternatif WHERE id_alternatif='$id'");
    echo "<script>location='alternatif.php';</script>";
}

// Logika Simpan
if(isset($_POST['simpan'])){
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    mysqli_query($koneksi,"INSERT INTO alternatif VALUES(NULL,'$nama')");
    $id_alt = mysqli_insert_id($koneksi);

    $kriteria = mysqli_query($koneksi,"SELECT * FROM kriteria");
    while($k = mysqli_fetch_array($kriteria)){
        $nilai = $_POST['nilai'][$k['id_kriteria']];
        mysqli_query($koneksi,"INSERT INTO nilai VALUES(NULL,'$id_alt','$k[id_kriteria]','$nilai')");
    }
    echo "<script>alert('Data Alternatif Berhasil Disimpan'); window.location='alternatif.php';</script>";
}

function getNilai($koneksi, $id_alternatif, $id_kriteria) {
    $query = mysqli_query($koneksi, "SELECT nilai FROM nilai WHERE id_alternatif = '$id_alternatif' AND id_kriteria = '$id_kriteria'");
    $data = mysqli_fetch_assoc($query);
    return $data['nilai'] ?? '-';
}
?>

<div class="container-fluid">
    <h2 class="mb-4 fw-bold">Data Alternatif</h2>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Tambah Alternatif & Nilai</h5>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-4">
                    <label class="form-label fw-bold">Nama Calon Karyawan</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                </div>
                <div class="row">
                    <?php
                    $kriteria = mysqli_query($koneksi,"SELECT * FROM kriteria");
                    while($k=mysqli_fetch_array($kriteria)){
                    ?>
                    <div class="col-md-3 mb-3">
                        <label class="form-label small"><?= $k['nama_kriteria'] ?></label>
                        <input type="number" step="0.01" name="nilai[<?= $k['id_kriteria'] ?>]" class="form-control" placeholder="Nilai" required>
                    </div>
                    <?php } ?>
                </div>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan Alternatif</button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 text-nowrap">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="px-4 py-3">No</th>
                            <th>Nama Alternatif</th>
                            <?php
                            $kriteria = mysqli_query($koneksi,"SELECT * FROM kriteria");
                            while($krite = mysqli_fetch_assoc($kriteria)){
                                echo "<th>{$krite['nama_kriteria']}</th>";
                            }
                            ?>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=1;
                        $alternatif = mysqli_query($koneksi,"SELECT * FROM alternatif");
                        while($d=mysqli_fetch_array($alternatif)){
                        ?>
                        <tr class="align-middle">
                            <td class="px-4"><?= $no++ ?></td>
                            <td class="fw-bold"><?= $d['nama_alternatif'] ?></td>
                            <?php
                            $kriteria2 = mysqli_query($koneksi,"SELECT * FROM kriteria");
                            while($krite2 = mysqli_fetch_assoc($kriteria2)){
                                echo "<td>".getNilai($koneksi, $d['id_alternatif'], $krite2['id_kriteria']) . "</td>";
                            }
                            ?>
                            <td class="text-center">
                                <a href="?hapus=<?= $d['id_alternatif'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../template/footer.php'; ?>