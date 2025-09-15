<?php
// menu-makanan.php
// Input: pilihan menu makanan -> Output: harga sesuai switch-case

function inpost($k, $def = "") { return isset($_POST[$k]) ? htmlspecialchars(trim($_POST[$k])) : $def; }

$menu = inpost("menu");
$submitted = $_SERVER["REQUEST_METHOD"] === "POST";
$errors = [];
$harga = null;

if ($submitted) {
  if ($menu === "") {
    $errors[] = "Silakan pilih menu makanan.";
  } else {
    switch ($menu) {
      case "nasi_goreng":
        $harga = 20000;
        break;
      case "soto":
        $harga = 25000;
        break;
      case "mie_ayam":
        $harga = 18000;
        break;
      default:
        $errors[] = "Menu tidak dikenali.";
    }
  }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Menu Makanan (PHP Switch Case)</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body{font-family:Arial, sans-serif; margin:2rem;}
    .card{max-width:420px; border:1px solid #ddd; border-radius:12px; padding:16px;}
    .row{display:flex; gap:.75rem; align-items:center; margin:.75rem 0;}
    label{width:140px;}
    select{flex:1; padding:.6rem;}
    button{padding:.6rem 1rem; border-radius:8px; cursor:pointer;}
    .errors{background:#ffecec; border:1px solid #f5aca6; padding:.75rem; border-radius:8px; margin-top:12px;}
    .result{background:#ecfff1; border:1px solid #a6f5b5; padding:.75rem; border-radius:8px; margin-top:12px; font-weight:bold;}
    .hint{color:#666; font-size:.9rem;}
  </style>
</head>
<body>
  <h2>Pilih Menu Makanan</h2>
  <div class="card">
    <form method="post" action="">
      <div class="row">
        <label for="menu">Menu</label>
        <select id="menu" name="menu">
          <option value="">-- Pilih Menu --</option>
          <option value="nasi_goreng" <?= $menu==="nasi_goreng"?"selected":"" ?>>Nasi Goreng</option>
          <option value="soto" <?= $menu==="soto"?"selected":"" ?>>Soto</option>
          <option value="mie_ayam" <?= $menu==="mie_ayam"?"selected":"" ?>>Mie Ayam</option>
        </select>
      </div>
      <button type="submit">Lihat Harga</button>
      <p class="hint">Gunakan switch-case untuk menampilkan harga makanan.</p>
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
        Harga <?= ucfirst(str_replace("_"," ",$menu)) ?> adalah Rp <?= number_format($harga, 0, ",", ".") ?>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
