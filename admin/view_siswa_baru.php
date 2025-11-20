<?php
$koneksi = new mysqli("localhost", "root", "", "sekolah_db");
if ($koneksi->connect_error) { die("Koneksi gagal: " . $koneksi->connect_error); }

$query = "SELECT * FROM siswa_baru ORDER BY id DESC";
$result = $koneksi->query($query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Siswa Baru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light py-5">
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h4>Data Siswa Baru</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Foto</th>
                        <th>KTP</th>
                        <th>KK</th>
                        <th>Ijazah/Raport</th>
                    </tr>
                </thead>
                <tbody>
<?php while($row = $result->fetch_assoc()) { ?>
<tr data-bs-toggle="modal" data-bs-target="#previewModal" data-foto="<?php echo $row['foto_siswa']; ?>" data-ktp="<?php echo $row['ktp']; ?>" data-kk="<?php echo $row['kk']; ?>" data-ijazah="<?php echo $row['ijazah']; ?>">
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['nama']; ?></td>
    <td><?php echo $row['nis']; ?></td>
    <td><?php echo $row['kelas']; ?></td>
    <td><?php echo $row['alamat']; ?></td>
</tr>
<?php } ?>
</tbody>

<!-- Modal Preview -->
<div class="modal fade" id="previewModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Preview Dokumen Siswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <iframe id="previewPDF" src="" style="display:none; width:100%; height:500px; border:none;"></iframe>
        <img id="previewImage" src="" class="img-fluid border rounded" style="max-height:500px; cursor: zoom-in;">
      </div>
      <div class="modal-footer d-flex flex-wrap justify-content-center gap-2">
        <button type="button" class="btn btn-primary" id="btnFoto">Foto Siswa</button>
        <button type="button" class="btn btn-secondary" id="btnKTP">KTP</button>
        <button type="button" class="btn btn-warning" id="btnKK">Kartu Keluarga</button>
        <button type="button" class="btn btn-info" id="btnIjazah">Ijazah / Raport</button>
        <a id="downloadFile" class="btn btn-success" href="#" download>Download</a>
      </div>
    </div>
  </div>
</div>

<script>
const modal = document.getElementById('previewModal');
modal.addEventListener('show.bs.modal', function (event) {
  const row = event.relatedTarget;
  const foto = row.getAttribute('data-foto');
  const ktp = row.getAttribute('data-ktp');
  const kk = row.getAttribute('data-kk');
  const ijazah = row.getAttribute('data-ijazah');

  const basePath = 'uploads/';

  function showFile(file) {
    const ext = file.split('.').pop().toLowerCase();
    const img = document.getElementById('previewImage');
    const pdf = document.getElementById('previewPDF');
    const dl = document.getElementById('downloadFile');

    dl.href = basePath + file;

    if (ext === 'pdf') {
      img.style.display = 'none';
      pdf.style.display = 'block';
      pdf.src = basePath + file;
    } else {
      pdf.style.display = 'none';
      img.style.display = 'block';
      img.src = basePath + file;
    }
  }

  showFile(foto);

  document.getElementById('btnFoto').onclick = () => showFile(foto);
  document.getElementById('btnKTP').onclick = () => showFile(ktp);
  document.getElementById('btnKK').onclick = () => showFile(kk);
  document.getElementById('btnIjazah').onclick = () => showFile(ijazah);
});

// Zoom image
const img = document.getElementById('previewImage');
let zoomed = false;
img.onclick = () => {
  zoomed = !zoomed;
  img.style.transform = zoomed ? 'scale(2)' : 'scale(1)';
  img.style.cursor = zoomed ? 'zoom-out' : 'zoom-in';
};
</script>
            </table>
        </div>
    </div>
</div>
</body>
</html>
