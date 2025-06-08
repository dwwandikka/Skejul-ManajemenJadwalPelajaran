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
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $type_acc = strtolower($_POST['type_acc'] ?? '');

    if (empty($username) || empty($password) || empty($type_acc)) {
        echo "<script>alert('Semua field wajib diisi!'); window.location.href='login.php';</script>";
        exit();
    }

    // Memastikan tipe akun valid
    $valid_roles = ['siswa', 'guru', 'admin'];
    if (!in_array($type_acc, $valid_roles)) {
        echo "<script>alert('Tipe akun tidak valid!'); window.location.href='login.php';</script>";
        exit();
    }

    // Mencari user berdasarkan username dan tipe akun
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND peran = ? LIMIT 1");
    $stmt->bind_param("ss", $username, $type_acc);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $db_password = $user['password'];

        // Pastikan password tidak null
        if ($db_password === null) {
            echo "<script>alert('Password tidak tersedia!'); window.location.href='login.php';</script>";
            exit();
        }

        // Cek apakah password yang dimasukkan cocok dengan password di database
        if ($db_password === $password) { // Perbandingan langsung plaintext
            loginUser($user);
        } else {
            echo "<script>alert('Password salah!'); window.location.href='login.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Akun tidak ditemukan!'); window.location.href='login.php';</script>";
        exit();
    }
}

// Fungsi loginUser dipindahkan ke luar blok if-else
function loginUser($user) {
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['nama'] = $user['nama_lengkap'];
    $_SESSION['role'] = $user['peran'];
    $_SESSION['kelas_id'] = isset($user['kelas_id']) ? $user['kelas_id'] : null;
    $_SESSION['guru_id'] = isset($user['guru_id']) ? $user['guru_id'] : null;

    // Redirect berdasarkan role
    switch ($user['peran']) {
        case 'siswa':
            header("Location: siswa-dashboard.php");
            break;
        case 'guru':
            header("Location: guru-dashboard.php");
            break;
        case 'admin':
            header("Location: admin-dashboard.php");
            break;
        default:
            header("Location: index.php");
            break;
    }
    exit();
}
?>







  <div class="container-login">
    <div class="login-left">
      <div class="logo-skejul">
        <img src="assets/img/Skejul-color.png" alt="">
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
              <div class="password-input">
                <input type="password" name="password" placeholder="Masukkan kata sandi" required>
                <span class="password-check"><img src="assets/img/Eye-close.svg" alt=""></span>
              </div>
            </div>
            <div class="label-input-login">
              <label for="">Pilih tipe akun</label>
                <div class="btn-type-acc">
                  <button type="button" class="type-btn" data-role="Siswa">Siswa</button>
                  <button type="button" class="type-btn" data-role="Guru">Guru</button>
                  <button type="button" class="type-btn" data-role="Admin">Admin</button>
                </div>
                <input type="hidden" name="type_acc" id="typeAcc" value="siswa">
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
        <img src="assets/img/Sidebar-dashboard1.png" alt="" width="400">
        <p>Cara paling mudah buat cek <br> jadwal kamu setiap hari</p>
      </div>
    </div>
  </div>
  <script src="assets/js/login.js"></script>
</body>
</html>