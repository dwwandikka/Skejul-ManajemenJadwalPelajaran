<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Hari ini - Admin</title>
    <link rel="stylesheet" href="assets/css/admin-jadwalhari.css">
</head>

<body>
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
                            <a href="admin-dashboard.php" class="beranda">
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
                                <li><a href="#">Jadwal Hari Ini</a></li>
                                <li><a href="#">Jadwal Lengkap</a></li>
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
                        <a href="admin-dashboard.php">Dashboard</a>
                        <img src="assets/img/arrow-hari.svg" alt="Arrow" width="16px">
                        <a href="#">Jadwal Hari Ini</a>
                    </div>
                    <div class="profile-box">
                        <img src="assets/img/profile-avatar.svg" alt="Foto Profil" class="profile-img">
                        <div class="profile-text">
                            <h1>Kadek Yudhi Satria</h1>
                            <p>Siswa Aktif</p>
                        </div>
                    </div>
                </div>
                <div class="jadwal-container">
                    <h1>Jadwal Hari Ini</h1>
                </div>
                <div class="dropdown">
                    <button onclick="toggleDropdown()" class="dropdown-toggle">
                        <p>Lihat Jadwal Sebagai</p> <span class="arrow">▼</span>
                    </button>

                    <div id="dropdown-menu" class="dropdown-menu">
                        <div class="dropdown-label hover-only">Siswa</div>
                        <div class="dropdown-subsection">
                            <a href="admin-xirpl1.php" class="dropdown-item">XI RPL 1</a>
                            <a href="jadwal-xi-rpl-2.html" class="dropdown-item">XI RPL 2</a>
                            <a href="jadwal-xi-rpl-3.html" class="dropdown-item">XI RPL 3</a>
                        </div>

                        <div class="dropdown-label hover-only">Guru</div>
                        <div class="dropdown-subsection">
                            <a href="siswa-dashboard.php" class="dropdown-item">Guru Mapel</a>
                        </div>
                    </div>
                </div>
                <script src="assets/js/admin.js"></script>
</body>

</html>