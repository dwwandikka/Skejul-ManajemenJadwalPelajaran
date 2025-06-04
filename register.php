<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Skejul - Manajemen Jadwal Sekolah</title>
  <link rel="stylesheet" href="assets/css/regis.css">
</head>
<body>

  <div class="container-regis">
    <div class="regis-left">
      <div class="regis-container-left">
        <h1>Selamat Datang, Admin!</h1>
        <h2>Membuat akun SkeJul untuk <br> pengguna dengan mudah</h2>
        <img src="assets/img/Sidebar-dashboard.png" alt="" width="400">
        <p>Cara paling mudah buat cek <br> jadwal kamu setiap hari</p>
      </div>
    </div> 

    <div class="regis-right">
      <div class="logo-skejul">
        <img src="assets/img/Skejul.png" alt="">
      </div>
      <div class="container-regis-right">
        <h2>Buat Akun</h2>
        <p class="text-welcome">Selamat datang! Silahkan masukkan detail pengguna.</p>
        <div class="form-regis">
          <form action="" method="post">
            <div class="label-input-regis">
              <label for="">Nama Lengkap</label>
              <input type="text" name="" placeholder="Masukkan nama lengkap">
            </div>
            <div class="label-input-kategori-regis">
              <label for="" >Nama Pengguna</label>
              <div class="input-kategori-regis">
                <input type="text" name="" placeholder="Masukkan nama pengguna">
                  <select id="kategori" class="dropdown" required>
                    <option value="" disabled selected>Kategori</option>
                    <option value="murid">Murid</option>
                    <option value="guru">Guru</option>
                    <option value="admin">Admin</option>
                  </select>
              </div>
            </div>
            <div class="label-input-regis">
              <label for="">Kata Sandi</label>
              <input type="password" name="" placeholder="Masukkan kata sandi">
            </div>
            <div class="label-input-regis">
              <label for="">Konfirm Sandi</label>
              <input type="password" name="" placeholder="Konfirm sandi">
            </div>
            <input type="submit" value="Buat Akun">
          </form>
        </div>
      </div>
    </div>
  </div>  
</body>
</html>