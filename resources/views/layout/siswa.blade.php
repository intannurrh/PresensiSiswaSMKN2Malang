<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title') - Siswa SMKN 2 Malang</title>

    <!-- Fonts & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

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
            /* samakan dengan guru */
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

        /* MAIN CONTENT */
        main, .container.py-4 {
            padding: 2rem 1.5rem;
        }
    </style>
</head>

<body>

    <!-- NAVBAR HEADER -->
    <nav class="navbar">
    @if (in_array(Route::currentRouteName(), ['siswa.profile', 'siswa.presensi']))
        <a href="{{ route('siswa.dashboard') }}" class="btn btn-light shadow-sm" style="border-radius:50%; padding: 0.375rem 0.5rem; margin-right:1rem;">
            <i class="bi bi-arrow-left fs-4 text-primary"></i>
        </a>
        @endif
        <a href="#" class="navbar-brand">Presensi SMKN 2 Malang</a>

        <div class="dropdown ms-auto">
            <a class="btn btn-light shadow-sm btn-circle d-flex align-items-center justify-content-center" href="#"
                role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle fs-4 text-primary"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="dropdownMenuLink">
                <li>
                    <a class="dropdown-item" href="{{ route('siswa.profile') }}">
                        <i class="bi bi-person-lines-fill me-2"></i>Profil Siswa
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

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>
