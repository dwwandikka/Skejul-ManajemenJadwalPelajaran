<?php
// Include file database connection
include 'db.php'; //Mengambil file koneksi database

$message = ''; //Variabel untuk pesan sukses
$error = ''; //Variabel untuk pesan error

// Proses form jika ada data yang dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
  /* Mengecek apakah user sudah submit form (klik tombol "Buat Akun")
     Jika belum submit, PHP akan langsung ke bagian HTML
     Jika sudah submit, akan jalankan kode di dalam if ini */ 
    // Ambil data dari form
    $nama_lengkap = trim($_POST['nama_lengkap'] ?? ''); //$_POST['nama_field'] Mengambil data dari input form
    $username = trim($_POST['username'] ?? ''); //trim() Menghilangkan spasi di awal dan akhir text
    $password = $_POST['password'] ?? ''; // ?? '' → Jika data kosong, beri nilai default string kosong
    $konfirm_password = $_POST['konfirm_password'] ?? ''; 
    $peran = $_POST['kategori'] ?? '';
    $kelas_id = $_POST['kelas_id'] ?? null; // ?? null → Jika data kosong, beri nilai null
    
    // Validasi input
    $errors = []; // Array kosong untuk menampung pesan error
    
    if (empty($nama_lengkap)) { //empty() → Mengecek apakah variabel kosong
        $errors[] = "Nama lengkap harus diisi"; //$errors[] → Menambah pesan error ke array
    }
    
    if (empty($username)) {
        $errors[] = "Username harus diisi";
    } elseif (strlen($username) < 3) { // strlen() → Menghitung panjang karakter
        $errors[] = "Username minimal 3 karakter";
    }
    
    if (empty($password)) {
        $errors[] = "Password harus diisi";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password minimal 6 karakter";
    }
    
    if (empty($konfirm_password)) {
        $errors[] = "Konfirmasi password harus diisi";
    } elseif ($password !== $konfirm_password) { //!== embandingkan apakah password dan konfirm password sama
        $errors[] = "Password dan konfirmasi password tidak sama";
    }
    
    if (empty($peran)) {
        $errors[] = "Kategori/peran harus dipilih";
    }
    
    // Validasi kelas_id jika peran adalah siswa
    if ($peran == 'siswa' && empty($kelas_id)) { //$peran == 'siswa' Mengecek apakah variabel $peran bernilai 'siswa'
            //&& (AND) Kedua kondisi harus TRUE agar blok kode dijalankan, Jika salah satu FALSE, maka blok diabaikan
        $errors[] = "Kelas harus dipilih untuk siswa";
    }
    
    // Cek apakah username sudah ada
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = ?"); 
        /* prepare() → Prepared statement untuk keamanan (mencegah SQL injection / Serangan dimana hacker memasukkan kode SQL berbahaya) 
        COUNT(*) → Menghitung berapa banyak user yang punya username yang sama*/
        $stmt->bind_param("s", $username); //masukkan variabel $username sebagai string ke posisi ? pertama
        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->fetch_row()[0];
        
        if ($count > 0) {
            $errors[] = "Username sudah digunakan, pilih username lain";
        }
        /*Jika COUNT(*) = 0 → Username belum ada (boleh dipakai)
          Jika COUNT(*) > 0 → Username sudah ada (tidak boleh dipakai) */
        
        $stmt->close();
    }
    
    // Jika tidak ada error, simpan data
    if (empty($errors)) {
        // PERBAIKAN: Set kelas_id berdasarkan peran
        if ($peran != 'siswa') {
            // Untuk guru dan admin, set kelas_id menjadi NULL
            $kelas_id = null;
        } else {
            // Pastikan kelas_id adalah integer jika siswa
            $kelas_id = !empty($kelas_id) ? (int)$kelas_id : null;
        } // Jika bukan siswa, kelas_id dibuat NULL (atau kelas yang sudah ada)
        
        // Insert data ke database
        if ($peran == 'siswa') {
            // Untuk siswa, sertakan kelas_id
            $stmt = $conn->prepare("INSERT INTO users (username, nama_lengkap, password, konfirm_password, peran, kelas_id) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssi", $username, $nama_lengkap, $password, $password, $peran, $kelas_id);
            //bind_param("sssssi") → s=string, i=integer
        } else {
            // Untuk guru dan admin, kelas_id = NULL
            $stmt = $conn->prepare("INSERT INTO users (username, nama_lengkap, password, konfirm_password, peran, kelas_id) VALUES (?, ?, ?, ?, ?, NULL)");
            $stmt->bind_param("sssss", $username, $nama_lengkap, $password, $password, $peran);
        }
        
        if ($stmt->execute()) {
            $message = "Buat akun berhasil! Akun telah dibuat.";
            $nama_lengkap = $username = $password = $konfirm_password = $peran = $kelas_id = ''; //Jika berhasil → Set pesan sukses & reset form
        } else {
            $errors[] = "Error saat menyimpan data: " . $conn->error;
        } //Jika gagal → Tambah pesan error
        
        $stmt->close();
    }
    
    // Gabungkan semua error
    if (!empty($errors)) {
        $error = implode('<br>', $errors);
    }
}

