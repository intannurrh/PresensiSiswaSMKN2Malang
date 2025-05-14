<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            font-family: 'Poppins', sans-serif;
            padding-top: 80px;
            padding-bottom: 60px;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 600;
            color: #4facfe;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #fff;
            text-align: center;
            padding: 10px 0;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">MyDashboard</a>
            <div class="dropdown ms-auto">
                <a class="btn btn-light rounded-circle shadow-sm" href="#" role="button" id="dropdownMenuLink"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle fs-4 text-primary"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-gear me-2"></i>Edit
                            Profil</a></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}"><i
                                class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="container">
        @yield('content')
        @include('part.footer')
    </div>
    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>