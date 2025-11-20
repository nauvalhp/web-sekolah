<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login-admin.php");
    exit;
}

include '../config/koneksi.php'; // koneksi database

$id_siswa = isset($_GET['id_siswa']) ? intval($_GET['id_siswa']) : 0;
if ($id_siswa <= 0) {
    die("ID siswa tidak valid.");
}

// Ambil data siswa
$stmt = $koneksi->prepare("SELECT s.*, k.nama_kelas FROM siswa s 
                           LEFT JOIN kelas k ON s.id_kelas = k.id 
                           WHERE s.id = ?");
$stmt->bind_param("i", $id_siswa);
$stmt->execute();
$siswa = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$siswa) {
    die("Data siswa tidak ditemukan.");
}

// Ambil data nilai
$stmt = $koneksi->prepare("SELECT mapel, nilai FROM nilai WHERE id_siswa = ? ORDER BY mapel ASC");
$stmt->bind_param("i", $id_siswa);
$stmt->execute();
$nilai_result = $stmt->get_result();
$stmt->close();

// Hitung rata-rata
$stmt = $koneksi->prepare("SELECT AVG(nilai) AS rata2 FROM nilai WHERE id_siswa = ?");
$stmt->bind_param("i", $id_siswa);
$stmt->execute();
$rata = $stmt->get_result()->fetch_assoc()['rata2'] ?? 0;
$stmt->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Cetak Nilai Siswa - <?= htmlspecialchars($siswa['nama_siswa']) ?></title>
<style>
body { font-family: Arial, sans-serif; margin: 40px; }
.kop { text-align: center; border-bottom: 3px solid #000; margin-bottom: 20px; padding-bottom: 10px; }
table { width: 100%; border-collapse: collapse; margin-top: 15px; }
th, td { border: 1px solid #000; padding: 8px; }
th { background: #f0f0f0; }
.ttd { margin-top: 50px; text-align: right; }
.no-print { margin-top: 20px; text-align: center; }
@media print { .no-print { display: none; } }
</style>
</head>
<body onload="window.print()">

<div class="kop">
  <h2>PKBM GLOBAL LENTERA KASIH PAMULANG</h2>
  <p>Pamulang Permai 1 Blok A6 No 8 – Pamulang Barat, Kota Tangerang Selatan</p>
  <h3>DAFTAR NILAI SISWA</h3>
</div>

<p>
<strong>Nama:</strong> <?= htmlspecialchars($siswa['nama_siswa']) ?><br>
<strong>Kelas:</strong> <?= htmlspecialchars($siswa['nama_kelas']) ?><br>
<strong>Orang Tua:</strong> <?= htmlspecialchars($siswa['nama_ortu'] ?? '-') ?>
</p>

<table>
<thead>
<tr>
<th width="10%">No</th>
<th>Mata Pelajaran</th>
<th width="20%">Nilai</th>
</tr>
</thead>
<tbody>
<?php
$no = 1;
if ($nilai_result->num_rows > 0) {
    while ($row = $nilai_result->fetch_assoc()) {
        echo "<tr>
                <td>{$no}</td>
		   <td>" . htmlspecialchars($row['mapel']) . "</td>
                <td>" . htmlspecialchars($row['nilai']) . "</td>
              </tr>";
        $no++;
    }
} else {
    echo "<tr><td colspan='3' style='text-align:center'>Belum ada nilai.</td></tr>";
}
?>
</tbody>
</table>

<p><strong>Rata-rata Nilai:</strong> <?= number_format($rata, 2) ?></p>

<div class="ttd">
<p>Pamulang, <?= date('d F Y') ?></p>
<p>Kepala Sekolah</p><br><br><br>
<p><strong>(Emy Ida Royani S.Si)</strong></p>
</div>

<div class="no-print">
<!-- Tombol manual cetak -->
<button onclick="window.print()">🖨️ Cetak Halaman</button>
<a href="nilai.php?id_siswa=<?= $id_siswa ?>">Kembali</a>
</div>

</body>
</html>
