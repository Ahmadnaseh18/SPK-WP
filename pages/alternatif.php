<?php
include '../template/header.php';
include '../template/sidebar.php';
include '../config/koneksi.php';

// --- LOGIKA HAPUS ---
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM nilai WHERE id_alternatif='$id'");
    mysqli_query($koneksi, "DELETE FROM alternatif WHERE id_alternatif='$id'");
    echo "<script>alert('Data Berhasil Dihapus'); location='alternatif.php';</script>";
}

// --- LOGIKA SIMPAN (DATA BARU) ---
if(isset($_POST['simpan'])){
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    mysqli_query($koneksi,"INSERT INTO alternatif (nama_alternatif) VALUES ('$nama')");
    $id_alt = mysqli_insert_id($koneksi);

    $kriteria = mysqli_query($koneksi,"SELECT * FROM kriteria");
    while($k = mysqli_fetch_array($kriteria)){
        $id_k = $k['id_kriteria'];
        $nilai = $_POST['nilai'][$id_k];
        mysqli_query($koneksi,"INSERT INTO nilai (id_alternatif, id_kriteria, nilai) VALUES ('$id_alt','$id_k','$nilai')");
    }
    echo "<script>alert('Data Alternatif Berhasil Disimpan'); window.location='alternatif.php';</script>";
}

// --- LOGIKA UPDATE (EDIT DATA) ---
if (isset($_POST['update'])) {
    $id_alt = $_POST['id_alternatif'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);

    // Update nama di tabel alternatif
    mysqli_query($koneksi, "UPDATE alternatif SET nama_alternatif='$nama' WHERE id_alternatif='$id_alt'");

    // Update nilai di tabel nilai (Cek dulu apakah barisnya ada)
    $kriteria = mysqli_query($koneksi, "SELECT * FROM kriteria");
    while ($k = mysqli_fetch_assoc($kriteria)) {
        $id_k = $k['id_kriteria'];
        $nilai = $_POST['nilai'][$id_k];
        
        $cek_nilai = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_alternatif='$id_alt' AND id_kriteria='$id_k'");
        if(mysqli_num_rows($cek_nilai) > 0){
            mysqli_query($koneksi, "UPDATE nilai SET nilai='$nilai' WHERE id_alternatif='$id_alt' AND id_kriteria='$id_k'");
        } else {
            mysqli_query($koneksi, "INSERT INTO nilai (id_alternatif, id_kriteria, nilai) VALUES ('$id_alt', '$id_k', '$nilai')");
        }
    }
    echo "<script>alert('Data Alternatif Berhasil Diupdate'); window.location='alternatif.php';</script>";
}

// --- FUNGSI AMBIL NILAI ---
function getNilai($koneksi, $id_alternatif, $id_kriteria) {
    $query = mysqli_query($koneksi, "SELECT nilai FROM nilai WHERE id_alternatif = '$id_alternatif' AND id_kriteria = '$id_kriteria'");
    $data = mysqli_fetch_assoc($query);
    return $data['nilai'] ?? 0;
}

// --- MODE EDIT (DETEKSI TOMBOL EDIT DI TABEL) ---
$edit = false;
$dataEdit = null;
if (isset($_GET['edit'])) {
    $edit = true;
    $id_edit = (int) $_GET['edit'];
    $qEdit = mysqli_query($koneksi, "SELECT * FROM alternatif WHERE id_alternatif='$id_edit'");
    if (mysqli_num_rows($qEdit) > 0) {
        $dataEdit = mysqli_fetch_assoc($qEdit);
    }
}

// --- LOGIKA PENCARIAN ---
$keyword = $_GET['keyword'] ?? '';
if ($edit) {
    // Saat edit, tampilkan semua agar tabel tetap terlihat lengkap di bawah form edit
    $alternatif = mysqli_query($koneksi, "SELECT * FROM alternatif");
} else {
    $alternatif = mysqli_query($koneksi, "SELECT * FROM alternatif WHERE nama_alternatif LIKE '%$keyword%'");
}
?>

<div class="container-fluid">
    <h2 class="mb-4 fw-bold">Data Alternatif</h2>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white">
            <h5 class="mb-0"><?= $edit ? 'Edit Alternatif' : 'Tambah Alternatif' ?></h5>
        </div>
        <div class="card-body">
            <form method="post" action="alternatif.php">
                <?php if ($edit): ?>
                    <input type="hidden" name="id_alternatif" value="<?= $id_edit ?>">
                <?php endif; ?>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Alternatif</label>
                    <input type="text" name="nama" class="form-control" 
                           value="<?= $edit ? $dataEdit['nama_alternatif'] : '' ?>" required>
                </div>

                <div class="row">
                    <?php
                    $kriteria_form = mysqli_query($koneksi, "SELECT * FROM kriteria");
                    while ($kf = mysqli_fetch_assoc($kriteria_form)) {
                    ?>
                        <div class="col-md-3 mb-3">
                            <label class="form-label small"><?= $kf['nama_kriteria'] ?></label>
                            <input type="number" step="0.01" class="form-control" 
                                   name="nilai[<?= $kf['id_kriteria'] ?>]" 
                                   value="<?= $edit ? getNilai($koneksi, $id_edit, $kf['id_kriteria']) : '' ?>" required>
                        </div>
                    <?php } ?>
                </div>

                <button type="submit" name="<?= $edit ? 'update' : 'simpan' ?>" class="btn btn-primary">
                    <?= $edit ? 'Update Data' : 'Simpan Alternatif' ?>
                </button>

                <?php if ($edit): ?>
                    <a href="alternatif.php" class="btn btn-secondary ms-2">Batal</a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <form method="get" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="keyword" class="form-control" placeholder="Cari alternatif..." value="<?= $keyword ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">🔍 Cari</button>
            </div>
        </div>
    </form>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>No</th>
                        <th>Nama Alternatif</th>
                        <?php
                        $k_head = mysqli_query($koneksi, "SELECT * FROM kriteria");
                        while ($kh = mysqli_fetch_assoc($k_head)) {
                            echo "<th>{$kh['nama_kriteria']}</th>";
                        }
                        ?>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; 
                    while ($d = mysqli_fetch_assoc($alternatif)) { 
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td class="fw-bold"><?= $d['nama_alternatif'] ?></td>
                            <?php
                            $k_body = mysqli_query($koneksi, "SELECT * FROM kriteria");
                            while ($kb = mysqli_fetch_assoc($k_body)) {
                                echo "<td>" . getNilai($koneksi, $d['id_alternatif'], $kb['id_kriteria']) . "</td>";
                            }
                            ?>
                            <td class="text-center">
                                <a href="?edit=<?= $d['id_alternatif'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="?hapus=<?= $d['id_alternatif'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../template/footer.php'; ?>