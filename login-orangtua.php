<?php
session_start();
include 'config/koneksi.php';

if (isset($_POST['login'])) {
    $nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
    $password = md5($_POST['password']);

    $query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis' AND password='$password'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $_SESSION['ortu_id'] = $data['id'];
        $_SESSION['ortu_nama'] = $data['nama_ortu'];
        header("Location: orangtua/dashboard.php");
        exit;
    } else {
        $error = "NIS atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Orang Tua</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
          <h4>Login Orang Tua</h4>
        </div>
        <div class="card-body">
          <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
          <form method="POST">
            <div class="mb-3">
              <label>NIS (Nomor Induk Siswa)</label>
              <input type="text" name="nis" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="text-center mt-3">
  <a href="index.php" class="btn btn-primary w-40">
    ← Kembali ke Halaman Utama
  </a>
</body>
</html>
