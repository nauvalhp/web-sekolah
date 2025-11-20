<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login-admin.php");
    exit;
}
include '../config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">Dashboard Admin</a>
    <div class="ms-auto">
      <a href="../logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
  </div>
</nav>

<div class="container my-5">
  <h3>Daftar Kelas</h3>
  <table class="table table-bordered table-hover mt-3">
    <thead class="table-primary">
      <tr>
        <th>No</th>
        <th>Nama Kelas</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
      while ($row = mysqli_fetch_assoc($kelas)) {
        echo "
        <tr>
          <td>{$no}</td>
          <td>{$row['nama_kelas']}</td>
          <td><a href='siswa.php?id_kelas={$row['id']}' class='btn btn-sm btn-primary'>Lihat Siswa</a></td>
        </tr>";
        $no++;
      }
      ?>
    </tbody>
  </table>
</div>


</body>
</html>
