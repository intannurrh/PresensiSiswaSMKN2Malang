<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Orang Tua</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>


    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f5f7fa;
            transition: margin-left 0.3s ease;
        }

        .sidebar {
            width: 220px;
            background: #fff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            padding: 1rem;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        body.sidebar-open .sidebar {
            transform: translateX(0);
        }

        .sidebar a {
            text-decoration: none;
            color: #333;
            padding: 0.8rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #e3f2fd;
            color: #1565c0;
        }

        .close-sidebar-btn {
            align-self: flex-end;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #333;
            cursor: pointer;
            margin-bottom: 1rem;
        }

        .toggle-sidebar {
            position: fixed;
            top: 1rem;
            left: 1rem;
            background: #1565c0;
            color: white;
            border: none;
            padding: 0.6rem;
            border-radius: 50%;
            cursor: pointer;
            z-index: 1001;
            font-size: 1.2rem;
            display: block;
        }

        .toggle-sidebar.hidden {
            display: none;
        }

        header {
            background: linear-gradient(to right, #2196f3, #00bcd4);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            margin-left: 0;
            transition: margin-left 0.3s ease;
        }

        body.sidebar-open header {
            margin-left: 220px;
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .account-icon-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        main {
            margin-left: 0;
            padding: 2rem;
            transition: margin-left 0.3s ease;
        }

        body.sidebar-open main {
            margin-left: 220px;
        }

        .card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        footer {
            text-align: center;
            padding: 1rem;
            background: #1565c0;
            color: white;
            margin-top: 2rem;
        }

        header {
            background: linear-gradient(to right, #2196f3, #00bcd4);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            position: sticky;
            top: 0;
            z-index: 100;
            margin-left: 0;
            transition: margin-left 0.3s ease;
        }

        body.sidebar-open header {
            margin-left: 220px;
        }

        .toggle-sidebar {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-right: auto;
            /* Supaya title dorong icon ke kanan */
        }

        .account-icon-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .header-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <!-- Tombol panah ke kiri -->
        <button id="closeSidebarBtn" class="close-sidebar-btn" title="Tutup Sidebar">
            <i class="fas fa-arrow-left"></i>
        </button>
        <a href="{{ route('ortu.dashboard') }}" class="{{ Request::is('ortu/dashboard') ? 'active' : '' }}"><i
                class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('ortu.rekap') }}" class="{{ Request::is('ortu/rekap') ? 'active' : '' }}"><i
                class="fas fa-chart-line"></i> Rekap Presensi</a>
        <a href="{{ route('ortu.pengumuman') }}" class="{{ Request::is('ortu/pengumuman') ? 'active' : '' }}"><i
                class="fas fa-bullhorn"></i> Pengumuman</a>
    </aside>
    <header class="d-flex justify-content-between align-items-center p-3 bg-light">
        <button id="openSidebarBtn" class="header-toggle">
            <i class="fas fa-bars"></i>
        </button>
        <div class="header-title">Dashboard Orang Tua</div>

        <!-- Dropdown Menu -->
        <div class="dropdown">
            <button class="btn account-icon-btn" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user-circle fa-2x"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item" type="submit">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </header>




    <!-- Main -->
    <main>
        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} Sistem Monitoring Kehadiran
    </footer>

    <script>
        const body = document.body;
        const openBtn = document.getElementById('openSidebarBtn');
        const closeBtn = document.getElementById('closeSidebarBtn');

        openBtn.addEventListener('click', () => {
            body.classList.add('sidebar-open');
            openBtn.classList.add('hidden');
        });

        closeBtn.addEventListener('click', () => {
            body.classList.remove('sidebar-open');
            openBtn.classList.remove('hidden');
        });
    </script>
</body>

</html>