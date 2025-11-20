<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Sekolah</title>
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
        <li class="nav-item"><a href="profile.php" class="nav-link active">Profil Sekolah</a></li>
        <li class="nav-item"><a href="sarana.php" class="nav-link">Sarana & Prasarana</a></li>
        <li class="nav-item"><a href="visi-misi.php" class="nav-link">Visi Misi</a></li>
        <li class="nav-item"><a href="login-orangtua.php" class="nav-link">Login Orang Tua</a></li>
        <li class="nav-item"><a href="login-admin.php" class="nav-link">Login Admin</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Konten Profil -->
<section class="container mt-5 pt-5">
  <div class="row">
    <div class="col-md-6">
      <img src="assets/img/sekolah.jpg" alt="Foto Sekolah" class="img-fluid rounded shadow">
    </div>
    <div class="col-md-6">
      <h2>Global Lentera Kasih Pamulang</h2>
      <p>
        Homeschooling adalah sekolah unggulan yang berdiri sejak tahun 2015. 
        Sekolah ini memiliki komitmen tinggi dalam mencetak generasi muda yang cerdas, disiplin, dan berprestasi.
      </p>
      <h5>Alamat:</h5>
      <p>Jl. Pendidikan No. 123, Kota Contoh, Provinsi Contoh</p>
      <h5>Kontak:</h5>
      <p>Email: info@smanegeri-contoh.sch.id | Telp: (021) 1234567</p>
    </div>
  </div>

  <hr class="my-5">

  <!-- Sejarah Singkat -->
  <div class="row">
    <div class="col">
      <h3>Sejarah Singkat</h3>
      <p>
        awalnya merupakan sekolah menengah yang kecil, namun dengan tekad kuat 
        dari para pendidik, sekolah ini berkembang menjadi salah satu sekolah terbaik di kota.
      </p>
    </div>
  </div>

  <hr class="my-5">

  <!-- Visi dan Misi -->
  <div class="row">
    <div class="col-md-6">
      <h3>Visi</h3>
      <p>
        Menjadi sekolah unggulan yang menghasilkan lulusan berprestasi, kreatif, dan berakhlak mulia.
      </p>
    </div>
    <div class="col-md-6">
      <h3>Misi</h3>
      <ul>
        <li>Menyelenggarakan pendidikan berkualitas dan berstandar nasional.</li>
        <li>Mendorong siswa berprestasi dalam akademik dan non-akademik.</li>
        <li>Menciptakan lingkungan sekolah yang disiplin, bersih, dan nyaman.</li>
        <li>Meningkatkan kompetensi guru secara berkala melalui pelatihan.</li>
      </ul>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-primary text-white text-center py-3 mt-5">
  &copy; <?= date('Y'); ?> PKBM Global Lentera Kasih
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
