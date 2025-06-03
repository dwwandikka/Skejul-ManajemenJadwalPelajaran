<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Skejul - Manajemen Jadwal Sekolah</title>
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
  <div class="container-login">
    <div class="login-left">
      <div class="container-login-left">
        <h2>Masuk</h2>
        <p class="text-welcome">Selamat datang! cek jadwalmu bareng SkeJul.</p>
        <div class="form-login">
          <form action="" method="post">
            <div class="label-input-login">
              <label for="">Nama Pengguna</label>
              <input type="text" name="" placeholder="Masukkan nama pengguna">
            </div>
            <div class="label-input-login">
              <label for="">Kata Sandi</label>
              <input type="password" name="" placeholder="Masukkan kata sandi">
              <a href="#">Lupa kata sandi?</a>
            </div>
            <div class="label-input-login">
              <label for="">Pilih tipe akun</label>
                <div class="btn-type-acc">
                  <button type="button" class="type-btn active">Siswa</button>
                  <button type="button" class="type-btn">Guru</button>
                  <button type="button" class="type-btn">Admin</button>
                </div>
                <input type="hidden" name="type_acc" id="typeAcc" value="Siswa">
                <input type="submit" value="Masuk">
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="login-right">
      <div class="container-right">
        <h1>Selamat Datang!</h1>
        <h2>Masuk untuk cek jadwalmu dengan mudah</h2>
        <img src="assets/img/Sidebar-dashboard.png" alt="" width="300">
        <p>Cara paling mudah buat cek jadwal kamu setiap hari</p>
      </div>
    </div>
  </div>
</body>
</html>