<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard - Siswa</title>
  <link rel="stylesheet" href="assets/css/dashboard-siswa.css" />
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
              <a href="#" class="beranda">
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

        <a href="#" class="logout">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="..." fill="#DBDBDB" />
            <path d="..." fill="#DBDBDB" />
          </svg>
          <span class="text-keluar">Keluar</span>
        </a>
      </aside>
    </div>

    <!-- Dashboard Layout -->
    <div id="dashboard-layout">
      <img src="assets/img/ilustrasi-welcome-real.svg" alt="Ilustrasi" class="ilustrasi-welcomee" />

      <!-- Welcome Section -->
      <div class="welcome-input-emoji">
        <div class="text-welcome">
          <p>Selamat Datang,</p>
          <h1>Kadek Yudhi Satria</h1>
        </div>

        <div class="profile-box">
        <img src="assets/img/profilee.png" alt="Foto Profil" class="profile-img">
          <div class="profile-text">
            <h4>Kadek Yudhi Satria</h4>
            <p>Siswa Aktif</p>
        </div>
        </div>

        <div id="welcome-section" class="card-box">
          <div>
            <div class="input-wrapper">
              <img src="assets/img/profilee.png" alt="Profile" />
              <input type="text" placeholder="Apa yang Anda pikirkan?" />
            </div>
            <div class="emoji">
              <img src="assets/img/emoji 1.png" alt="Emoji 1" />
              <img src="assets/img/emojii 2.png" alt="Emoji 2" />
              <img src="assets/img/emoji 3.png" alt="Emoji 3" />
              <img src="assets/img/emoji 4.png" alt="Emoji 4" />
            </div>
          </div>
        </div>
      </div>

      <!-- Kolom Kiri -->
      <div class="left-column">
        <div class="card-row">
          <div class="card">
            <h3>Siap</h3>
            <p>Selalu siap secara fisik dan mental untuk belajar atau bekerja.</p>
          </div>
          <div class="card">
            <h3>Disiplin</h3>
            <p>Selalu siap secara fisik dan mental untuk belajar atau bekerja.</p>
          </div>
        </div>

        <div class="card-row">
          <div class="card">
            <h3>Berkompeten</h3>
            <p>Selalu siap secara fisik dan mental untuk belajar atau bekerja.</p>
          </div>
          <div class="card blue">
            <h3>Beretika</h3>
            <p>Selalu siap secara fisik dan mental untuk belajar atau bekerja.</p>
          </div>
        </div>

        <div class="card-box">
          <h3>SkeJul</h3>
          <p>
            Dengan SkeJul, jadwal pelajaran kini ada di ujung jari. Siswa & guru bisa melihat <strong>jadwal kapan saja</strong>, di mana saja — tanpa ribet!
          </p>
          <img src="https://via.placeholder.com/300x100" alt="Ilustrasi jadwal" style="margin-top: 10px;" />
        </div>

      </div>

          <!-- Kolom Kanan -->

    </div>
    <div class="right-column">
        <div class="card-box">
          <h4>Hari Ini</h4>
          <h2 style="color:#2962ff;">Senin<br>3 Juli 2025</h2>
          <div id="legend-info">
            <div><span class="legend-dot" style="background: #2962ff;"></span> Hari ini</div>
            <div><span class="legend-dot" style="background: #0d47a1;"></span> Minggu ini</div>
            <div><span class="legend-dot" style="background: #00bcd4;"></span> Mapel Tertentu</div>
            <div><span class="legend-dot" style="background: #1de9b6;"></span> Kelas XI</div>
          </div>
        </div>

        <div class="card-box calendar-box">
          <h4>Juni 2025</h4>
          <p>[Kalender Dummy]</p>
        </div>
      </div>
  </div>
</body>

</html>
