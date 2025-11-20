<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homeschooling</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <style>
    body {
      background-color: #f8f9fa;
    }
    .navbar {
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .hero-section {
      color: white;
      padding: 150px 0;
      text-align: center;
      height: 500px;
      display: flex;
      align-items: center;
      justify-content: center;
      background-size: cover;
      background-position: center;
      position: relative;
    }
    .hero-overlay {
      position: absolute;
      top:0;
      left:0;
      width:100%;
      height:100%;
      background: rgba(0,0,0,0.5);
    }
    .hero-content {
      position: relative;
      z-index: 2;
    }
    .card:hover {
      transform: translateY(-5px);
      transition: 0.3s;
    }
    footer {
      background-color: #0d6efd;
      color: white;
      padding: 20px 0;
      margin-top: 50px;
    }
    @media (max-width: 768px){
      .hero-section { height: 300px; padding: 80px 0; }
      .hero-section h1 { font-size: 2rem; }
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">Sekolah Nyaman Di Homeschooling</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a href="siswa_baru.php" class="nav-link">Daftar Siswa Baru</a></li>
        <li class="nav-item"><a href="profile.php" class="nav-link">Profil Sekolah</a></li>
        <li class="nav-item"><a href="sarana.php" class="nav-link">Sarana & Prasarana</a></li>
        <li class="nav-item"><a href="visi-misi.php" class="nav-link">Visi Misi</a></li>
        <li class="nav-item"><a href="login-orangtua.php" class="nav-link">Login Orang Tua</a></li>
        <li class="nav-item"><a href="login-admin.php" class="nav-link">Login Admin</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section Carousel dengan Fade Effect -->
<div id="heroCarousel" class="carousel slide carousel-fade mt-5 pt-3" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="hero-section" style="background-image: url('assets/img/sekolah1.jpg');">
        <div class="hero-overlay"></div>
        <div class="hero-content container text-center">
          <h1 class="animate__animated animate__fadeInDown">PKBM Global Lentera Kasih Pamulang</h1>
          <p class="lead animate__animated animate__fadeInUp">Homeschooling Unggulan berprestasi dengan fasilitas modern dan tenaga pendidik profesional.</p>
          <a href="profile.php" class="btn btn-light btn-lg mt-3 shadow">Lihat Profil Sekolah</a>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <div class="hero-section" style="background-image: url('assets/img/sekolah2.jpg');">
        <div class="hero-overlay"></div>
        <div class="hero-content container text-center">
          <h1 class="animate__animated animate__fadeInDown">Lingkungan Belajar Nyaman</h1>
          <p class="lead animate__animated animate__fadeInUp">Fasilitas lengkap mendukung kreativitas dan prestasi siswa.</p>
          <a href="profile.php" class="btn btn-light btn-lg mt-3 shadow">Lihat Profil Sekolah</a>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <div class="hero-section" style="background-image: url('assets/img/sekolah3.jpg');">
        <div class="hero-overlay"></div>
        <div class="hero-content container text-center">
          <h1 class="animate__animated animate__fadeInDown">Prestasi Siswa Gemilang</h1>
          <p class="lead animate__animated animate__fadeInUp">Siswa berprestasi di tingkat nasional dan internasional.</p>
          <a href="profile.php" class="btn btn-light btn-lg mt-3 shadow">Lihat Profil Sekolah</a>
        </div>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!-- Highlight Section -->
<div class="container py-5">
  <div class="text-center mb-5">
    <h2 class="fw-bold text-primary">Kenapa Memilih Kami?</h2>
    <p class="text-muted">Sekolah dengan lingkungan nyaman, fasilitas lengkap, dan program pendidikan unggulan.</p>
  </div>
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card border-0 shadow text-center p-4">
        <img src="assets/img/teacher.png" width="80" class="mx-auto mb-3" alt="Guru">
        <h5 class="fw-bold">Tenaga Pendidik Profesional</h5>
        <p class="text-muted">Guru berpengalaman yang siap membimbing siswa menuju kesuksesan akademik dan karakter.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 shadow text-center p-4">
        <img src="assets/img/facility.png" width="80" class="mx-auto mb-3" alt="Fasilitas">
        <h5 class="fw-bold">Fasilitas Modern</h5>
        <p class="text-muted">Laboratorium, perpustakaan, dan ruang belajar dilengkapi sarana teknologi terkini.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 shadow text-center p-4">
        <img src="assets/img/achievement.png" width="80" class="mx-auto mb-3" alt="Prestasi">
        <h5 class="fw-bold">Prestasi Gemilang</h5>
        <p class="text-muted">Siswa kami telah menorehkan prestasi di tingkat nasional dan internasional.</p>
      </div>
    </div>
  </div>
</div>

<!-- Mini Section Visi Misi -->
<section class="py-5 bg-light">
  <div class="container text-center">
    <h2 class="fw-bold text-primary">Visi & Misi Sekolah</h2>
    <p class="mt-3 text-muted w-75 mx-auto">Menjadi sekolah unggulan yang menghasilkan peserta didik berprestasi, berkarakter, dan berwawasan global.</p>
    <a href="visi-misi.php" class="btn btn-outline-primary mt-3">Baca Selengkapnya</a>
  </div>
</section>

<!-- Footer -->
<footer class="text-center">
  <p class="mb-0">&copy; <?= date('Y'); ?> PKBM Global Lentera Kasih Pamulang | Dikembangkan oleh Mahasiswa UNPAM KP</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
 