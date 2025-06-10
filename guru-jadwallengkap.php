<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Skejul - Jadwal Hari Ini</title>
  <link rel="stylesheet" href="assets/css/jadwallengkap-siswa.css">
</head>
<body>

<?php
session_start();
include 'db.php';

$conn = mysqli_connect($host, $user, $pass, $db);

<<<<<<< HEAD
if (isset($_GET['hari']) && isset($_SESSION['guru_id'])) {
    $hari = $_GET['hari'];
    $guru_id = $_SESSION['guru_id'];
    $result = $conn->query("
        SELECT 
          jk.jam_mulai, 
          jk.jam_selesai, 
          mp.nama_mapel AS mata_pelajaran,
          g.nama_guru AS guru_pengajar,
          r.nama_ruang AS ruang
        FROM jadwal_kelas jk
        JOIN mata_pelajaran mp ON jk.mapel_id = mp.mapel_id
        JOIN ruangan r ON jk.ruang_id = r.ruang_id
        JOIN guru g ON jk.guru_id = g.guru_id
        WHERE jk.hari = '$hari' AND jk.guru_id = '$guru_id'
    ");
    if (isset($_GET['hari']) && isset($_SESSION['guru_id'])) {
    // ...
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . date('H:i', strtotime($row['jam_mulai'])) . "</td>
                <td>" . date('H:i', strtotime($row['jam_selesai'])) . "</td>
                <td>" . $row['mata_pelajaran'] . "</td>
                <td>" . $row['ruang'] . "</td>
              </tr>";
    }
=======
// Cek apakah ini adalah permintaan AJAX dengan parameter `hari`
if (isset($_GET['hari'])) {
    $hari = $_GET['hari'];
    $guru_id = $_SESSION['guru_id'];

    $sql = "SELECT 
              jk.jam_mulai, 
              jk.jam_selesai, 
              mp.nama_mapel AS mata_pelajaran,
              k.nama_kelas AS kelas,
              r.nama_ruang AS ruang
            FROM jadwal_kelas jk
            JOIN mata_pelajaran mp ON jk.mapel_id = mp.mapel_id
            JOIN ruangan r ON jk.ruang_id = r.ruang_id
            JOIN kelas k ON jk.kelas_id = k.kelas_id
            WHERE jk.hari = ? AND jk.guru_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $hari, $guru_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . date('H:i', strtotime($row['jam_mulai'])) . "</td>
                    <td>" . date('H:i', strtotime($row['jam_selesai'])) . "</td>
                    <td>" . $row['mata_pelajaran'] . "</td>
                    <td>" . $row['kelas'] . "</td>
                    <td>" . $row['ruang'] . "</td>
                  </tr>";
        }
>>>>>>> c803a4135f3d0ec1d959f6003ce059a73d5f6419
    } else {
        echo "<tr><td colspan='5'>Tidak ada data jadwal</td></tr>";
    }
    exit; // Hentikan eksekusi untuk menghindari pengiriman HTML lainnya
}

// Jika bukan permintaan AJAX, tampilkan halaman HTML seperti biasa
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Skejul - Jadwal Lengkap</title>
  <link rel="stylesheet" href="assets/css/jadwallengkap-siswa.css">
