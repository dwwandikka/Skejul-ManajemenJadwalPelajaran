<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil data user dari session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$nama_lengkap = $_SESSION['nama'];
$role = $_SESSION['role'];
$kelas_id = $_SESSION['kelas_id'];

// Include database connection
include 'db.php';

// Query untuk mendapatkan data lengkap user termasuk kelas
$query = "SELECT u.*, k.nama_kelas 
          FROM users u 
          LEFT JOIN kelas k ON u.kelas_id = k.kelas_id 
          WHERE u.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();

// Set default values jika data tidak ditemukan
$display_name = $user_data['nama_lengkap'] ?? $username;
$display_username = $user_data['username'] ?? $username;
$display_kelas = $user_data['nama_kelas'] ?? 'Tidak ada kelas';
$display_role = ucfirst($role);

// Status berdasarkan role
$status_text = '';
switch($role) {
    case 'siswa':
        $status_text = 'Siswa Aktif';
        break;
    case 'guru':
        $status_text = 'Guru Aktif';
        break;
    case 'admin':
        $status_text = 'Administrator';
        break;
    default:
        $status_text = 'User Aktif';
}

// Set navigation links berdasarkan role
$dashboard_link = '';
$jadwal_hari_link = '';

switch($role) {
    case 'siswa':
        $dashboard_link = 'siswa-dashboard.php';
        $jadwal_hari_link = 'jadwalhari-siswa.php';
        $jadwal_lengkap_link = 'jadwallengkap-siswa.php';
        break;
    case 'guru':
        $dashboard_link = 'guru-dashboard.php';
        $jadwal_hari_link = 'guru-jadwalhari.php';
        $jadwal_lengkap_link = 'guru-jadwallengkap.php';
        break;
    default:
        $dashboard_link = 'dashboard.php';
        $jadwal_hari_link = 'jadwalhari.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile - <?php echo htmlspecialchars($display_role); ?></title>
  <link rel="stylesheet" href="assets/css/profile.css" />
</head>

<body>
  <!-- Header -->
  <header class="topbar">
    <div class="topbar-left">
      <img src="assets/img/logo-smk.png" alt="Logo SMK" class="logo-smk" />
      <span class="school-name">SMK NEGERI 1 DENPASAR</span>
    </div>
    <img src="assets/img/logo-smk-bisa.png" alt="Logo SMK Bisa" class="logo-kanan" />
  </header>

    <div class="container-all">
        <div class="container">
        <!-- Sidebar -->
            <aside class="sidebar">
                <div class="logo">
                    <img src="assets/img/List.svg" alt="">
                    <img src="assets/img/SkeJul-white.svg" alt="" class="logo-skejul" />
                </div>
                <nav>
                    <ul>
                        <li>
                        <a href="<?php echo htmlspecialchars($dashboard_link); ?>" class="beranda">
                            <img class="home-icon" src="assets/img/home-fill.svg" alt="">
                            <span class="text-beranda">Beranda</span>
                        </a>
                        </li>
                        <li class="dropdown">
                        <a href="#" class="jadwal">
                            <!-- Icon Jadwal -->
                            <img class="jadwal-icon" src="assets/img/jadwal-icon-white.svg" alt="">
                            <span class="text-jadwal">Jadwal</span>
                            <img class="arrow-icon" src="assets/img/arrow-white.svg" alt="">
                        </a>
                        <!-- Dropdown menu -->
                        <ul class="dropdown-list">
                            <li><a href="<?php echo htmlspecialchars($jadwal_hari_link); ?>">Jadwal Hari Ini</a></li>
                            <li><a href="<?php echo htmlspecialchars($jadwal_lengkap_link); ?>#">Jadwal Lengkap</a></li>
                        </ul>
                        </li>
                    </ul>
                </nav>
                <div class="info-box">
                    <img src="assets/img/ilustrasi-sitebar.png" alt="Ilustrasi Jadwal" class="ilustrasi-sitebar" />
                    <p>Lihat dan kelola jadwal pelajaran <br/> mudah dengan SkeJul</p>
                </div>
                <a href="#" class="logout">
                    <img src="assets/img/icon-logout-white.svg" alt="">
                    <span class="text-keluar">Keluar</span>
                </a>
            </aside>
        </div>
        <div class="main-content">
            <div class="mobile-header">
                <div class="mobile-nav">
                    <div class="mobile-hamburger" id="mobileHamburger">
                        <img src="assets/img/List.svg" alt="">
                    </div>
                </div>
            </div>

            <div class="profile-header">
                <div class="profile-user">
                    <div class="profile-avatar">
                        <img src="assets/img/profile-avatar.svg" alt="Profile">
                    </div>
                    <div class="profile-info">
                        <h2><?php echo htmlspecialchars($display_name); ?></h2>
                        <div class="profile-status"><?php echo htmlspecialchars($status_text); ?></div>
                    </div>
                </div>
            </div>

            <div class="profile-details">
                <div class="detail-group">
                    <div class="detail-item">
                        <h3>Nama lengkap</h3>
                        <p><?php echo htmlspecialchars($display_name); ?></p>
                    </div>
                    <div class="detail-item">
                        <h3>Kategori</h3>
                        <p><?php echo htmlspecialchars($display_role); ?></p>
                    </div>
                </div>
                <div class="detail-group">
                    <div class="detail-item">
                        <h3>Username</h3>
                        <p><?php echo htmlspecialchars($display_username); ?></p>
                    </div>
                    <?php if($role === 'siswa' && !empty($display_kelas)): ?>
                    <div class="detail-item">
                        <h3>Kelas</h3>
                        <p><?php echo htmlspecialchars($display_kelas); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/profile.js"></script>

</body>

</html>