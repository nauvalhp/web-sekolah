<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login-admin.php");
    exit;
}

include '../config/koneksi.php';

// ambil id kelas dari URL
$id_kelas = isset($_GET['id_kelas']) ? $_GET['id_kelas'] : 0;

// ambil data kelas
$qkelas = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id='$id_kelas'");
$kelas = mysqli_fetch_assoc($qkelas);

// tambah siswa baru
if (isset($_POST['tambah'])) {
    $nis = $_POST['nis'];
    $nama_siswa = $_POST['nama_siswa'];
    $nama_ortu = $_POST['nama_ortu'];
    $password = md5($_POST['password']); // password untuk login orang tua

    $query = "INSERT INTO siswa (nis, nama_siswa, nama_ortu, id_kelas, password)
              VALUES ('$nis', '$nama_siswa', '$nama_ortu', '$id_kelas', '$password')";
    mysqli_query($koneksi, $query);
    header("Location: siswa.php?id_kelas=$id_kelas");
    exit;
}

// hapus siswa

// --- Hapus siswa ---
if (isset($_GET['hapus'])) {
    $id_siswa = intval($_GET['hapus']);
    $id_kelas = intval($_GET['id_kelas']); // ambil dari URL juga

    // Hapus dulu semua nilai milik siswa ini (supaya tidak error FK)
    mysqli_query($koneksi, "DELETE FROM nilai WHERE id_siswa='$id_siswa'");

    // Baru hapus data siswa
    $hapus = mysqli_query($koneksi, "DELETE FROM siswa WHERE id='$id_siswa'");

    if ($hapus) {
        header("Location: siswa.php?id_kelas=$id_kelas");
        exit;
    } else {
        echo "<script>alert('Gagal menghapus data siswa!'); window.location='siswa.php?id_kelas=$id_kelas';</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Siswa - <?= htmlspecialchars($kelas['nama_kelas'] ?? '') ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php">Dashboard Admin</a>
    <div class="ms-auto">
      <a href="../logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
  </div>
</nav>

<div class="container my-5">
  <h3>Daftar Siswa - <?= htmlspecialchars($kelas['nama_kelas']) ?></h3>
  
  <!-- Tombol Tambah Siswa -->
  <button class="btn btn-success my-3" data-bs-toggle="modal" data-bs-target="#modalTambah">+ Tambah Siswa</button>

  <table class="table table-bordered table-hover">
    <thead class="table-primary">
      <tr>
        <th>No</th>
        <th>NIS</th>
        <th>Nama Siswa</th>
        <th>Nama Orang Tua</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_kelas='$id_kelas'");
      while ($row = mysqli_fetch_assoc($query)) {
          echo "
          <tr>
            <td>{$no}</td>
            <td>{$row['nis']}</td>
            <td>{$row['nama_siswa']}</td>
            <td>{$row['nama_ortu']}</td>
            <td>
              <a href='nilai.php?id_siswa={$row['id']}' class='btn btn-sm btn-primary'>Lihat Nilai</a>
              <a href='?id_kelas=$id_kelas&hapus={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Yakin hapus siswa ini?\")'>Hapus</a>
            </td>
          </tr>
          ";
          $no++;
      }
      ?>
    </tbody>
  </table>

  <a href="dashboard.php" class="btn btn-secondary mt-3">← Kembali ke Daftar Kelas</a>
</div>

<!-- Modal Tambah Siswa -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Tambah Siswa Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST">
        <div class="modal-body">
          <div class="mb-3">
            <label>NIS</label>
            <input type="text" name="nis" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Nama Siswa</label>
            <input type="text" name="nama_siswa" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Nama Orang Tua</label>
            <input type="text" name="nama_ortu" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Password untuk Login Orang Tua</label>
            <input type="text" name="password" class="form-control" required>
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
