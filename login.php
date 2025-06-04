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

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND peran = ? LIMIT 1");
    $stmt->bind_param("ss", $username, $type_acc);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $db_password = $user['password'];

        if (strpos($db_password, '$2y$') === 0) {
            // Password sudah hash
            if (password_verify($password, $db_password)) {
                loginUser($user);
            } else {
                echo "<script>alert('Password salah!'); window.location.href='login.php';</script>";
                exit();
            }
        } else {
            // Password masih plaintext
            if ($password === $db_password) {
                // Hash sekarang
                $new_hash = password_hash($password, PASSWORD_DEFAULT);
                $update = $conn->prepare("UPDATE users SET password = ? WHERE user_id = ?");
                $update->bind_param("si", $new_hash, $user['user_id']);
                $update->execute();

                loginUser($user);
            } else {
                echo "<script>alert('Password salah!'); window.location.href='login.php';</script>";
                exit();
            }
        }
    } else {
        echo "<script>alert('Username atau peran tidak ditemukan!'); window.location.href='login.php';</script>";
        exit();
    }
}

// fungsi bantu buat set session dan redirect
function loginUser($user) {
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['nama'] = $user['nama_lengkap'];
    $_SESSION['role'] = $user['peran'];
    $_SESSION['kelas_id'] = $user['kelas_id'];
    $_SESSION['guru_id'] = $user['guru_id'];

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
        <img src="assets/img/.png" alt="" width="400">
        <p>Cara paling mudah buat cek <br> jadwal kamu setiap hari</p>
      </div>
    </div>
  </div>
  <script src="assets/js/login.js"></script>
</body>
</html>