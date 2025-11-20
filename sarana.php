<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sarana & Prasarana</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">Homeschooling</a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a href="profile.php" class="nav-link">Profil Sekolah</a></li>
        <li class="nav-item"><a href="sarana.php" class="nav-link active">Sarana & Prasarana</a></li>
        <li class="nav-item"><a href="visi-misi.php" class="nav-link">Visi Misi</a></li>
        <li class="nav-item"><a href="login-orangtua.php" class="nav-link">Login Orang Tua</a></li>
        <li class="nav-item"><a href="login-admin.php" class="nav-link">Login Admin</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Konten Sarana -->
<section class="container mt-5 pt-5">
  <h2 class="mb-4">Sarana & Prasarana Sekolah</h2>
  
  <div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
      <div class="card h-100 shadow">
        <img src="assets/img/lab.jpg" class="card-img-top" alt="Laboratorium Komputer">
        <div class="card-body">
          <h5 class="card-title">Laboratorium Komputer</h5>
          <p class="card-text">Dilengkapi komputer modern untuk pembelajaran TIK dan pemrograman.</p>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card h-100 shadow">
        <img src="assets/img/perpustakaan.jpg" class="card-img-top" alt="Perpustakaan">
        <div class="card-body">
          <h5 class="card-title">Perpustakaan</h5>
          <p class="card-text">Perpustakaan lengkap dengan buku referensi akademik dan literatur umum.</p>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card h-100 shadow">
        <img src="assets/img/lapangan.jpg" class="card-img-top" alt="Lapangan Olahraga">
        <div class="card-body">
          <h5 class="card-title">Lapangan Olahraga</h5>
          <p class="card-text">Fasilitas lapangan untuk olahraga basket, sepak bola, voli, dan atletik.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-primary text-white text-center py-3 mt-5">
  &copy; <?= date('Y'); ?> PKBM Global Lentera Kasih Pamulang
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
