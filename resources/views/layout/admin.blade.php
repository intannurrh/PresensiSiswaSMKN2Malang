<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Superadmin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/superadmin.css') }}">
    <script src="{{ asset('js/superadmin.js') }}" defer></script>
</head>
<body>
    <div class="sidebar">
        <h2>Superadmin</h2>
        <ul>
            <li><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('guru.index') }}">Data Guru</a></li>
            <li><a href="{{ route('siswa.index') }}">Data Siswa</a></li>
            <li><a href="{{ route('orangtua.index') }}">Data Orang Tua</a></li>
            <li><a href="{{ route('kehadiran.index') }}">Data Kehadiran</a></li>
            <li><a href="{{ route('pengumuman.index') }}">Pengumuman</a></li>
        </ul>
    </div>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>