// Ambil data kelas untuk dropdown
$kelas_options = [];
$result = $conn->query("SELECT kelas_id, nama_kelas FROM kelas ORDER BY nama_kelas");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $kelas_options[] = $row;
    }
}
?>

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
        <img src="assets/img/Sidebar-dashboard(1).svg" alt="" width="400">
        <p>Cara paling mudah buat cek <br> jadwal kamu setiap hari</p>
      </div>
    </div> 

    <div class="regis-right">
      <div class="logo-skejul">
        <img src="assets/img/SkeJul-color.png" alt="">
      </div>
      <div class="container-regis-right">
        <h2>Buat Akun</h2>
        <p class="text-welcome">Selamat datang! Silahkan masukkan detail pengguna.</p>
        
        <!-- Tampilkan pesan sukses -->
        <?php if (!empty($message)): ?>
          <div class="message success"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <!-- Tampilkan pesan error -->
        <?php if (!empty($error)): ?>
          <div class="message error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <div class="form-regis">
          <form action="" method="post">
            <div class="label-input-regis">
              <label for="nama_lengkap">Nama Lengkap</label>
              <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Masukkan nama lengkap" value="<?php echo isset($nama_lengkap) ? htmlspecialchars($nama_lengkap) : ''; ?>" required>
            </div>
            
            <div class="label-input-kategori-regis">
              <label for="username">Nama Pengguna</label>
              <div class="input-kategori-regis">
                <input type="text" name="username" id="username" placeholder="Masukkan nama pengguna" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" required>
                <select name="kategori" id="kategori" class="dropdown" onchange="toggleKelasDropdown()" required>
                  <option value="" disabled <?php echo (empty($peran)) ? 'selected' : ''; ?>>Kategori</option>
                  <option value="siswa" <?php echo (isset($peran) && $peran == 'siswa') ? 'selected' : ''; ?>>Siswa</option>
                  <option value="guru" <?php echo (isset($peran) && $peran == 'guru') ? 'selected' : ''; ?>>Guru</option>
                  <option value="admin" <?php echo (isset($peran) && $peran == 'admin') ? 'selected' : ''; ?>>Admin</option>
                </select>
              </div>
            </div>
            
            <!-- Dropdown Kelas (hanya muncul jika peran = siswa) -->
            <div class="label-input-regis" id="kelas-dropdown" style="display: none;">
              <label for="kelas_id">Kelas</label>
              <select name="kelas_id" id="kelas_id" class="dropdown">
                <option value="" disabled selected>Pilih Kelas</option>
                <?php foreach ($kelas_options as $kelas): ?>
                  <option value="<?php echo $kelas['kelas_id']; ?>" 
                          <?php echo (isset($kelas_id) && $kelas_id == $kelas['kelas_id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($kelas['nama_kelas']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            
            <div class="label-input-regis">
              <label for="password">Kata Sandi</label>
              <input type="password" name="password" id="password" placeholder="Masukkan kata sandi" required>
              <span class="password-check">
                <img src="assets/img/Eye-close.svg" alt="Show password">
              </span>
            </div>

            <div class="label-input-regis">
              <label for="konfirm_password">Konfirm Sandi</label>
              <input type="password" name="konfirm_password" id="konfirm_password" placeholder="Konfirm sandi" required>
              <span class="password-check">
                <img src="assets/img/Eye-close.svg" alt="Show password">
              </span>
            </div>
            
            <input type="submit" value="Buat Akun">
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/js/regis.js"></script>
</body>
</html>