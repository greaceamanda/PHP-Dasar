<?php
// kalkulator.php

function inpost($k, $def = "") { return isset($_POST[$k]) ? htmlspecialchars(trim($_POST[$k])) : $def; }

$a = inpost("a");
$b = inpost("b");
$op = inpost("op", "tambah");
$submitted = $_SERVER["REQUEST_METHOD"] === "POST";

$errors = [];
$hasil = null;

function pretty_number(float $v, int $maxDecimals = 6): string {
  if (is_infinite($v) || is_nan($v)) return "NaN";
  // kalau bulat, tampilkan tanpa desimal
  if (fmod($v, 1.0) == 0.0) return number_format($v, 0, ".", ",");
  // format dengan batas desimal, lalu trim nol dan titik akhir
  $s = number_format($v, $maxDecimals, ".", ",");
  $s = rtrim($s, "0");   // buang nol di belakang
  $s = rtrim($s, ".");   // kalau ujungnya titik, buang juga
  return $s;
}

if ($submitted) {
  // validasi
  if ($a === "" || $b === "") {
    $errors[] = "Kedua angka wajib diisi.";
  } elseif (!is_numeric($a) || !is_numeric($b)) {
    $errors[] = "Input harus berupa angka (boleh desimal).";
  }

  if (empty($errors)) {
    $x = (float)$a;
    $y = (float)$b;

    switch ($op) {
      case "tambah": $hasil = $x + $y; break;
      case "kurang": $hasil = $x - $y; break;
      case "kali"  : $hasil = $x * $y; break;
      case "bagi"  :
        if ($y == 0.0) {
          $errors[] = "Tidak bisa membagi dengan nol.";
        } else {
          $hasil = $x / $y;
        }
        break;
      default: $errors[] = "Operator tidak dikenal.";
    }
  }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Kalkulator Sederhana (PHP)</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body{font-family:Arial, sans-serif; margin:2rem;}
    .card{max-width:480px; border:1px solid #ddd; border-radius:12px; padding:16px;}
    .row{display:flex; gap:.75rem; align-items:center; margin:.75rem 0;}
    label{width:120px;}
    input, select{flex:1; padding:.6rem;}
    button{padding:.6rem 1rem; border-radius:8px; cursor:pointer;}
    .errors{background:#ffecec; border:1px solid #f5aca6; padding:.75rem; border-radius:8px; margin-top:12px;}
    .result{background:#ecfff1; border:1px solid #a6f5b5; padding:.75rem; border-radius:8px; margin-top:12px; font-weight:bold;}
    .hint{color:#666; font-size:.9rem;}
  </style>
</head>
<body>
  <h2>Aplikasi Kalkulator Sederhana</h2>
  <div class="card">
    <form method="post" action="">
      <div class="row">
        <label for="a">Angka 1</label>
        <input type="number" step="any" id="a" name="a" value="<?= $a ?>" placeholder="mis. 12.5">
      </div>
      <div class="row">
        <label for="b">Angka 2</label>
        <input type="number" step="any" id="b" name="b" value="<?= $b ?>" placeholder="mis. 3">
      </div>
      <div class="row">
        <label for="op">Operator</label>
        <select id="op" name="op">
          <option value="tambah" <?= $op==="tambah"?"selected":"" ?>>Tambah (+)</option>
          <option value="kurang" <?= $op==="kurang"?"selected":"" ?>>Kurang (−)</option>
          <option value="kali"   <?= $op==="kali"?"selected":"" ?>>Kali (×)</option>
          <option value="bagi"   <?= $op==="bagi"?"selected":"" ?>>Bagi (÷)</option>
        </select>
      </div>
      <button type="submit">Hitung</button>
      <p class="hint">Alur: input (form) → proses (PHP switch-case) → output (hasil di bawah).</p>
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
      <div class="result">
        Hasil: <?= pretty_number($hasil) ?>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
