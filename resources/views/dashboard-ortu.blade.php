<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Orang Tua</title>
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
      background-color: #f0f4f8;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    header {
      background: linear-gradient(to right, #2196f3, #00bcd4);
      color: white;
      text-align: center;
      padding: 2rem 1rem;
    }

    header h1 {
      font-size: 2rem;
      font-weight: 600;
    }

    header p {
      margin-top: 0.5rem;
      font-size: 1rem;
    }

    .cards {
      display: flex;
      justify-content: center;
      gap: 2rem;
      padding: 3rem 1rem;
      flex-wrap: wrap;
      flex-grow: 1;
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

    footer {
      text-align: center;
      padding: 1rem;
      color: #777;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>
  <header>
    <h1>Dashboard Orang Tua</h1>
    <p>Selamat datang! Pantau kehadiran anak Anda</p>
  </header>

  <section class="cards">
    <div class="card">
      <i class="fas fa-user-check"></i>
      <h2>Presensi Anak</h2>
      <p>Lihat riwayat kehadiran anak Anda</p>
    </div>
    <div class="card">
      <i class="fas fa-chart-bar"></i>
      <h2>Laporan</h2>
      <p>Cek laporan kehadiran harian dan bulanan</p>
    </div>
    <div class="card">
      <i class="fas fa-school"></i>
      <h2>Info Sekolah</h2>
      <p>Informasi dan pengumuman dari sekolah</p>
    </div>
  </section>

  <footer>
    © 2025 Sistem Presensi Sekolah. All rights reserved.
  </footer>
</body>
</html>