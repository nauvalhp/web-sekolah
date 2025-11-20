<?php
$koneksi = new mysqli("localhost", "root", "", "sekolah_db");
if ($koneksi->connect_error) { die("Koneksi gagal: " . $koneksi->connect_error); }

$nama = $nis = $kelas = $alamat = "";
$foto_siswa_path = $ktp_path = $kk_path = $ijazah_path = "";

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];

    // Upload Helper
    function uploadFile($field){
        $file = $_FILES[$field]['name'];
        $tmp = $_FILES[$field]['tmp_name'];
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $folder = "uploads/";
        if (!file_exists($folder)) { mkdir($folder, 0777, true); }
        $new_name = uniqid().".".$ext;
        move_uploaded_file($tmp, $folder.$new_name);
        return $folder.$new_name;
    }

    // Upload semua file
    $foto_siswa_path = uploadFile('foto_siswa');
    $ktp_path = uploadFile('ktp');
    $kk_path = uploadFile('kk');
    $ijazah_path = uploadFile('ijazah');

    $query = "INSERT INTO siswa_baru (nama, nis, kelas, alamat, foto_siswa, ktp, kk, ijazah) 
              VALUES ('$nama', '$nis', '$kelas', '$alamat', '$foto_siswa_path', '$ktp_path', '$kk_path', '$ijazah_path')";

    if ($koneksi->query($query)) {
        $alert = "Pendaftaran berhasil.";
        $success = true;
    } else {
        $alert = "Gagal mendaftar: " . $koneksi->error;
        $success = false;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light py-5">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Pendaftaran Siswa Baru</h4>
                </div>
                <div class="card-body">
                    <?php if(isset($alert)) { echo "<div class='alert alert-info'>$alert</div>"; } ?>

                    <?php if(isset($success) && $success === true) { ?>

                    <div class="mt-3 p-3 border rounded bg-white">
                        <h5 class="mb-3">Bukti Pendaftaran</h5>
                        <p><strong>Nama:</strong> <?php echo $nama; ?></p>
                        <p><strong>NIS:</strong> <?php echo $nis; ?></p>
                        <p><strong>Kelas:</strong> <?php echo $kelas; ?></p>
                        <p><strong>Alamat:</strong> <?php echo $alamat; ?></p>
                        <p><strong>Foto Siswa:</strong><br><img src="<?php echo $foto_siswa_path; ?>" width="180" class="border rounded shadow"></p>
                        <p><strong>KTP:</strong><br><img src="<?php echo $ktp_path; ?>" width="180" class="border rounded shadow"></p>
                        <p><strong>Kartu Keluarga:</strong><br><img src="<?php echo $kk_path; ?>" width="180" class="border rounded shadow"></p>
                        <p><strong>Ijazah/Raport:</strong><br><img src="<?php echo $ijazah_path; ?>" width="180" class="border rounded shadow"></p>
                        <button class="btn btn-success w-100" onclick="window.print()">Print Bukti Pendaftaran</button>
                    </div>

                    <?php } else { ?>

                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NIS</label>
                            <input type="text" name="nis" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kelas</label>
                            <input type="text" name="kelas" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Upload KTP</label>
                            <input type="file" name="ktp" class="form-control" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload Kartu Keluarga</label>
                            <input type="file" name="kk" class="form-control" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload Ijazah / Raport Terakhir</label>
                            <input type="file" name="ijazah" class="form-control" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto Siswa</label>
                            <input type="file" name="foto_siswa" class="form-control" accept="image/*" required>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary w-100">Daftar</button>
                    </form>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
