<?php
include '../template/header.php';
include '../template/sidebar.php';
include '../config/koneksi.php';

// Logika Hapus
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM kriteria WHERE id_kriteria='$id'");
    echo "<script>location='kriteria.php';</script>";
}

// Logika Edit
if(isset($_POST['update'])){
    $id = $_POST['id_kriteria'];
    $kode = mysqli_real_escape_string($koneksi, $_POST['kode']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $bobot = $_POST['bobot'];
    $label = $_POST['label'];
    mysqli_query($koneksi, "UPDATE kriteria SET kode_kriteria='$kode', nama_kriteria='$nama', bobot='$bobot', sifat='$label' WHERE id_kriteria='$id'");
    echo "<script>location='kriteria.php';</script>";
}

// Logika Simpan Baru
if(isset($_POST['simpan'])){
    $kode = mysqli_real_escape_string($koneksi, $_POST['kode']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $bobot = $_POST['bobot'];
    $label = $_POST['label'];
    mysqli_query($koneksi,"INSERT INTO kriteria VALUES(NULL, '$kode', '$nama', '$bobot', '$label')");
    echo "<script>alert('Data berhasil disimpan'); window.location='kriteria.php';</script>";
}
?>

<div class="container-fluid">
    <h2 class="mb-4 fw-bold">Setting Data Kriteria</h2>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Tambah Kriteria Baru</h5>
        </div>
        <div class="card-body">
            <form method="post" class="row g-3">
                <div class="col-md-2">
                    <input type="text" name="kode" class="form-control" placeholder="Kode (K1)" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Kriteria" required>
                </div>
                <div class="col-md-3">
                    <select name="label" class="form-select">
                        <option value="benefit">Benefit</option>
                        <option value="cost">Cost</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" step="0.01" name="bobot" class="form-control" placeholder="Bobot" required>
                </div>
                <div class="col-md-1">
                    <button type="submit" name="simpan" class="btn btn-primary w-100">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="px-4 py-3">No</th>
                            <th>Kode</th>
                            <th>Nama Kriteria</th>
                            <th>Label</th>
                            <th>Bobot</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=1;
                        $data = mysqli_query($koneksi,"SELECT * FROM kriteria");
                        while($d=mysqli_fetch_array($data)){
                        ?>
                        <tr class="align-middle">
                            <td class="px-4"><?= $no++ ?></td>
                            <td><span class="badge bg-light text-dark border"><?= $d['kode_kriteria'] ?></span></td>
                            <td><?= $d['nama_kriteria'] ?></td>
                            <td><?= ucfirst($d['sifat']) ?></td>
                            <td><?= $d['bobot'] ?></td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editKriteria<?= $d['id_kriteria'] ?>">Edit</button>
                                <a href="?hapus=<?= $d['id_kriteria'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>

                        <div class="modal fade" id="editKriteria<?= $d['id_kriteria'] ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="post">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Kriteria</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id_kriteria" value="<?= $d['id_kriteria'] ?>">
                                            <div class="mb-3">
                                                <label class="form-label">Kode Kriteria</label>
                                                <input type="text" name="kode" class="form-control" value="<?= $d['kode_kriteria'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nama Kriteria</label>
                                                <input type="text" name="nama" class="form-control" value="<?= $d['nama_kriteria'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Label</label>
                                                <select name="label" class="form-select">
                                                    <option value="benefit" <?= $d['sifat'] == 'benefit' ? 'selected' : '' ?>>Benefit</option>
                                                    <option value="cost" <?= $d['sifat'] == 'cost' ? 'selected' : '' ?>>Cost</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Bobot</label>
                                                <input type="number" step="0.01" name="bobot" class="form-control" value="<?= $d['bobot'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../template/footer.php'; ?>