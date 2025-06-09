<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/admin.css" />
</head>

<body>
    <div class="dropdown">
        <button onclick="toggleDropdown()" class="dropdown-toggle">
            📅 Lihat Jadwal Sebagai <span class="arrow">▼</span>
        </button>

        <div id="dropdown-menu" class="dropdown-menu">
            <div class="dropdown-label hover-only">Siswa</div>
            <div class="dropdown-subsection">
                <a href="siswa-dashboard.php" class="dropdown-item">XI RPL 1</a>
                <a href="jadwal-xi-rpl-2.html" class="dropdown-item">XI RPL 2</a>
                <a href="jadwal-xi-rpl-3.html" class="dropdown-item">XI RPL 3</a>
            </div>

            <div class="dropdown-label hover-only">Guru</div>
            <div class="dropdown-subsection">
                <a href="siswa-dashboard.php" class="dropdown-item">Guru Mapel</a>
            </div>
        </div>
    </div>

    <div class="dropdown-hari">
        <button onclick="toggleHariDropdown()" class="dropdown-toggle-hari">
            📅 Hari <span class="arrow">▼</span>
        </button>

        <div id="hari-dropdown" class="dropdown-menu-hari">
            <a href="#" class="hari-item">Senin</a>
            <a href="#" class="hari-item">Selasa</a>
            <a href="#" class="hari-item">Rabu</a>
            <a href="#" class="hari-item">Kamis</a>
            <a href="#" class="hari-item">Jumat</a>
        </div>
    </div>

    <script src="assets/js/admin.js"></script>
</body>

</html>