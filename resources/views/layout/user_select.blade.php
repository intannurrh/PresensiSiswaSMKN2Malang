<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>select user</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1565c0, #b92b27);
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            width: 100%;
            padding: 20px;
        }

        .title {
            text-align: center;
            color: white;
            margin-bottom: 40px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            justify-items: center;
        }

        .card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            width: 100%;
            max-width: 320px;
            text-align: center;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: #333;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .card i {
            font-size: 3em;
            color: #1565c0;
            margin-bottom: 20px;
        }

        .card h2 {
            margin-bottom: 15px;
            color: #333;
        }

        .card p {
            color: #666;
            font-size: 0.9em;
            line-height: 1.5;
        }

        @media (max-width: 768px) {
            .cards {
                grid-template-columns: 1fr;
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