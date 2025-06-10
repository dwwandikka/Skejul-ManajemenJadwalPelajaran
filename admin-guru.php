<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jadwal Hari Ini</title>
    <link rel="stylesheet" href="assets/css/admin-xirpl1.css">
</head>

<body class="bg-blue-50 min-h-screen p-6">

    <?php
    session_start();
    include 'db.php';

    $conn = mysqli_connect($host, $user, $pass, $db);

    // Handler AJAX untuk tambah jadwal
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'tambah') {
        $jamMulai = $_POST['jamMulai'];
        $jamSelesai = $_POST['jamSelesai'];
        $mapel = $_POST['mapel'];
        $guru = $_POST['guru'];
        $ruang = $_POST['ruang'];
        $hari = $_POST['hari'] ?? ''; // Ambil dari dropdown form
        $kelas_id = $_POST['kelas_id'] ?? null; // Ambil dari POST

        // Contoh query insert (pastikan nama tabel dan kolom sesuai database kamu)
        $sql = "INSERT INTO jadwal_kelas (jam_mulai, jam_selesai, mapel_id, guru_id, ruang_id, hari, kelas_id)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Ambil id mapel, guru, ruang dari nama (atau sesuaikan dengan struktur DB kamu)
        // Untuk contoh, langsung masukkan string (jika id, lakukan query select id dulu)
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $jamMulai, $jamSelesai, $mapel, $guru, $ruang, $hari, $kelas_id);

        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error: ' . $stmt->error; // Tampilkan error detail
        }
        exit;
    }
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
                            <a href="admin-dashboard.php" class="beranda">
                                <img class="home-icon" src="assets/img/home-fill.svg" alt="Home Icon">
                                <span class="text-beranda">Beranda</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="jadwal">
                                <img class="jadwal-icon" src="assets/img/jadwal-icon-blue.svg" alt="Jadwal Icon">
                                <span class="text-jadwal">Jadwal</span>

                            </a>
                            <ul class="dropdown-list">

                            </ul>
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
                            <h1><?php echo $_SESSION['nama']; ?></h1>
                            <p>Siswa Aktif</p>
                        </div>
                    </div>
                </div>

                <div class="jadwal-tambah">
                    <h1>Jadwal Hari Ini</h1>
                    <button class="btn-tambah" onclick="openForm('tambah')">
                        <img src="assets/img/plus.svg" alt="Tambah"> Tambah Jadwal
                    </button>
                </div>
                <div class="container-tabel-jadwal">
                    <table>
                        <thead>
                            <tr>
                                <th>JAM MULAI</th>
                                <th>JAM SELESAI</th>
                                <th>MATA PELAJARAN</th>
                                <th>Kelas</th>
                                <th>RUANG</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="jadwalBody">
                            <?php
                            // Ambil data jadwal dari database
                            // Kode sebelumnya hanya menampilkan jadwal untuk kelas_id 3030
                            // Jika ingin menampilkan semua jadwal, hapus WHERE j.kelas_id = ...
                            $jadwalList = $conn->query("SELECT j.jadwal_id, j.hari, j.jam_mulai, j.jam_selesai, m.nama_mapel, m.mapel_id, g.nama_guru, g.guru_id, r.nama_ruang, r.ruang_id, k.nama_kelas, k.kelas_id
                            FROM jadwal_kelas j
                            JOIN mata_pelajaran m ON j.mapel_id = m.mapel_id
                            JOIN guru g ON j.guru_id = g.guru_id
                            JOIN ruangan r ON j.ruang_id = r.ruang_id
                            JOIN kelas k ON j.kelas_id = k.kelas_id");
                            // Tampilkan data jadwal
                            while ($row = $jadwalList->fetch_assoc()):
                            ?>
                                <tr data-id="<?= $row['jadwal_id'] ?>" data-hari="<?= htmlspecialchars($row['hari']) ?>">
                                <td><?= date('H:i', strtotime($row['jam_mulai'])) ?></td>
                                <td><?= date('H:i', strtotime($row['jam_selesai'])) ?></td>
                                <td data-mapel-id="<?= $row['mapel_id'] ?>"><?= htmlspecialchars($row['nama_mapel']) ?></td>
                                <td data-guru-id="<?= $row['guru_id'] ?>"><?= htmlspecialchars($row['nama_kelas']) ?></td>
                                <td data-ruang-id="<?= $row['ruang_id'] ?>"><?= htmlspecialchars($row['nama_ruang']) ?></td>
                                <td>
                                    <img src="assets/img/edit.svg" class="icon" onclick="editRow(this)">
                                    <img src="assets/img/delete.svg" class="icon" onclick="confirmDelete(this)">
                                </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Form Modal (Tambah/Edit) -->
                <div class="modal" id="formModal">
                    <div class="modal-content">
                        <h2 id="formTitle">Tambah Jadwal</h2>
                        <?php
                        // Ambil data dari database
                        $mapelList = $conn->query("SELECT mapel_id, nama_mapel FROM mata_pelajaran");
                        $guruList = $conn->query("SELECT guru_id, nama_guru FROM guru");
                        $ruangList = $conn->query("SELECT ruang_id, nama_ruang FROM ruangan");
                        $kelasList = $conn->query("SELECT kelas_id, nama_kelas FROM kelas");
                        ?>
                        
                        <form method="POST" id="jadwalForm">
                            <div class="input-jadwal">
                                <label for="jamMulai">Jam Mulai</label>
                                <input type="time" id="jamMulai" name="jamMulai" required>
                            </div>
                            <div class="input-jadwal">
                                <label for="jamSelesai">Jam Selesai</label>
                                <input type="time" id="jamSelesai" name="jamSelesai" required>
                            </div>
                            <div class="input-jadwal">
                                <label for="hari">Hari</label>
                                <select id="hari" name="hari" required>
                                    <option value="">Pilih Hari</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                </select>
                            </div>
                            <div class="input-jadwal">
                                <label for="mapel">Mata Pelajaran</label>
                                <select id="mapel" name="mapel" required>
                                    <option value="">Pilih Mata Pelajaran</option>
                                    <?php while ($row = $mapelList->fetch_assoc()): ?>
                                        <option value="<?= $row['mapel_id'] ?>"><?= htmlspecialchars($row['nama_mapel']) ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
            <div class="input-jadwal">
                            <label for="kelas">Kelas</label>
                            <select id="kelas" name="kelas_id" required>
                                <option value="">Pilih Kelas</option>
                                <?php while ($row = $kelasList->fetch_assoc()): ?>
                                    <option value="<?= $row['kelas_id'] ?>"><?= htmlspecialchars($row['nama_kelas']) ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                                        <div class="input-jadwal">
                                            <label for="guru">Guru Pengajar</label>
                                <select id="guru" name="guru" required>
                                    <option value="">Pilih Guru</option>
                                    <?php while ($row = $guruList->fetch_assoc()): ?>
                                        <option value="<?= $row['guru_id'] ?>"><?= htmlspecialchars($row['nama_guru']) ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="input-jadwal">
                                <label for="ruang">Ruang</label>
                            <select id="ruang" name="ruang" required>
                                                                <option value="">Pilih Ruang</option>
                                                                <?php while ($row = $ruangList->fetch_assoc()): ?>
                                                                    <option value="<?= $row['ruang_id'] ?>"><?= htmlspecialchars($row['nama_ruang']) ?></option>
                                                                <?php endwhile; ?>
                                                            </select>
                                                        </div>
                            <div class="button-batal-tambah">
                                <button type="button" id="closeBtn" onclick="closeForm()">Batal</button>
                                <button type="submit" id="submitBtn">Tambah</button>
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

                <script src="assets/js/admin-guru.js"></script>
</body>

</html>