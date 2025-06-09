<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Dashboard - Admin</title>
        <link rel="stylesheet" href="assets/css/admin-jadwalhariini.css" />
    </head>

    <body>
        <?php
        session_start();
        if (!isset($_SESSION['nama'])) {
            // Jika pengguna belum login, redirect ke halaman login
            header("Location: login.php");
            exit();
        }
        ?>
        <!-- Header -->
        <header class="topbar">
            <div class="topbar-left">
                <img src="assets/img/logo-smk.png" alt="Logo SMK" class="logo-smk" />
                <span class="school-name">SMK NEGERI 1 DENPASAR</span>
            </div>
            <img src="assets/img/logo-smk-hebat.svg" alt="Logo SMK Bisa" class="logo-kanan" />
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
                                <a href="admin-dashboard.php" class="beranda">
                                    <img class="home-icon" src="assets/img/home logo.svg" alt="">
                                    <span class="text-beranda">Beranda</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="admin-jadwalhari.php" class="jadwal">

                                    <!-- Icon Jadwal -->
                                    <img class="jadwal-icon" src="assets/img/jadwal-icon-white.svg" alt="">
                                    <span class="text-jadwal">Jadwal</span>
                                </a>

                            </li>
                            <li class="dropdown-tambah-akun">
                                <a href="tambah-akun-admin.php" class="jadwal">

                                    <!-- Icon Jadwal -->
                                    <img class="jadwal-icon" src="assets/img/jadwal-icon-white.svg" alt="">
                                    <span class="text-jadwal">Tambah</span>
                                </a>

                            </li>

                        </ul>
                    </nav>
                    <div class="info-box">
                        <img src="assets/img/ilustrasi-sitebar.png" alt="Ilustrasi Jadwal" class="ilustrasi-sitebar" />
                        <p>Lihat dan kelola jadwal pelajaran <br /> mudah dengan SkeJul</p>
                    </div>
                    <a href="#" class="logout">
                        <img src="assets/img/icon-logout-white.svg" alt="">
                        <span class="text-keluar">Keluar</span>
                    </a>
                </aside>
            </div>
            <!-- Dashboard Layout -->
            <img src="assets/img/ilustrasi-welcome-real.svg" alt="Ilustrasi" class="ilustrasi-welcomee" />
            <div id="dashboard-layout">
                <!-- Welcome Section -->
                <div class="welcome-input-emoji">
                    <div class="text-welcome">
                        <p>Selamat Datang,</p>
                        <h1><?php echo $_SESSION['nama']; ?></h1>
                    </div>
                    <div id="welcome-section" class="card-box">
                        <div>
                            <div class="input-wrapper">
                                <img src="assets/img/profile-avatar.svg" alt="Profile" />
                                <p>Apa yang anda pikirkan?</p>
                            </div>
                            <div class="emoji">
                                <img src="assets/img/emoji-senyum.svg" alt="Emoji 1" />
                                <img src="assets/img/emoji-lope.svg" alt="Emoji 2" />
                                <img src="assets/img/emoji-ngantuk.svg" alt="Emoji 3" />
                                <img src="assets/img/emoji-bingung.svg" alt="Emoji 4" />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Kolom Tengah -->
                <div class="left-column">
                    <div class="slogan-skensa">
                        <div class="card-row">
                            <div class="card">
                                <div class="icon-di-slogan-skensa">
                                    <img src="assets/img/icon-siap.svg" alt="" class="icon-normal">
                                    <img src="assets/img/icon-siap-putih.svg" alt="" class="icon-hover">
                                    <h3>Siap</h3>
                                </div>
                                <p>Selalu siap secara fisik dan mental untuk belajar atau bekerja.</p>
                            </div>
                            <div class="card">
                                <div class="icon-di-slogan-skensa">
                                    <img src="assets/img/icon-displin.svg" alt="" class="icon-normal">
                                    <img src="assets/img/icon-disiplin-putih.svg" alt="" class="icon-hover">
                                    <h3>Disiplin</h3>
                                </div>
                                <p>Tepat waktu, taat aturan, dan bertanggung jawab.</p>
                            </div>
                        </div>
                        <div class="card-row">
                            <div class="card">
                                <div class="icon-di-slogan-skensa">
                                    <img src="assets/img/icon-berkompeten.svg" alt="" class="icon-normal">
                                    <img src="assets/img/icon-berkompeten-putih.svg" alt="" class="icon-hover">
                                    <h3>Berkompeten</h3>
                                </div>
                                <p>Memiliki keterampilan, dan sikap kerja yang sesuai dengan bidang keahlian.</p>
                            </div>
                            <div class="card blue">
                                <div class="icon-di-slogan-skensa">
                                    <img src="assets/img/icon-beretika.svg" alt="" class="icon-normal">
                                    <img src="assets/img/icon-beretika-putih.svg" alt="" class="icon-hover">
                                    <h3>Beretika</h3>
                                </div>
                                <p>Sopan, jujur, dan menghormati seseorang dalam bekerja.</p>
                            </div>
                        </div>
                    </div>
                    <img src="assets/img/img-desc-skejul.svg" alt="" class="img-desc-skejul">
                    <div class="card-box-desc">
                        <div class="skejul-blue-line">
                            <img src="assets/img/logo-skejul-blue.svg" alt="" class="skejul-blue">
                            <div class="gradient-line"></div>
                        </div>
                        <div class="desc-p-strong-skejul">
                            <p>
                                Dengan SkeJul, jadwal pelajaran kini ada di ujung jari. Siswa & guru bisa melihat</p> <strong>jadwal pelajaran kapan saja,</strong> <strong> mana saja — tanpa ribet!</strong>
                        </div>
                    </div>
                </div>
                <!-- Kolom Kanan -->
            </div>
            <div class="right-column">
                <div class="profile-box">
                    <img src="assets/img/profile-avatar.svg" alt="Foto Profil" class="profile-img">
                    <div class="profile-text">
                        <h1><?php echo $_SESSION['nama']; ?></h1>
                        <p>Siswa Aktif</p>
                    </div>
                </div>
                <div class="card-box-tanggal">
                    <div class="date-card">
                        <div class="badge">Hari ini</div>
                        <div class="date-text">
                            <?php
                            date_default_timezone_set('Asia/Makassar'); // atau Asia/Jakarta

                            // Array hari dan bulan Indonesia
                            $hariIndo = [
                                'Sunday'    => 'Minggu',
                                'Monday'    => 'Senin',
                                'Tuesday'   => 'Selasa',
                                'Wednesday' => 'Rabu',
                                'Thursday'  => 'Kamis',
                                'Friday'    => 'Jumat',
                                'Saturday'  => 'Sabtu'
                            ];
                            $bulanIndo = [
                                'January'   => 'Januari',
                                'February'  => 'Februari',
                                'March'     => 'Maret',
                                'April'     => 'April',
                                'May'       => 'Mei',
                                'June'      => 'Juni',
                                'July'      => 'Juli',
                                'August'    => 'Agustus',
                                'September' => 'September',
                                'October'   => 'Oktober',
                                'November'  => 'November',
                                'December'  => 'Desember'
                            ];

                            $hariIni = $hariIndo[date('l')];
                            $bulanIni = $bulanIndo[date('F')];
                            $tanggalIndo = date('j') . ' ' . $bulanIni . ' ' . date('Y');
                            ?>
                            <h1><?php echo $hariIni; ?></h1>
                            <h2><?php echo $tanggalIndo; ?></h2>
                        </div>
                    </div>
                    <div class="shapes">
                        <div class="shape shape-1"></div>
                        <div class="shape shape-2"></div>
                        <div class="shape shape-3"></div>
                    </div>
                    <div class="legend-list">
                        <div class="legend-item"><span class="dot dot-1"></span> Hari ini</div>
                        <div class="legend-item"><span class="dot dot-2"></span> Minggu ini</div>
                        <div class="legend-item"><span class="dot dot-3"></span> Mapel Tertentu</div>
                        <div class="legend-item"><span class="dot dot-4"></span> Kelas XI</div>
                    </div>
                </div>
                <div class="card-box-motivasi">
                    <img src="assets/img/img-bawah-motivasi.svg" alt="" class="ilustrasi-motivasi">
                    <div class="gradient-line-bawah"></div>
                    <p>Mulai dari jadwal wujudkan,</p> <strong>SKENSA</strong> </br> <strong> masa depan <br> yang cerah!</strong>
                </div>
            </div>
        </div>

        <script src="assets/js/admin-jadwalhariini.js"></script>
    </body>

    </html>