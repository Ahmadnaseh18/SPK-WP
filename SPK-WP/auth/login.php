<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login | SPK WP</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body class="login-body">

<div class="login-card">
  <h2>SPK Seleksi Karyawan</h2>
  <p class="subtitle">Metode Weighted Product</p>

  <form method="post" action="cek_login.php">
    <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" placeholder="Masukkan username" required>
    </div>

    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" placeholder="Masukkan password" required>
    </div>

    <button type="submit" class="btn-login">Login</button>
  </form>

  <p class="footer-text">© <?= date('Y') ?> Sistem Pendukung Keputusan</p>
</div>

</body>
</html>
