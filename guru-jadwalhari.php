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
session_start(); // Start the session

include 'db.php';
// Ambil daftar nama kelas dari tabel kelas
$kelas_nama = [];
$kelas_query = $conn->query("SELECT kelas_id, nama_kelas FROM kelas");
while ($k = $kelas_query->fetch_assoc()) {
  $kelas_nama[$k['kelas_id']] = $k['nama_kelas'];
}

$guru_id = $_SESSION['guru_id'];
function convertDayToIndonesian($day) {
    $days = [
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu',
        'Sunday' => 'Minggu'
    ];
    return $days[$day] ?? $day;
}

$hariIni = convertDayToIndonesian(date('l')); // Konversi nama hari


$sql = "SELECT 
          jk.jadwal_id, 
          jk.kelas_id, 
          k.nama_kelas,
          mp.nama_mapel,
          r.nama_ruang,
          g.nama_guru,
          jk.guru_id, 
          jk.hari, 
          jk.jam_mulai, 
          jk.jam_selesai, 
          jk.ruang_id
        FROM jadwal_kelas jk
        JOIN kelas k ON jk.kelas_id = k.kelas_id
        JOIN mata_pelajaran mp ON jk.mapel_id = mp.mapel_id
        JOIN ruangan r ON jk.ruang_id = r.ruang_id
        JOIN guru g ON jk.guru_id = g.guru_id
        WHERE jk.guru_id = ? AND jk.hari = ?";  // Menggunakan prepared statement untuk menghindari SQL injection

// Menyiapkan dan mengeksekusi query
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $guru_id, $hariIni);  // 'i' untuk integer, 's' untuk string (hari)
$stmt->execute();
$result = $stmt->get_result();
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

        <a href="#" class="logout" id="logout-btn" onclick="showLogoutModal(event)">
          <img src="assets/img/icon-logout-white.svg" alt="">
          <span class="text-keluar">Keluar</span>
        </a>

        <!-- Logout Confirmation Modal -->
        <div id="logout-modal" class="modal" style="display:none;">
          <div class="modal-content">
            <p>Apakah Anda yakin ingin keluar?</p>
            <button id="confirm-logout" class="btn-logout" onclick="confirmLogout()">Ya, Keluar</button>
            <button id="cancel-logout" class="btn-cancel" onclick="hideLogoutModal()">Batal</button>
          </div>
        </div>
      </aside>

      <div class="right-side">
        <div class="container-top">
          <div class="arrow-top">
            <a href="guru-dashboard.php">Dashboard</a>
            <img src="assets/img/arrow-hari.svg" alt="Arrow" width="16px">
            <a href="guru-jadwalhari">Jadwal Hari Ini</a>
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
      <h1>Jadwal Hari Ini</h1>
      <table>
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
          <?php
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td>" . date('H:i', strtotime($row['jam_mulai'])) . "</td>
                      <td>" . date('H:i', strtotime($row['jam_selesai'])) . "</td>
                      <td>" . $row['nama_mapel'] . "</td>
                      <td>" . $row['nama_kelas'] . "</td>
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
