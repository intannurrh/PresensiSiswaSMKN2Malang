<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <title>Dashboard Siswa</title>
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
        background-color: #f0f4f8;
      }
    </style>
  </head>
  <body>
    <header>
      <h1>Dashboard Siswa</h1>
      <p>Selamat datang! Cek kehadiran dan riwayatmu di sini</p>
    </header>

    <section class="cards">
      <div class="card">
        <i class="fas fa-user-plus"></i>
        <h2>Pendaftaran Data</h2>
        <p>Daftarkan data wajah dan identitasmu</p>
      </div>
      <div class="card">
        <i class="fas fa-camera"></i>
        <h2>Presensi</h2>
        <p>Mulai presensi dengan Face Recognition</p>
      </div>
      <div class="card">
        <i class="fas fa-clock"></i>
        <h2>Riwayat Presensi</h2>
        <p>Lihat catatan presensimu</p>
      </div>
    </section>

    <footer>
      © 2025 Sistem Presensi Sekolah. All rights reserved.
    </footer>
  </body>
</html>