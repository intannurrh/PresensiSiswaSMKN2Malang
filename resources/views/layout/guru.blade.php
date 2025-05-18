<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title') - Guru SMKN 2 Malang</title>

    <!-- Fonts & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* BODY & TYPOGRAPHY */
        body {
            background-color: #f9fafb;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding-top: 60px;
            /* untuk navbar */
            padding-bottom: 60px;
            /* untuk footer */
            color: #1f2937;
        }

        /* NAVBAR HEADER */
        nav.navbar {
            background-color: #f8fafc;
            /* selaras dengan footer */
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
            padding: 0.75rem 1.5rem;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1050;
            display: flex;
            align-items: center;
        }

        .navbar-brand {
            font-weight: 600;
            color: #1e293b;
            /* dark slate */
            font-size: 1.25rem;
            letter-spacing: -0.5px;
            margin-left: 0.5rem;
        }

        .burger-btn {
            font-size: 1.5rem;
            background: none;
            border: none;
            color: #3b82f6;
            /* blue accent */
            cursor: pointer;
        }

        /* DROPDOWN */
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
            background-color: #e0e7ff;
            color: #1e293b;
        }

        /* SIDEBAR */
        aside.sidebar {
            position: fixed;
            top: 60px;
            left: 0;
            width: 250px;
            height: calc(100vh - 60px);
            background-color: #ffffff;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.05);
            padding: 1.5rem 1rem;
            transform: translateX(-260px);
            transition: transform 0.3s ease;
            z-index: 1040;
            display: flex;
            flex-direction: column;
        }

        aside.sidebar.active {
            transform: translateX(0);
        }

        aside.sidebar a {
            display: flex;
            align-items: center;
            margin-bottom: 1.25rem;
            color: #1e293b;
            font-weight: 600;
            text-decoration: none;
            font-size: 1rem;
            transition: color 0.2s ease;
        }

        aside.sidebar a i {
            margin-right: 12px;
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
            color: #3b82f6;
        }

        aside.sidebar a:hover,
        aside.sidebar a.active {
            color: #2563eb;
        }

        /* MAIN CONTENT */
        main {
            margin-left: 0;
            padding: 2rem 1.5rem;
            transition: margin-left 0.3s ease;
        }

        /* Kalau sidebar aktif, beri ruang ke main */
        aside.sidebar.active~main {
            margin-left: 250px;
        }

        /* FOOTER */
        footer {
            background-color: #f8fafc;
            padding: 16px 24px;
            text-align: center;
            font-size: 0.875rem;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            user-select: none;
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 1030;
        }

        footer a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Scroll bar fix untuk main agar footer tetap visible */
        body,
        html {
            height: 100%;
        }
    </style>
</head>

<body>

    <!-- NAVBAR HEADER -->
    <nav class="navbar">
        <button class="burger-btn" id="burgerToggle" aria-label="Toggle sidebar">
            <i class="fas fa-bars"></i>
        </button>
        <a href="#" class="navbar-brand">Presensi SMKN 2 Malang</a>

        <div class="dropdown ms-auto">
            <a class="btn btn-light shadow-sm btn-circle d-flex align-items-center justify-content-center" href="#"
                role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle fs-4 text-primary"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="dropdownMenuLink">
                <li>
                    <a class="dropdown-item" href="{{ route('guru.profile') }}">
                        <i class="bi bi-person-lines-fill me-2"></i>Profil
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <a href="{{ route('guru.dashboard') }}" class="{{ Request::is('guru/dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('guru.laporan') }}" class="{{ Request::is('guru/laporan') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i> Laporan</a>
        <a href="{{ route('guru.datasiswa') }}" class="{{ Request::is('guru/datasiswa') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Data Siswa</a>
    </aside>

    <!-- MAIN CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="text-muted">&copy; {{ date('Y') }} Asistensi Mengajar Universitas Negeri Malang SMKN 2 Malang. All
            rights
            reserved.</div>
    </footer>

    <!-- SCRIPT LOGIKA -->
    <script>
        // Toggle Sidebar
        document.getElementById('burgerToggle').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>