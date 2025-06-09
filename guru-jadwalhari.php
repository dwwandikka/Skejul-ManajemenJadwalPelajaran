<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Skejul - Jadwal Hari Ini</title>
  <link rel="stylesheet" href="assets/css/guru-jadwalhari.css">
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

$items_per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_index = ($page - 1) * $items_per_page;

$sql = "SELECT 
      jk.jadwal_id, 
      jk.kelas_id, 
      mp.nama_mapel,
      r.nama_ruang,
      g.nama_guru,
      jk.guru_id, 
      jk.hari, 
      jk.jam_mulai, 
      jk.jam_selesai, 
      jk.ruang_id, 
      jk.guru_id
    FROM jadwal_kelas jk
    JOIN mata_pelajaran mp ON jk.mapel_id = mp.mapel_id
    JOIN ruangan r ON jk.ruang_id = r.ruang_id
    JOIN guru g ON jk.guru_id = g.guru_id
    LIMIT $start_index, $items_per_page";
$result = $conn->query($sql);
if (!$result) {
  die("Query failed: " . $conn->error);
}

$total_sql = "SELECT COUNT(*) FROM jadwal_kelas";
$total_result = $conn->query($total_sql);
$total_row = $total_result ? $total_result->fetch_row()[0] : 0;

$total_pages = ceil($total_row / $items_per_page);
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
                <li><a href="guru-jadwalhari.php">Jadwal Hari Ini</a></li>
                <li><a href="guru-jadwallengkap.php">Jadwal Lengkap</a></li>
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
            <a href="guru-jadwalhari">Jadwal Hari Ini</a>
          </div>
          <div class="profile-box">
            <img src="assets/img/profile-avatar.svg" alt="Foto Profil" class="profile-img">
            <div class="profile-text">
              <h1>Kadek Unggah Adi Nope</h1>
              <p>Guru Aktif</p>
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
            <th>RUANG</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td>" . date('H:i', strtotime($row['jam_mulai'])) . "</td>
                      <td>" . date('H:i', strtotime($row['jam_selesai'])) . "</td>
                      <td>" . $row['nama_mapel'] . "</td>
                      <td>" . $row['nama_ruang'] . "</td>
                    </tr>";
            }
          } else {
            echo "<tr><td colspan='4'>Tidak ada data jadwal</td></tr>";
          }
          ?>
        </tbody>
      </table>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/js/guru-jadwalhari.js"></script>
</body>
</html>
