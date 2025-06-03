<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Skejul - Manajemen Jadwal Sekolah</title>
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $type_acc = $_POST['type_acc'] ?? '';
    $type_acc = strtolower($type_acc);

    $valid_roles = ['siswa', 'guru', 'admin'];
    if (!in_array($type_acc, $valid_roles)) {
        echo "<script>alert('Role tidak valid!'); window.location.href='login.php';</script>";
        exit();
    }

    // Ambil data user
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND peran = ? LIMIT 1");
    $stmt->bind_param("ss", $username, $type_acc);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $db_password = $user['password'];

        // Cek apakah password di DB sudah hash (biasanya ada prefix $2y$ buat password_hash)
        if (strpos($db_password, '$2y$') === 0) {
            // Sudah hash, verifikasi biasa
            if (password_verify($password, $db_password)) {
                // Login sukses, set session
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['nama'] = $user['nama_lengkap'];
                $_SESSION['role'] = $user['peran'];
                $_SESSION['kelas_id'] = $user['kelas_id'];
                $_SESSION['guru_id'] = $user['guru_id'];

                header("Location: index.php");
                exit();
            } else {
                echo "<script>alert('Password salah!'); window.location.href='login.php';</script>";
                exit();
            }
        } else {
            // Password masih plaintext, cek langsung
            if ($password === $db_password) {
                // Password cocok, sekarang hash dan update ke DB biar aman ke depannya
                $new_hash = password_hash($password, PASSWORD_DEFAULT);

                $update = $conn->prepare("UPDATE users SET password = ? WHERE user_id = ?");
                $update->bind_param("si", $new_hash, $user['user_id']);
                $update->execute();

                // Set session sama kaya biasa
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['nama'] = $user['nama_lengkap'];
                $_SESSION['role'] = $user['peran'];
                $_SESSION['kelas_id'] = $user['kelas_id'];
                $_SESSION['guru_id'] = $user['guru_id'];

                header("Location: index.php");
                exit();
            } else {
                echo "<script>alert('Password salah!'); window.location.href='login.php';</script>";
                exit();
            }
        }
    } else {
        echo "<script>alert('Username atau role tidak ditemukan!'); window.location.href='login.php';</script>";
        exit();
    }
}
?>

  <div class="container-login">
    <div class="login-left">
      <div class="logo-skejul">
        <img src="assets/img/Skejul.png" alt="">
      </div>
      <div class="container-login-left">
        <h2>Masuk</h2>
        <p class="text-welcome">Selamat datang! cek jadwalmu bareng SkeJul.</p>
        <div class="form-login">
          <form action="login.php" method="post">
            <div class="label-input-login">
              <label for="">Nama Pengguna</label>
              <input type="text" name="username" placeholder="Masukkan nama pengguna" autocomplete="off" required>
            </div>
            <div class="label-input-login">
              <label for="">Kata Sandi</label>
              <input type="password" name="password" placeholder="Masukkan kata sandi" required>
              <a href="#">Lupa kata sandi?</a>
            </div>
            <div class="label-input-login">
              <label for="">Pilih tipe akun</label>
                <div class="btn-type-acc">
                  <button type="button" class="type-btn" data-role="Siswa">Siswa</button>
                  <button type="button" class="type-btn" data-role="Guru">Guru</button>
                  <button type="button" class="type-btn" data-role="Admin">Admin</button>
                </div>
                <input type="hidden" name="type_acc" id="typeAcc" value="Siswa">
                <input type="submit" value="Masuk">
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="login-right">
      <div class="login-container-right">
        <h1>Selamat Datang!</h1>
        <h2>Masuk untuk cek jadwalmu <br> dengan mudah</h2>
        <img src="assets/img/Sidebar-dashboard.png" alt="" width="400">
        <p>Cara paling mudah buat cek <br> jadwal kamu setiap hari</p>
      </div>
    </div>
  </div>
  <script src="assets/js/login.js"></script>
</body>
</html>