<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Presensi SMKN 2 Malang</title>
    <!-- Fonts & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-light shadow" style="width: 250px; height: 100vh;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <span class="fs-4">Admin Panel</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('admin.guru.index') }}" class="nav-link text-dark">
                    👨‍🏫 Guru
                </a>
            </li>
            <li>
                <a href="{{ route('admin.ortu.index') }}" class="nav-link text-dark">
                    👪 Orang Tua
                </a>
            </li>
            <li>
                <a href="{{ route('admin.siswa.index') }}" class="nav-link text-dark">
                    🎓 Siswa
                </a>
            </li>
            <li>
                <a href="{{ route('admin.akun.index') }}" class="nav-link text-dark">
                    ➕ Tambah Akun
                </a>
            </li>
            <li>
                <a href="{{ route('admin.presensi.index') }}" class="nav-link text-dark">
                    📝 Presensi
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pengumuman.index') }}" class="nav-link text-dark">
                    📢 Pengumuman
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://via.placeholder.com/32" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>Admin</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser">
                <li><a class="dropdown-item" href="#">Pengaturan</a></li>
                <li><a class="dropdown-item" href="#">Profil</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="{{ route('logout') }}">Keluar</a></li>
            </ul>
        </div>
    </div>

    <div class="content">
        @yield('content')
    </div>
</body>

</html>