<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jadwal Hari Ini</title>
    <link rel="stylesheet" href="assets/css/admin-xirpl1.css">
</head>

<body class="bg-blue-50 min-h-screen p-6">
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

                <div class="jadwal-tambah">
                    <h1>Jadwal Hari Ini</h1>
                    <button class="btn-tambah" onclick="openForm('tambah')">
                        <img src="icons/plus.svg" alt="Tambah"> Tambah Jadwal
                    </button>
                </div>
                <div class="container-tabel-jadwal">
                    <table>
                        <thead>
                            <tr>
                                <th>JAM MULAI</th>
                                <th>JAM SELESAI</th>
                                <th>MATA PELAJARAN</th>
                                <th>GURU PENGAJAR</th>
                                <th>RUANG</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="jadwalBody">
                            <!-- Data akan dimuat -->
                            <tr>
                                <td>07.30</td>
                                <td>08.10</td>
                                <td class="highlight">Pemrograman Grafis</td>
                                <td class="highlight">Pratyaksa Kepakisan</td>
                                <td>Lab RPL 1</td>
                                <td>
                                    <img src="icons/edit.svg" class="icon" onclick="editRow(this)">
                                    <img src="icons/delete.svg" class="icon" onclick="confirmDelete(this)">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Form Modal (Tambah/Edit) -->
                <div class="modal" id="formModal">
                    <div class="modal-content">
                        <h2 id="formTitle">Tambah Jadwal</h2>
                        <div class="label-hari">Selasa, XI RPL 1</div>
                        <form id="jadwalForm">
                            <div class="input-jadwal">
                                <label for="jamMulai">Jam Mulai</label>
                                <input type="time" id="jamMulai" required>
                            </div>
                            <div class="input-jadwal">
                                <label for="jamSelesai">Jam Selesai</label>
                                <input type="time" id="jamSelesai" required>
                            </div>
                            <div class="input-jadwal">
                                <label for="mapel">Mata Pelajaran</label>
                                <input type="text" id="mapel" placeholder="Masukkan MATA PELAJARAN" required>
                            </div>
                            <div class="input-jadwal">
                                <label for="guru">Guru Pengajar</label>
                                <input type="text" id="guru" placeholder="Masukkan GURU PENGAJAR" required>
                            </div>
                            <div class="input-jadwal">
                                <label for="ruang">Ruang</label>
                                <input type="text" id="ruang" placeholder="Masukkan RUANG" required>
                            </div>
                            <div class="button-batal-tambah">
                                <button type="button" id="closeBtn" onclick="closeForm()">Batal</button>
                                <button type="button" id="submitBtn" onclick="submitForm()">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- Confirm Delete -->
                <div class="modal" id="confirmModal">
                    <div class="modal-content">
                        <p>Apakah Anda yakin ingin menghapus jadwal ini?</p>
                        <button onclick="closeConfirm()">Batal</button>
                        <button onclick="deleteRow()">Lanjutkan</button>
                    </div>
                </div>

                <!-- Success Message -->
                <div class="modal" id="successModal">
                    <div class="modal-content">
                        <p>Jadwal berhasil dihapus.</p>
                    </div>
                </div>

                <script src="assets/js/admin-xirpl1.js"></script>
</body>

</html>