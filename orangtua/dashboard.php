<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['ortu_id'])) {
    header("Location: ../login-orangtua.php");
    exit;
}

$id_siswa = $_SESSION['ortu_id'];

// ambil data siswa + kelas
$q = mysqli_query($koneksi, "SELECT s.*, k.nama_kelas 
                             FROM siswa s 
                             JOIN kelas k ON s.id_kelas=k.id 
                             WHERE s.id='$id_siswa'");
$siswa = mysqli_fetch_assoc($q);

// ambil nilai
$qnilai = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_siswa='$id_siswa'");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Orang Tua</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">Dashboard Orang Tua</a>
    <div class="ms-auto">
      <a href="../logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
  </div>
</nav>

<div class="container my-5">
  <div class="alert alert-info">
    <strong>Selamat Datang, <?= htmlspecialchars($_SESSION['ortu_nama']); ?>!</strong><br>
    Berikut hasil ujian anak Anda:
  </div>

  <table class="table table-bordered">
    <tr><th>Nama Siswa</th><td><?= htmlspecialchars($siswa['nama_siswa']); ?></td></tr>
    <tr><th>Kelas</th><td><?= htmlspecialchars($siswa['nama_kelas']); ?></td></tr>
    <tr><th>Nama Orang Tua</th><td><?= htmlspecialchars($siswa['nama_ortu']); ?></td></tr>
  </table>

  <h4 class="mt-4 mb-3">Nilai Mata Pelajaran</h4>
  <table class="table table-striped">
    <thead class="table-primary">
      <tr>
        <th>No</th>
        <th>Mata Pelajaran</th>
        <th>Nilai</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1; $total = 0; $count = 0;
      $mapel = []; $nilaiArr = [];
      while ($row = mysqli_fetch_assoc($qnilai)) {
          echo "<tr>
                  <td>{$no}</td>
                  <td>{$row['mapel']}</td>
                  <td>{$row['nilai']}</td>
                </tr>";
          $no++;
          $total += $row['nilai'];
          $count++;
          $mapel[] = $row['mapel'];
          $nilaiArr[] = $row['nilai'];
      }
      $rata = ($count > 0) ? round($total / $count, 2) : 0;
      ?>
    </tbody>
  </table>

  <h5 class="mt-3">Rata-rata Nilai: <span class="text-primary fw-bold"><?= $rata; ?></span></h5>

  <canvas id="chartNilai" class="mt-4"></canvas>
</div>

<script>
const ctx = document.getElementById('chartNilai');
new Chart(ctx, {
  type: 'bar',
  data: {
    labels: <?= json_encode($mapel); ?>,
    datasets: [{
      label: 'Nilai Mata Pelajaran',
      data: <?= json_encode($nilaiArr); ?>,
      backgroundColor: 'rgba(54, 162, 235, 0.6)',
      borderColor: 'rgba(54, 162, 235, 1)',
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: { beginAtZero: true, max: 100 }
    }
  }
});
</script>

</body>
</html>
