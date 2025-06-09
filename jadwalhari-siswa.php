<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Skejul - Jadwal Hari Ini</title>
  <link rel="stylesheet" href="assets/css/jadwalhari-siswa.css">
</head>
<body>

<?php
session_start();
include 'db.php';

if (!isset($host, $user, $pass, $db)) {
    die("Database connection variables are not set. Please check db.php.");
}

$conn = mysqli_connect($host, $user, $pass, $db);

if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ambil hari ini dalam format enum (Indonesia)
date_default_timezone_set('Asia/Makassar'); // atau Asia/Jakarta
$hariIndo = [
    'Sunday'    => 'Minggu',
    'Monday'    => 'Senin',
    'Tuesday'   => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday'  => 'Kamis',
    'Friday'    => 'Jumat',
    'Saturday'  => 'Sabtu'
];
$hariIni = $hariIndo[date('l')];

// Filter jadwal sesuai hari ini dan kelas siswa
$kelas_id = $_SESSION['kelas_id'];
$sql = "SELECT 
      jk.jam_mulai, 
      jk.jam_selesai, 
      mp.nama_mapel,
      r.nama_ruang,
      g.nama_guru
    FROM jadwal_kelas jk
    JOIN mata_pelajaran mp ON jk.mapel_id = mp.mapel_id
    JOIN ruangan r ON jk.ruang_id = r.ruang_id
    JOIN guru g ON jk.guru_id = g.guru_id
    WHERE jk.hari = '$hariIni' AND jk.kelas_id = '$kelas_id'
    ORDER BY jk.jam_mulai ASC";
$result = $conn->query($sql);
?>
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
              <a href="siswa-dashboard.php" class="beranda">
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
                <li><a  class="jadwal-hariini" href="#jadwalhari-siswa">Jadwal Hari Ini</a></li>
                <li><a class="jadwal-lengkap" href="jadwallengkap-siswa.php">Jadwal Lengkap</a></li>
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

        <a href="#" class="logout">
          <img src="assets/img/out-white.svg" alt="">
          <span class="text-keluar">Keluar</span>
        </a>
      </aside>

      <div class="right-side">
        <div class="container-top">
          <div class="arrow-top">
            <a href="siswa-dashboard.php">Dashboard</a>
            <img src="assets/img/arrow-hari.svg" alt="Arrow" width="16px">
            <a href="#">Jadwal Hari Ini</a>
          </div>
          <div class="profile-box">
            <img src="assets/img/profile-avatar.svg" alt="Foto Profil" class="profile-img">
            <div class="profile-text">
              <h1><?php echo $_SESSION['nama']; ?></h1>
              <p>Siswa Aktif</p>
            </div>
          </div>
        </div>

    <div class="jadwal-container">
      <h1>Jadwal Hari Ini</h1>
      <table>
        <thead>
          <tr>
            <th>JAM MULAI</th>
            <th>JAM SELESAI</th>
            <th>MATA PELAJARAN</th>
            <th>GURU PENGAJAR</th>
            <th>RUANG</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td>" . date('H:i', strtotime($row['jam_mulai'])) . "</td>
                      <td>" . date('H:i', strtotime($row['jam_selesai'])) . "</td>
                      <td>" . $row['nama_mapel'] . "</td>
                      <td>" . $row['nama_guru'] . "</td>
                      <td>" . $row['nama_ruang'] . "</td>
                    </tr>";
            }
          } else {
            echo "<tr><td colspan='5' style='text-align:center;'>Tidak ada data jadwal</td></tr>";
          }
          ?>
        </tbody>
      </table>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/js/jadwalhari-siswa.js"></script>
</body>
</html>