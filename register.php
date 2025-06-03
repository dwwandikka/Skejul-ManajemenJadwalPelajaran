<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skejul - Manajemen Jadwal Pelajaran</title>
</head>
<body>
    <div class="container">
        <div class="regis-left">
            <h2>Selamat datang, Admin!</h2>
            <p>Membuat akun SkeJul untuk pegguna dengan mudah</p>
            <span class="note">Cara paling mudah buat cek jadwal kamu setiap hari</span>
        </div>

        <div class="regis-right">
            <h2>Buat akun</h2>
            <p class="sub">Selamat datang! Silahkan masukkan detail pengguna</p>
            <form action="" method="POST">
                <input type="text" name="Nama lengkap"placehorder="Masukan nama lengkap" required>
                <input type="text" name="Nama pengguna"placehorder="Masukan nama pengguna" required>
                <select name="kategori" required>
                    <option value="">Kategori</option>
                    <option value="guru">Guru</option>
                    <option value="siswa">Siswa</option>
                    <option value="admin">Admin</option>
                </select>
                <input type="password" name="Kata sandi" placehorder="Masukkan kata sandi" required>
                <input type="password" name="Konfirmasi sandi" placehorder="Konfirmasi sandi" required>
                <button type="submit" name="submit">Buat Akun</button>
            </form>

            
        </div>
    </div>
</body>
</html>