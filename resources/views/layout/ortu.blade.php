<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Orang Tua</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        /* RESET & BASE */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f0f4f8;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* SIDEBAR */
        .sidebar {
            width: 220px;
            background-color: #ffffff;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            padding: 2rem 1rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            transition: transform 0.3s ease;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 999;
        }

        .sidebar.closed {
            transform: translateX(-100%);
        }

        .sidebar a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background-color: #e3f2fd;
        }

        .toggle-sidebar {
            position: fixed;
            top: 1rem;
            left: 1rem;
            background-color: #1565c0;
            color: white;
            border: none;
            padding: 0.5rem;
            border-radius: 50%;
            cursor: pointer;
            z-index: 1000;
        }

        .back-icon {
            position: absolute;
            top: 1rem;
            right: 1rem;
            cursor: pointer;
            font-size: 1.2rem;
            color: #333;
        }

        /* MAIN LAYOUT */
        .container {
            display: flex;
            width: 100%;
        }

        .main-content {
            margin-left: 0;
            transition: margin-left 0.3s ease;
            width: 100%;
        }

        .sidebar:not(.closed)~.main-content {
            margin-left: 220px;
            width: calc(100% - 220px);
        }

        /* HEADER */
        header {
            background: linear-gradient(to right, #2196f3, #00bcd4);
            color: white;
            padding: 2rem 1rem;
            text-align: center;
        }

        header h1 {
            font-size: 2rem;
            font-weight: 600;
        }

        .dashboard-title {
            text-align: center;
            font-size: 2rem;
            font-weight: 600;
            margin: 2rem 0;
        }

        /* CARD SECTION */
        .cards {
            display: flex;
            justify-content: center;
            gap: 2rem;
            padding: 2rem;
            flex-wrap: wrap;
        }

        .card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 250px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card i {
            font-size: 2.5rem;
            color: #3f51b5;
            margin-bottom: 1rem;
        }

        .card h2 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .card p {
            font-size: 0.95rem;
            color: #555;
        }

        /* LAPORAN KOTAK */
        .laporan-cards {
            display: flex;
            gap: 1rem;
            margin: 1rem auto 2rem;
            justify-content: center;
            flex-wrap: wrap;
            max-width: 1000px;
        }

        .laporan-card {
            background-color: white;
            border-left: 6px solid #2196f3;
            border-radius: 0.5rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            padding: 1rem 1.5rem;
            flex: 1 1 200px;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .laporan-card i {
            font-size: 1.8rem;
            color: #2196f3;
        }

        .laporan-card.hadir {
            border-left-color: #4caf50;
        }

        .laporan-card.tidak-hadir {
            border-left-color: #f44336;
        }

        .laporan-card.telat {
            border-left-color: #ff9800;
        }

        /* REKAP BUTTON */
        .rekap-button {
            text-align: center;
            margin-top: 2rem;
        }

        .rekap-button a {
            background: #2196f3;
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            transition: background 0.3s;
        }

        .rekap-button a:hover {
            background: #1976d2;
        }

        /* FOOTER */
        footer {
            text-align: center;
            padding: 1rem;
            color: #777;
            font-size: 0.9rem;
            background-color: #1565c0;
            color: white;
            margin-top: auto;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
            }

            .sidebar:not(.closed)~.main-content {
                margin-left: 0;
                width: 100%;
            }

            .cards {
                flex-direction: column;
                align-items: center;
            }

            .laporan-cards {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        {{-- sidebar --}}
        @include('part.sidebar')


        <div class="main-content" id="mainContent">
            {{-- header --}}
            @include('part.header')

            <!-- Dashboard Section -->

            @yield('content')

            {{-- footer --}}
            @include('part.footer')

        </div>
    </div>
    <script>

        document.addEventListener('DOMContentLoaded', () => {
            const sidebarLinks = document.querySelectorAll('.sidebar a');
            const sections = document.querySelectorAll('.section');
            const toggleBtn = document.querySelector('.toggle-sidebar');
            const sidebar = document.querySelector('.sidebar');

            // Toggle Sidebar
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('closed');
            });

            // Navigasi antar halaman
            sidebarLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const target = link.getAttribute('data-target');
                    sections.forEach(section => {
                        section.style.display = section.id === target ? 'block' : 'none';
                    });

                    // Tambah class active pada link yang dipilih
                    sidebarLinks.forEach(l => l.classList.remove('active'));
                    link.classList.add('active');
                });
            });
        });

    </script>
</body>

</html>