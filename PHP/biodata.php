<?php
// biodata.php

function inpost($k, $def = "") {
  return isset($_POST[$k]) ? htmlspecialchars(trim($_POST[$k])) : $def;
}

$nama   = inpost("nama");
$umur   = inpost("umur");
$jk     = inpost("jk");          // "Laki-laki" atau "Perempuan"
$alamat = inpost("alamat");

$submitted = $_SERVER["REQUEST_METHOD"] === "POST";
$errors = [];
$outputKalimat = "";

if ($submitted) {
  // Validasi sederhana
  if ($nama === "")   $errors[] = "Nama wajib diisi.";
  if ($umur === "")   $errors[] = "Umur wajib diisi.";
  elseif (!ctype_digit($umur) || (int)$umur < 0 || (int)$umur > 150) $errors[] = "Umur harus bilangan bulat 0–150.";
  if ($jk === "")     $errors[] = "Jenis kelamin wajib dipilih.";
  if ($alamat === "") $errors[] = "Alamat wajib diisi.";

  if (empty($errors)) {
    // Susun kalimat biodata
    $outputKalimat = "Halo, nama saya $nama. Umur saya $umur tahun. Saya seorang $jk. "
                   . "Saya tinggal di $alamat.";
  }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Form Biodata Singkat (PHP)</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body{font-family:Arial, sans-serif; margin:2rem;}
    .card{max-width:560px; border:1px solid #ddd; border-radius:12px; padding:16px;}
    .row{display:flex; gap:.75rem; align-items:center; margin:.75rem 0;}
    label{width:150px;}
    input[type="text"], input[type="number"], textarea, select {flex:1; padding:.6rem;}
    textarea{min-height:80px; resize:vertical;}
    .radio-group{flex:1; display:flex; gap:1rem; align-items:center;}
    button{padding:.6rem 1rem; border-radius:8px; cursor:pointer;}
    .errors{background:#ffecec; border:1px solid #f5aca6; padding:.75rem; border-radius:8px; margin-top:12px;}
    .result{background:#ecfff1; border:1px solid #a6f5b5; padding:.9rem; border-radius:8px; margin-top:12px; font-weight:bold; white-space:pre-wrap;}
    .hint{color:#666; font-size:.9rem;}
  </style>
</head>
<body>
  <h2>Form Biodata Singkat</h2>
  <div class="card">
    <form method="post" action="">
      <div class="row">
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" placeholder="mis. Putu" value="<?= $nama ?>">
      </div>

      <div class="row">
        <label for="umur">Umur</label>
        <input type="number" id="umur" name="umur" min="0" max="150" step="1" placeholder="mis. 20" value="<?= $umur ?>">
      </div>

      <div class="row">
        <label>Jenis Kelamin</label>
        <div class="radio-group">
          <label><input type="radio" name="jk" value="Laki-laki" <?= $jk==="Laki-laki"?"checked":""; ?>> Laki-laki</label>
          <label><input type="radio" name="jk" value="Perempuan" <?= $jk==="Perempuan"?"checked":""; ?>> Perempuan</label>
        </div>
      </div>

      <div class="row">
        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat" placeholder="mis. Jalan Gajah Mada No 1, Denpasar, Bali"><?= $alamat ?></textarea>
      </div>

      <button type="submit">Kirim</button>
      <p class="hint">Setelah dikirim, biodata akan ditampilkan dalam format kalimat.</p>
    </form>

    <?php if (!empty($errors)): ?>
      <div class="errors">
        <strong>Periksa input:</strong>
        <ul>
          <?php foreach ($errors as $e): ?>
            <li><?= $e ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <?php if ($submitted && empty($errors)): ?>
      <div class="result"><?= $outputKalimat ?></div>
    <?php endif; ?>
  </div>
</body>
</html>
