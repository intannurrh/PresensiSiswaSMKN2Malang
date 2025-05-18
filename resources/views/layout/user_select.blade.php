<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Presensi SMKN 2 Malang</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <style>
        /* Reset & font */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Body and background */
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fff;
            padding: 40px 20px;
        }

        /* Container */
        .container {
            max-width: 900px;
            width: 100%;
            padding: 20px;
            text-align: center;
        }

        /* Title */
        .title {
            font-weight: 600;
            font-size: 2.8rem;
            margin-bottom: 60px;
            color: #222;
            letter-spacing: 0.05em;
        }

        /* Cards grid */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 36px;
            justify-items: center;
        }

        /* Card styling */
        .card {
            background: #fff;
            border: 1.8px solid #d1d5db; /* soft gray border */
            border-radius: 14px;
            padding: 36px 28px;
            max-width: 300px;
            width: 100%;
            text-decoration: none;
            color: #222;
            font-weight: 600;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 18px;
            cursor: pointer;
        }

        /* Hover effect */
        .card:hover {
            border-color: #3b82f6; /* blue-500 */
            box-shadow: 0 12px 30px rgba(59, 130, 246, 0.2);
            color: #3b82f6;
            transform: translateY(-6px);
        }

        /* Icon */
        .card i {
            font-size: 4.2rem;
            color: #6b7280; /* gray-500 */
            transition: color 0.3s ease;
        }

        .card:hover i {
            color: #3b82f6;
        }

        /* Card title */
        .card h2 {
            font-size: 1.65rem;
            letter-spacing: 0.03em;
        }

        /* Card description */
        .card p {
            font-weight: 400;
            font-size: 1rem;
            line-height: 1.5;
            color: #4b5563; /* gray-700 */
            letter-spacing: 0.02em;
        }

        /* Responsive for smaller screens */
        @media (max-width: 720px) {
            .cards {
                grid-template-columns: 1fr;
                gap: 28px;
            }

            .title {
                font-size: 2.2rem;
                margin-bottom: 40px;
            }

            .card {
                max-width: 100%;
                padding: 30px 25px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="title">Selamat Datang di Presensi SMKN 2 Malang</h1>
        <div class="cards">
            <a href="/login?role=guru" class="card">
                <i class="fas fa-chalkboard-teacher"></i>
                <h2>Guru</h2>
                <p>Akses sistem untuk mengelola kelas dan kehadiran siswa</p>
            </a>
            <a href="/login?role=siswa" class="card">
                <i class="fas fa-user-graduate"></i>
                <h2>Siswa</h2>
                <p>Akses sistem ini untuk Presensi dan Pengumuman Sekolah</p>
            </a>
            <a href="/login?role=orangtua" class="card">
                <i class="fas fa-users"></i>
                <h2>Orang Tua</h2>
                <p>Pantau aktivitas anak Anda</p>
            </a>
        </div>
    </div>
</body>

</html>
