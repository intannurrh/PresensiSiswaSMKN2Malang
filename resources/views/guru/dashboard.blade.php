<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Guru</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="css/guru/guru.css">
</head>

<body>
    <button class="toggle-sidebar" id="sidebarToggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>
    <div class="container">
        <aside class="sidebar closed" id="sidebar">
            <i class="fas fa-arrow-left back-icon" onclick="toggleSidebar()"></i>
            <a href="#/dashboard"><i class="fas fa-home"></i> Dashboard</a>
            <a href="#/laporan"><i class="fas fa-chart-line"></i> Laporan</a>
            <a href="#/data-siswa"><i class="fas fa-users"></i> Data Siswa</a>
            <a href="#"><i class="fas fa-bullhorn"></i> Pengumuman</a>
            <a href="#"><i class="fas fa-address-book"></i> Kontak Orang Tua</a>
        </aside>

        <div class="main-content" id="mainContent">
            <header>
                <div class="header-title">Dashboard Guru</div>
                <i class="fas fa-user-circle profile-icon"></i>
            </header>

            <!-- Dashboard Section -->
            <section class="dashboard-section" id="dashboard">
                <h2>Laporan Terkini</h2>

                <div class="laporan-cards">
                    <div class="laporan-card hadir">
                        <i class="fas fa-user-check"></i>
                        <p>10 Siswa Hadir</p>
                    </div>
                    <div class="laporan-card tidak-hadir">
                        <i class="fas fa-user-times"></i>
                        <p>2 Siswa Tidak Hadir</p>
                    </div>
                    <div class="laporan-card telat">
                        <i class="fas fa-user-clock"></i>
                        <p>1 Siswa Terlambat</p>
                    </div>
                </div>

                <h3>Daftar Kehadiran Siswa
                    <input type="text" id="search-input" placeholder="Cari nama siswa...">
                </h3>
                <table>
                    <thead>
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </section>
</body>

    <script src="js/guru/guru.js"></script>
</html>