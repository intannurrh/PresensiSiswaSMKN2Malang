<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Dashboard Siswa</title>

    <!-- Fonts & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            background-color: #ffffff;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #ffffff;
            text-align: center;
            padding: 12px 0;
            font-size: 0.9rem;
            color: #6b7280;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
        }

        .btn-circle {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            padding: 0;
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            @if (Route::currentRouteName() == 'siswa.profile')
                <a href="{{ route('siswa.dashboard') }}" class="btn btn-light me-2"
                    style="border-radius:50%;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                    <i class="bi bi-arrow-left fs-4 text-primary"></i>
                </a>
            @endif
            <a class="navbar-brand" href="#">Presensi SMKN 2 Malang</a>
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
                        <!-- Link Logout yang memicu form -->
                        <a class="dropdown-item" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </a>

                        <!-- Form tersembunyi -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="container py-4">
        @yield('content')
        @include('part.footer')
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>