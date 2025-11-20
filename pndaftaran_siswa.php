<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Formulir Pendaftaran Siswa</title>
  <style>
    :root{--accent:#0b6bff;--muted:#666}
    body{font-family:Inter,system-ui,Arial; background:#f4f6fb; margin:0; padding:24px}
    .card{max-width:700px;margin:0 auto;background:#fff;padding:20px;border-radius:10px;box-shadow:0 8px 30px rgba(20,20,40,0.06)}
    h1{margin:0 0 12px;font-size:20px;text-align:center}
    form{display:grid;gap:12px}
    label{font-size:13px;color:var(--muted);margin-bottom:6px;display:block}
    input[type="text"], input[type="file"]{width:100%;padding:10px;border:1px solid #e6e9ef;border-radius:8px;font-size:14px}
    .hint{font-size:12px;color:#888;margin-top:6px}
    button{background:var(--accent);color:#fff;padding:10px 14px;border:0;border-radius:8px;cursor:pointer}
    button.secondary{background:#e9eefc;color:#111}
    button.print{background:#22bb33}
    .preview{margin-top:8px}
    img.preview-img{max-width:160px;border-radius:8px;border:1px solid #ddd}
    .file-list{font-size:13px;color:#333;margin-top:6px}
    .success{background:#eef9f1;border:1px solid #bfe6c9;padding:10px;border-radius:8px;color:#1b6b2f}
    .error{background:#fff3f3;border:1px solid #f1b0b0;padding:10px;border-radius:8px;color:#8b1b1b}
    @media print {
      body {background: #fff;}
      .card {box-shadow: none; border: none;}
      button {display: none;}
    }
  </style>
</head>
<body>
  <div class="card">
    <h1>Formulir Pendaftaran Siswa</h1>
    <p class="hint" style="text-align:center">Isi data dengan lengkap. Unggah dokumen: KK, KTP, Ijazah/Rapor, dan Foto Siswa.</p>

    <form id="regForm" enctype="multipart/form-data" novalidate>
      <!-- 1. Nama Lengkap -->
      <div>
        <label>1. Nama Lengkap <span style="color:#c00">*</span></label>
        <input type="text" id="nama" name="nama" placeholder="Nama lengkap sesuai dokumen" required />
      </div>

      <!-- 2. Nama Orang Tua -->
      <div>
        <label>2. Nama Orang Tua <span style="color:#c00">*</span></label>
        <input type="text" id="namaOrtu" name="namaOrtu" placeholder="Nama ayah / ibu atau wali" required />
      </div>

      <!-- 3. Nomor KTP -->
      <div>
        <label>3. Nomor KTP Orang Tua</label>
        <input type="text" id="noKTP" name="noKTP" placeholder="Masukkan 16 digit NIK" pattern="\d{16}" title="Masukkan 16 digit angka NIK" />
        <div class="hint">Masukkan sesuai KTP (16 digit).</div>
      </div>

      <!-- 4. Upload File KTP -->
      <div>
        <label>4. Upload KTP (PDF/JPG/PNG) <span style="color:#c00">*</span></label>
        <input type="file" id="fileKTP" name="fileKTP" accept=".pdf,image/*" />
        <div id="ktpInfo" class="file-list"></div>
        <div class="hint">Ukuran maksimal 3 MB.</div>
      </div>

      <!-- 5. Kartu Keluarga -->
      <div>
        <label>5. Kartu Keluarga (KK) <span style="color:#c00">*</span></label>
        <input type="file" id="fileKK" name="fileKK" accept=".pdf,image/*" />
        <div id="kkInfo" class="file-list"></div>
        <div class="hint">Format disarankan: PDF atau gambar (jpg/png). Maks 5 MB.</div>
      </div>

      <!-- 6. Ijazah/Raport Terakhir -->
      <div>
        <label>6. Ijazah / Raport Terakhir <span style="color:#c00">*</span></label>
        <input type="file" id="fileIjazah" name="fileIjazah" accept=".pdf,image/*" />
        <div id="ijazahInfo" class="file-list"></div>
        <div class="hint">Format disarankan: PDF atau gambar (jpg/png). Maks 5 MB.</div>
      </div>

      <!-- 7. Foto Siswa -->
      <div>
        <label>7. Foto Siswa <span style="color:#c00">*</span></label>
        <input type="file" id="foto" name="foto" accept="image/*" />
        <div id="fotoPreview" class="preview"></div>
        <div class="hint">Foto formal (jpg/png). Maks 2 MB. Akan ditampilkan preview.</div>
      </div>

      <div style="display:flex;gap:8px;justify-content:flex-end;margin-top:8px;flex-wrap:wrap;">
        <button type="button" class="secondary" onclick="resetForm()">Reset</button>
        <button type="button" class="print" onclick="window.print()">🖨 Cetak Formulir</button>
        <button type="submit">💾 Kirim / Simpan</button>
      </div>

      <div id="message" style="margin-top:12px"></div>
    </form>
  </div>

  <script>
    // Elemen-elemen file
    const fileKTP = document.getElementById('fileKTP');
    const fileKK = document.getElementById('fileKK');
    const fileIjazah = document.getElementById('fileIjazah');
    const foto = document.getElementById('foto');
    const ktpInfo = document.getElementById('ktpInfo');
    const kkInfo = document.getElementById('kkInfo');
    const ijazahInfo = document.getElementById('ijazahInfo');
    const fotoPreview = document.getElementById('fotoPreview');
    const msgEl = document.getElementById('message');

    function clearPreviews(){
      ktpInfo.textContent = '';
      kkInfo.textContent = '';
      ijazahInfo.textContent = '';
      fotoPreview.innerHTML = '';
      msgEl.innerHTML = '';
    }

    function resetForm(){
      document.getElementById('regForm').reset();
      clearPreviews();
    }

    function showFileInfo(file, targetEl, maxMB){
      if(!file){ targetEl.textContent = ''; return; }
      const sizeMB = (file.size / (1024*1024)).toFixed(2);
      targetEl.textContent = file.name + ' ('+sizeMB+' MB)';
      if(file.size > maxMB*1024*1024){
        targetEl.innerHTML += ' — <strong style="color:#c00">Melebihi '+maxMB+' MB!</strong>';
      }
    }

    fileKTP.addEventListener('change', e=> showFileInfo(e.target.files[0], ktpInfo, 3));
    fileKK.addEventListener('change', e=> showFileInfo(e.target.files[0], kkInfo, 5));
    fileIjazah.addEventListener('change', e=> showFileInfo(e.target.files[0], ijazahInfo, 5));

    foto.addEventListener('change', e=>{
      const f = e.target.files[0];
      if(!f){ fotoPreview.innerHTML=''; return; }
      if(f.size > 2*1024*1024){
        fotoPreview.innerHTML = '<div class="error">Ukuran foto lebih dari 2 MB!</div>';
        return;
      }
      const reader = new FileReader();
      reader.onload = ev=>{
        fotoPreview.innerHTML = '<img class="preview-img" src="'+ev.target.result+'" alt="preview foto" />';
      }
      reader.readAsDataURL(f);
    });

    // Submit form
    document.getElementById('regForm').addEventListener('submit', e=>{
      e.preventDefault();
      msgEl.innerHTML = '';

      const nama = document.getElementById('nama').value.trim();
      const namaOrtu = document.getElementById('namaOrtu').value.trim();
      const noKTP = document.getElementById('noKTP').value.trim();
      const fKTP = fileKTP.files[0];
      const fKK = fileKK.files[0];
      const fIjazah = fileIjazah.files[0];
      const fFoto = foto.files[0];

      const errors = [];
      if(!nama) errors.push('Nama lengkap wajib diisi.');
      if(!namaOrtu) errors.push('Nama orang tua wajib diisi.');
      if(!fKTP) errors.push('File KTP wajib diunggah.');
      if(!fKK) errors.push('File KK wajib diunggah.');
      if(!fIjazah) errors.push('File ijazah wajib diunggah.');
      if(!fFoto) errors.push('Foto siswa wajib diunggah.');

      if(errors.length){
        msgEl.innerHTML = '<div class="error">'+errors.join('<br>')+'</div>';
        return;
      }

      // Simpan sebagai file JSON (simulasi kirim)
      const summary = {
        nama: nama,
        nama_orangtua: namaOrtu,
        nomor_ktp: noKTP,
        file_ktp: fKTP.name,
        file_kk: fKK.name,
        file_ijazah: fIjazah.name,
        file_foto: fFoto.name,
        waktu_submit: new Date().toLocaleString()
      };

      const blob = new Blob([JSON.stringify(summary, null, 2)], {type:'application/json'});
      const url = URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.href = url;
      a.download = 'data_pendaftaran.json';
      document.body.appendChild(a);
      a.click();
      a.remove();
      URL.revokeObjectURL(url);

      msgEl.innerHTML = '<div class="success">✅ Form berhasil disiapkan. Data ringkasan diunduh sebagai <code>data_pendaftaran.json</code>.</div>';
    });
  </script>
</body>
</html>