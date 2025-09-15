<?php
// index.php
// Praktik: Form Ucapan
// Fitur: input nama -> tampilkan "Halo, [Nama] selamat belajar PHP!"

function input($key, $default = "") {
  return isset($_POST[$key]) ? htmlspecialchars(trim($_POST[$key])) : $default;
}

$nama = input("nama");
$submitted = $_SERVER["REQUEST_METHOD"] === "POST";
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Form Ucapan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body { font-family: Arial, sans-serif; margin: 2rem; }
    .card { max-width: 420px; padding: 1rem 1.25rem; border: 1px solid #ddd; border-radius: 10px; }
    .row { display: flex; gap: .75rem; align-items: center; margin: .75rem 0; }
    label { width: 70px; }
    input[type="text"] { flex: 1; padding: .6rem; }
    button { padding: .6rem 1rem; cursor: pointer; border-radius: 8px; }
    .result { margin-top: 1rem; background: #ecfff1; border:1px solid #a6f5b5; padding:.8rem; border-radius:8px; }
    .hint { color:#666; font-size:.9rem; }
  </style>
</head>
<body>
  <h2>Form Ucapan</h2>
  <div class="card">
    <form method="post" action="">
      <div class="row">
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" placeholder="Masukkan nama..." value="<?= $nama ?>">
      </div>
      <button type="submit">Kirim</button>
      <p class="hint">Setelah dikirim, ucapan akan muncul di bawah.</p>
    </form>

    <?php if ($submitted): ?>
      <div class="result">
        <?php if ($nama !== ""): ?>
          <strong>Halo, <?= $nama ?> selamat belajar PHP!</strong>
        <?php else: ?>
          <strong>Halo, selamat belajar PHP!</strong> (Tip: harap input nama terlebih dahulu)
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
