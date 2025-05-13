<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 sidebar">
                <h4 class="text-center">Menu</h4>
                <a href="{{ route('siswa.dashboard') }}">Dashboard</a>
                <a href="{{ route('siswa.rekap') }}">Rekap Kehadiran</a>
                <a href="{{ route('siswa.pengumuman') }}">Pengumuman</a>
            </div>
            <div class="col-md-9 p-4">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>