<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login-admin.php");
    exit;
}

include '../config/koneksi.php';

$id_siswa = isset($_GET['id_siswa']) ? intval($_GET['id_siswa']) : 0;

// Ambil data siswa
$sq = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id='$id_siswa'");
$siswa = mysqli_fetch_assoc($sq);

// --- Tambah Nilai ---
if (isset($_POST['tambah'])) {
    $mapel = $_POST['mapel'];
    $nilai = $_POST['nilai'];
    $keterangan = $_POST['keterangan'];

    mysqli_query($koneksi, "INSERT INTO nilai (id_siswa, mapel, nilai, keterangan)
                            VALUES ('$id_siswa', '$mapel', '$nilai', '$keterangan')");
    header("Location: nilai.php?id_siswa=$id_siswa");
    exit;
}

// --- Edit Nilai ---
if (isset($_POST['edit'])) {
    $id_nilai = $_POST['id_nilai'];
    $mapel = $_POST['mapel'];
    $nilai = $_POST['nilai'];
    $keterangan = $_POST['keterangan'];

    mysqli_query($koneksi, "UPDATE nilai SET mapel='$mapel', nilai='$nilai', keterangan='$keterangan' WHERE id='$id_nilai'");
    header("Location: nilai.php?id_siswa=$id_siswa");
    exit;
}

// --- Hapus Nilai ---
if (isset($_GET['hapus'])) {
    $id_nilai = intval($_GET['hapus']);
    mysqli_query($koneksi, "DELETE FROM nilai WHERE id='$id_nilai'");
    header("Location: nilai.php?id_siswa=$id_siswa");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nilai Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h3>Nilai Siswa: <?= htmlspecialchars($siswa['nama_siswa']) ?></h3>
    <p>NIS: <?= htmlspecialchars($siswa['nis']) ?></p>

    <!-- Tombol Tambah Nilai -->
    <button class="btn btn-success my-3" data-bs-toggle="modal" data-bs-target="#modalTambah">+ Tambah Nilai</button>
	
	<!-- Tombol Cetak Nilai -->
    <a href="print.php?id_siswa=<?= $id_siswa ?>" target="_blank" class="btn btn-info my-3">🖨️ Cetak Nilai</a>


    <table class="table table-bordered table-hover">
        <thead class="table-primary">
        <tr>
            <th>No</th>
            <th>Mata Pelajaran</th>
            <th>Nilai</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $qnilai = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_siswa='$id_siswa'");
        while ($row = mysqli_fetch_assoc($qnilai)) {
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= htmlspecialchars($row['mapel']) ?></td>
                <td><?= htmlspecialchars($row['nilai']) ?></td>
                <td><?= htmlspecialchars($row['keterangan']) ?></td>
                <td>
                    <!-- Tombol Edit -->
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id'] ?>">Edit</button>
                    <a href="?id_siswa=<?= $id_siswa ?>&hapus=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus nilai ini?')">Hapus</a>
                </td>
            </tr>

            <!-- Modal Edit Nilai -->
            <div class="modal fade" id="modalEdit<?= $row['id'] ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-warning text-dark">
                            <h5 class="modal-title">Edit Nilai</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form method="POST">
                            <div class="modal-body">
                                <input type="hidden" name="id_nilai" value="<?= $row['id'] ?>">
                                <div class="mb-3">
                                    <label>Mata Pelajaran</label>
                                    <input type="text" name="mapel" class="form-control" value="<?= htmlspecialchars($row['mapel']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label>Nilai</label>
                                    <input type="number" name="nilai" class="form-control" value="<?= htmlspecialchars($row['nilai']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label>Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" value="<?= htmlspecialchars($row['keterangan']) ?>">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            $no++;
        }
        ?>
        </tbody>
    </table>

    <a href="siswa.php?id_kelas=<?= $siswa['id_kelas'] ?>" class="btn btn-secondary mt-3">← Kembali ke Siswa</a>
</div>

<!-- Modal Tambah Nilai -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Tambah Nilai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Mata Pelajaran</label>
                        <input type="text" name="mapel" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Nilai</label>
                        <input type="number" name="nilai" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