</head>
<body>
<!-- Konten HTML lainnya -->
</body>
</html>
  <header class="topbar">
    <div class="topbar-left">
      <img src="assets/img/logo-smk.png" alt="Logo SMK" class="logo-smk" />
      <span class="school-name">SMK NEGERI 1 DENPASAR</span>
    </div>
    <img src="assets/img/logo-smk-bisa.png" alt="Logo SMK Bisa" class="logo-kanan" />
  </header>

  <div class="container-all">
    <div class="container">
      <aside class="sidebar">
        <div class="logo">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 22 20" fill="none">
            <rect width="22" height="3.83555" rx="1.91777" fill="white" />
            <rect y="7.6711" width="22" height="3.83555" rx="1.91777" fill="white" />
            <rect y="15.3422" width="10.3529" height="3.83555" rx="1.91777" fill="white" />
          </svg>
          <img src="assets/img/SkeJul.png" alt="Logo SkeJul" class="logo-skejul" />
        </div>

        <nav>
          <ul>
            <li>
              <a href="guru-dashboard.php" class="beranda">
                <img class="home-icon" src="assets/img/home-fill.svg" alt="Home Icon">
                <span class="text-beranda">Beranda</span>
              </a>
            </li>
            <li class="dropdown">
              <a href="#" class="jadwal">
                <img class="jadwal-icon" src="assets/img/jadwal-icon-blue.svg" alt="Jadwal Icon">
                <span class="text-jadwal">Jadwal</span>
                <img class="arrow-icon" src="assets/img/arrow-black.svg" alt="Arrow Icon">
              </a>
              <ul class="dropdown-list">
                <li><a  class="jadwal-hariini" href="guru-jadwalhari.php">Jadwal Hari Ini</a></li>
                <li><a class="jadwal-lengkap" href="guru-jadwallengkap.php">Jadwal Lengkap</a></li>
              </ul>
            </li>
          </ul>
        </nav>

        <div class="info-box">
          <img src="assets/img/ilustrasi-sitebar.png" alt="Ilustrasi Jadwal" class="ilustrasi-sitebar" />
          <p>
            Lihat dan kelola jadwal pelajaran <br />
            mudah dengan SkeJul
          </p>
        </div>

        <a href="login.php" class="logout">
          <img src="assets/img/out-white.svg" alt="">
          <span class="text-keluar">Keluar</span>
        </a>
      </aside>

      <div class="right-side">
        <div class="container-top">
          <div class="arrow-top">
            <a href="siswa-dashboard.php">Dashboard</a>
            <img src="assets/img/arrow-hari.svg" alt="Arrow" width="16px">
            <a href="guru-jadwallengkap.php">Jadwal Lengkap</a>
          </div>
          <div class="profile-box">
            <img src="assets/img/profile-avatar.svg" alt="Foto Profil" class="profile-img">
            <div class="profile-text">
              <h1><?php echo $_SESSION['nama']; ?></h1>
              <p>Guru Aktif</p>
            </div>
          </div>
        </div>

    <div class="jadwal-container">
      <div class="jadwal-lengkap-item">
        <h1 style="margin: 0;">Jadwal Lengkap</h1>
        <!-- Tempatkan di dalam jadwal-lengkap-item -->
          <div class="dropdown-hari-wrapper">
  <div class="dropdown-hari-selected" id="dropdownHariSelected">
    <img src="assets/img/kalender-white.svg" class="icon-hari" alt="Kalender">
    <span class="dropdown-hari-text">Hari</span>
    <img src="assets/img/arrow-white.svg" class="icon-arrow" alt="Arrow">
  </div>
  <ul class="dropdown-hari-list" id="dropdownHariList">
    <li data-value="Senin">Senin</li>
    <li data-value="Selasa">Selasa</li>
    <li data-value="Rabu">Rabu</li>
    <li data-value="Kamis">Kamis</li>
    <li data-value="Jumat">Jumat</li>
  </ul>
  <input type="hidden" name="jadwal-hari" id="jadwalHari">
</div>
      </div>
      <table id="jadwalTabel">
        <thead>
          <tr>
            <th>JAM MULAI</th>
            <th>JAM SELESAI</th>
            <th>MATA PELAJARAN</th>
            <th>KELAS</th>
            <th>RUANG</th>
          </tr>
        </thead>
<tbody>
  <!-- <?php
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
              <td>" . date('H:i', strtotime($row['jam_mulai'])) . "</td>
              <td>" . date('H:i', strtotime($row['jam_selesai'])) . "</td>
              <td>" . $row['nama_mapel'] . "</td>
              <td>" . $row['nama_kelas'] . "</td> <!-- Kelas -->
              <td>" . $row['nama_ruang'] . "</td>
            </tr>";
    }
  } else {
    echo "<tr><td colspan='5'>Tidak ada data jadwal</td></tr>";
  }
  ?> -->
</tbody>
      </table>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/js/guru-jadwallengkap.js"></script>
</body>
</html>
