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
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 22 20" fill="none">
                <rect width="22" height="3.83555" rx="1.91777" fill="white" />
                <rect y="7.6711" width="22" height="3.83555" rx="1.91777" fill="white" />
                <rect y="15.3422" width="10.3529" height="3.83555" rx="1.91777" fill="white" />
            </svg>
            <img src="assets/img/SkeJul.png" alt="" class="logo-skejul" />
            </div>

            <nav>
            <ul>
                <li>
                <a href="<?php echo $role; ?>-dashboard.php" class="beranda">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                    <path d="..." fill="#0959FF" />
                    </svg>
                    <span class="text-beranda">Beranda</span>
                </a>
                </li>
                <li>
                <a href="#" class="jadwal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="..." fill="white" />
                    </svg>
                    <span class="text-jadwal">Jadwal</span>
                </a>
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

            <a href="logout.php" class="logout">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="..." fill="#DBDBDB" />
                <path d="..." fill="#DBDBDB" />
            </svg>
            <span class="text-keluar">Keluar</span>
            </a>
        </aside>
        </div>
        <div class="main-content">
            <div class="mobile-header">
                <div class="mobile-nav">
                    <div class="mobile-hamburger" id="mobileHamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>

            <div class="profile-header">
                <div class="profile-user">
                    <div class="profile-avatar">
                        <img src="assets/img/profilee.png" alt="Profile <?php echo htmlspecialchars($display_name); ?>">
                    </div>
                    <div class="profile-info">
                        <h2><?php echo htmlspecialchars($display_username); ?></h2>
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
                        <h3>Role/Peran</h3>
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
                
                <?php if($role === 'guru'): ?>
                <div class="detail-group">
                    <div class="detail-item">
                        <h3>ID Guru</h3>
                        <p><?php echo htmlspecialchars($_SESSION['guru_id'] ?? 'Tidak tersedia'); ?></p>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Tombol Edit Profile (opsional) -->
            <div class="profile-actions" style="margin-top: 20px; text-align: center;">
                <button class="btn-edit-profile" onclick="editProfile()" style="background: #0959FF; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                    Edit Profile
                </button>
            </div>
        </div>
    </div>

    <script>
        function editProfile() {
            // Redirect ke halaman edit profile atau tampilkan modal edit
            window.location.href = 'edit-profile.php';
        }

        // Fungsi untuk logout
        document.addEventListener('DOMContentLoaded', function() {
            const logoutBtn = document.querySelector('.logout');
            if(logoutBtn) {
                logoutBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if(confirm('Apakah Anda yakin ingin keluar?')) {
                        window.location.href = 'logout.php';
                    }
                });
            }
        });
    </script>

</body>

</html>