<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Orang Tua</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

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

        /* Background overlay */
        #modalOverlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            /* lebih gelap & transparan */
            z-index: 2000;
            justify-content: center;
            align-items: center;
            padding: 1rem;
        }

        /* Tampilkan modal */
        #modalOverlay.active {
            display: flex;
        }

        /* Container modal */
        #modalOverlay>div {
            background: #fff;
            padding: 2rem 2.5rem;
            border-radius: 15px;
            width: 360px;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
            position: relative;
            font-family: 'Poppins', sans-serif;
            color: #333;
            transition: transform 0.3s ease;
            transform: translateY(0);
        }

        /* Title modal */
        #modalTitle {
            margin-top: 0;
            margin-bottom: 1.5rem;
            font-size: 1.6rem;
            font-weight: 700;
            color: #1565c0;
            text-align: center;
            letter-spacing: 0.05em;
        }

        /* Close button */
        #closeModalBtn {
            position: absolute;
            top: 15px;
            right: 20px;
            background: none;
            border: none;
            font-size: 28px;
            line-height: 1;
            cursor: pointer;
            color: #888;
            transition: color 0.2s ease;
        }

        #closeModalBtn:hover {
            color: #1565c0;
        }

        /* Konten tiap data */
        #modalContent>div {
            background: #f3f6fb;
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 1rem;
            box-shadow: inset 0 0 8px rgba(21, 101, 192, 0.1);
            transition: background-color 0.3s ease;
            cursor: default;
        }

        #modalContent>div:hover {
            background: #e3f2fd;
        }

        /* Label teks tebal */
        #modalContent strong {
            color: #0d47a1;
        }

        /* Responsive modal width (optional) */
        @media (max-width: 400px) {
            #modalOverlay>div {
                width: 90%;
                padding: 1.5rem;
            }
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
    <header>
        <button id="openSidebarBtn" class="header-toggle"><i class="fas fa-bars"></i></button>
        <div class="header-title">Dashboard Orang Tua</div>
        <button class="account-icon-btn" id="profileBtn" title="Profil Akun">
            <i class="fas fa-user-circle"></i>
        </button>

        <form id="logoutForm" method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="account-icon-btn" title="Logout" style="margin-left: 10px;">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </form>
    </header>

    <!-- Main -->
    <main>
        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} Sistem Monitoring Kehadiran
    </footer>

    <!-- Modal Popup -->
    <div id="modalOverlay" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div>
            <button id="closeModalBtn" aria-label="Tutup Modal">&times;</button>
            <h3 id="modalTitle">Data Orang Tua</h3>
            <div id="modalContent">
                <!-- Data akan muncul di sini -->
            </div>
        </div>
    </div>

    <script>
        // Sidebar toggle
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

        // Fetch dan tampilkan modal data orang tua
        document.getElementById('profileBtn').addEventListener('click', function () {
            fetch('/ortu/data-orang-tua')
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    const modalContent = document.getElementById('modalContent');
                    modalContent.innerHTML = '';

                    if (data.length > 0) {
                        data.forEach(item => {
                            modalContent.innerHTML += `
                                <div>
                                    <strong>Nama Orang Tua:</strong> ${item.nama_orangtua}<br>
                                    <strong>Nama Siswa:</strong> ${item.nama_siswa}
                                </div>
                            `;
                        });
                    } else {
                        modalContent.innerHTML = '<p>Data tidak ditemukan.</p>';
                    }

                    document.getElementById('modalOverlay').classList.add('active');
                })
                .catch(error => {
                    console.error('Gagal mengambil data:', error);
                    alert('Gagal mengambil data orang tua.');
                });
        });

        // Tutup modal dengan tombol ×
        document.getElementById('closeModalBtn').addEventListener('click', function () {
            document.getElementById('modalOverlay').classList.remove('active');
        });

        // Tutup modal jika klik di luar konten modal
        document.getElementById('modalOverlay').addEventListener('click', function (e) {
            if (e.target === this) {
                this.classList.remove('active');
            }
        });
    </script>
</body>

</html>