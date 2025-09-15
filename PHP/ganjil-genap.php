<?php
// ganjil-genap.php
// Fitur: input 1 angka -> tampilkan apakah Ganjil atau Genap (modulus %)

function inpost($k, $def = "") { return isset($_POST[$k]) ? htmlspecialchars(trim($_POST[$k])) : $def; }

$angkaStr  = inpost("angka");
$submitted = $_SERVER["REQUEST_METHOD"] === "POST";
$errors = [];
$keterangan = "";

if ($submitted) {
  // Validasi dasar
  if ($angkaStr === "") {
    $errors[] = "Angka wajib diisi.";
  } elseif (!is_numeric($angkaStr)) {
    $errors[] = "Input harus berupa angka.";
  } else {
    // Pastikan bilangan bulat (paritas didefinisikan untuk integer)
    if (fmod((float)$angkaStr, 1.0) != 0.0) {
      $errors[] = "Masukkan bilangan bulat (tanpa desimal).";
    } else {
      // Aman: konversi ke integer
      $n = (int)$angkaStr;

      // Gunakan operator modulus %
      if ($n % 2 === 0) {
        $keterangan = "$n adalah Bilangan GENAP";
      } else {
        $keterangan = "$n adalah Bilangan GANJIL";
      }
    }
  }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Cek Ganjil / Genap (PHP)</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body{font-family:Arial, sans-serif; margin:2rem;}
    .card{max-width:420px; border:1px solid #ddd; border-radius:12px; padding:16px;}
    .row{display:flex; gap:.75rem; align-items:center; margin:.75rem 0;}
    label{width:140px;}
    input{flex:1; padding:.6rem;}
    button{padding:.6rem 1rem; border-radius:8px; cursor:pointer;}
    .errors{background:#ffecec; border:1px solid #f5aca6; padding:.75rem; border-radius:8px; margin-top:12px;}
    .result{background:#ecfff1; border:1px solid #a6f5b5; padding:.75rem; border-radius:8px; margin-top:12px; font-weight:bold;}
    .hint{color:#666; font-size:.9rem;}
  </style>
</head>
<body>
  <h2>Cek Bilangan Ganjil / Genap</h2>
  <div class="card">
    <form method="post" action="">
      <div class="row">
        <label for="angka">Masukkan Angka</label>
        <input type="number" id="angka" name="angka" step="1" value="<?= $angkaStr ?>" placeholder="mis. 27">
      </div>
      <button type="submit">Cek</button>
      <p class="hint">Hint: menggunakan operator modulus (%) untuk cek sisa bagi 2.</p>
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
      <div class="result"><?= $keterangan ?></div>
    <?php endif; ?>
  </div>
</body>
</html>
