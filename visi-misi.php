<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Visi & Misi - Homeschooling</title>
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
        <li class="nav-item"><a href="sarana.php" class="nav-link">Sarana & Prasarana</a></li>
        <li class="nav-item"><a href="visi-misi.php" class="nav-link active">Visi Misi</a></li>
        <li class="nav-item"><a href="login-orangtua.php" class="nav-link">Login Orang Tua</a></li>
        <li class="nav-item"><a href="login-admin.php" class="nav-link">Login Admin</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Konten Visi & Misi -->
<section class="container mt-5 pt-5">
  <h2 class="mb-4 text-center">Visi & Misi PKBM Global Lentera Kasih Pamulang</h2>
  
  <div class="row">
    <div class="col-md-6">
      <div class="card shadow mb-4">
        <div class="card-body">
          <h3 class="card-title text-center">Visi</h3>
          <p class="card-text text-center">
            Terwujudnya Ketuntasan Wajib Belajar 9 Tahun, Pendidikan Berkelanjutan, serta Mendorong masyarakat maju, kreatif, bermartabat, mampu bersaing dalam  dunia  kerja  dan dunia usaha sebagai perwujudan kehidupan masyarakat yang sejahtera.
          </p>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card shadow mb-4">
        <div class="card-body">
          <h3 class="card-title text-center">Misi</h3>
          <ul>
            <li>Mewujudkan ketuntasan wajib belajar dengan melayani masyarakat melalui program keaksaraan, Paket A, Paket B dan Paket C.</li>
            <li>Meningkatkan kualitas pendidikan berkelanjutan melalui program Paket C berorientasi kecakapan hidup.</li>
            <li>Meningkatkan keterampilan dan keahlian masyarakat melalui pendidikan pendukung kecakapan hidup.</li>
            <li>Mewujudkan masyarakat yang berbudaya melalui pendidikan karakter.</li>
		<li>Mendorong masyarakat agar mampu bersaing secara kompetitif.</li>
		<li>Meningkatkan mutu pendidikan anak usia dini dan pendidikan masyarakat yang berbasis  pada kebutuhan masyarakat dan berorientasi pada kebutuhan pasar.</li>
		<li>Meningkatkan mutu layanan dengan memperbaiki dan menambah sarana prasaran serta meningkatkan kompetensi pendidik dan tenaga kependidikan.</li>
		<li>Mengikuti Perkembangan Dunia Usaha (Dudi).</li>
		
          </ul>
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
