<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')Dashboard Siswa</title>

    <!-- Fonts & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f9fafb;
            font-family: 'Poppins', sans-serif;
            padding-top: 80px;
            padding-bottom: 60px;
            color: #1f2937;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-weight: 600;
            color: #09090B;
            letter-spacing: -0.5px;
        }

        .dropdown-menu {
            border-radius: 0.75rem;
            border: none;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }

        .dropdown-item {
            font-size: 0.95rem;
            color: #4b5563;
            transition: background 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: #f3f4f6;
            color: #111827;
        }

        .card-border-left {
            border-left: 0.25rem solid #0d6efd;
        }

        .card-border-left.hadir {
            border-left-color: #198754;
        }

        .card-border-left.tidak-hadir {
            border-left-color: #dc3545;
        }

        .card-border-left.telat {
            border-left-color: #fd7e14;
        }

        .sidebar {
            position: fixed;
            top: 60px;
            left: 0;
            width: 250px;
            height: 100%;
            background-color: #ffffff;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.05);
            padding: 20px;
            transform: translateX(-260px);
            transition: transform 0.3s ease;
            z-index: 999;
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .sidebar a {
            display: block;
            margin-bottom: 15px;
            color: #111827;
            text-decoration: none;
            font-weight: 500;
        }

        .sidebar a:hover,
        .sidebar a.active {
            color: #0d6efd;
        }

        .burger-btn {
            font-size: 1.5rem;
            background: none;
            border: none;
            margin-right: 15px;
            cursor: pointer;
            color: #0d6efd;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container d-flex align-items-center">
            <button class="burger-btn" id="burgerToggle">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#">Presensi SMKN 2 Malang</a>
            <div class="dropdown ms-auto">
                <a class="btn btn-light shadow-sm btn-circle d-flex align-items-center justify-content-center" href="#"
                    role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle fs-4 text-primary"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="{{ route('logout') }}">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <a href="{{ route('guru.dashboard') }}" class="{{ Request::is('guru/dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('guru.laporan') }}" class="{{ Request::is('guru/laporan') ? 'active' : '' }}">
            <i class="fas fa-bullhorn"></i> Pengumuman</a>
        <a href="{{ route('guru.datasiswa') }}" class="{{ Request::is('guru/datasiswa') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Data Siswa</a>
    </aside>

    <div class="container mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card card-border-left hadir shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-user-check fa-2x text-success me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Hadir</h5>
                            <p class="card-text">15 Siswa</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-border-left tidak-hadir shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-user-times fa-2x text-danger me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Tidak Hadir</h5>
                            <p class="card-text">3 Siswa</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-border-left telat shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-user-clock fa-2x text-warning me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Terlambat</h5>
                            <p class="card-text">2 Siswa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL -->
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Laporan Kehadiran Hari Ini</h5>
                <button class="btn btn-sm btn-outline-primary" onclick="downloadCSV()">
                    <i class="fas fa-download"></i> Unduh CSV
                </button>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="attendance-body">
                        <!-- Data akan dirender via JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- SCRIPT LOGIKA -->
    <script>

        function downloadCSV() {
            let csv = ['Nama,Status,Tanggal,Jam'];
            attendanceData.forEach(row => {
                csv.push(`${row.name},${row.status},${row.date},${row.time}`);
            });
            const blob = new Blob([csv.join('\n')], { type: 'text/csv' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'laporan_kehadiran.csv';
            a.click();
        }

        // Toggle Sidebar
        document.getElementById('burgerToggle').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('active');
        });

        renderAttendance();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>