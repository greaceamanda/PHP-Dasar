<?php
// nilai-huruf.php
// Input: nilai (0–100) -> Output: huruf A–E

function inpost($k, $def = "") { return isset($_POST[$k]) ? htmlspecialchars(trim($_POST[$k])) : $def; }

$nilaiStr  = inpost("nilai");
$submitted = $_SERVER["REQUEST_METHOD"] === "POST";
$errors = [];
$grade = "";

if ($submitted) {
  if ($nilaiStr === "") {
    $errors[] = "Nilai wajib diisi.";
  } elseif (!is_numeric($nilaiStr)) {
    $errors[] = "Input harus berupa angka.";
  } else {
    $n = (float)$nilaiStr;

    if ($n < 0 || $n > 100) {
      $errors[] = "Nilai harus di antara 0 – 100.";
    } else {
      // Logika if-elseif-else untuk menentukan grade
      if ($n >= 85) {
        $grade = "A";
      } elseif ($n >= 70) {
        $grade = "B";
      } elseif ($n >= 55) {
        $grade = "C";
      } elseif ($n >= 40) {
        $grade = "D";
      } else {
        $grade = "E";
      }
    }
  }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Menentukan Nilai Huruf (PHP)</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body{font-family:Arial, sans-serif; margin:2rem;}
    .card{max-width:420px; border:1px solid #ddd; border-radius:12px; padding:16px;}
    .row{display:flex; gap:.75rem; align-items:center; margin:.75rem 0;}
    label{width:120px;}
    input{flex:1; padding:.6rem;}
    button{padding:.6rem 1rem; border-radius:8px; cursor:pointer;}
    .errors{background:#ffecec; border:1px solid #f5aca6; padding:.75rem; border-radius:8px; margin-top:12px;}
    .result{background:#ecfff1; border:1px solid #a6f5b5; padding:.75rem; border-radius:8px; margin-top:12px; font-weight:bold;}
    .hint{color:#666; font-size:.9rem;}
  </style>
</head>
<body>
  <h2>Cek Nilai Huruf</h2>
  <div class="card">
    <form method="post" action="">
      <div class="row">
        <label for="nilai">Masukkan Nilai</label>
        <input type="number" id="nilai" name="nilai" value="<?= $nilaiStr ?>" placeholder="0–100" min="0" max="100">
      </div>
      <button type="submit">Cek Grade</button>
      <p class="hint">Gunakan if-elseif-else untuk menentukan grade A–E.</p>
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
        Nilai: <?= $nilaiStr ?> → Grade: <?= $grade ?>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
