<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detail Siswa</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
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

    main {
      padding: 2rem;
      flex-grow: 1;
    }

    .detail-card {
      background: white;
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      margin: 0 auto;
    }

    .detail-row {
      margin-bottom: 1rem;
      display: grid;
      grid-template-columns: 150px 1fr;
      gap: 10px;
    }

    .detail-row span:first-child {
      font-weight: 600;
      color: #333;
      text-align: left;
    }

    .detail-row span:last-child {
      color: #555;
      text-align: left;
    }

    footer {
      text-align: center;
      padding: 1rem;
      color: #777;
      font-size: 0.9rem;
    }

    .back-btn {
      display: block;
      margin: 2rem auto 0;
      padding: 0.75rem 2rem;
      background-color: #2196f3;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
    }

    .back-btn:hover {
      background-color: #1976d2;
    }
  </style>
</head>
<body>
  <header>
    <h1>Detail Siswa</h1>
    <p>Informasi lengkap siswa</p>
  </header>

  <main>
    <div class="detail-card">
      <div class="detail-row">
        <span>NIS:</span>
        <span>22001</span>
      </div>
      <div class="detail-row">
        <span>Nama:</span>
        <span>Rafi Ahmad</span>
      </div>
      <div class="detail-row">
        <span>Kelas:</span>
        <span>10 IPA 1</span>
      </div>
      <div class="detail-row">
        <span>Jenis Kelamin:</span>
        <span>Laki-laki</span>
      </div>
      <div class="detail-row">
        <span>Alamat:</span>
        <span>Jl. Pendidikan No. 10</span>
      </div>
      <div class="detail-row">
        <span>No. HP Orang Tua:</span>
        <span>08123456789</span>
      </div>
      <!-- Tambah info lain jika diperlukan -->
    </div>

    <button class="back-btn" onclick="history.back()">Kembali</button>
  </main>

  <footer>
    © 2025 Sistem Presensi Sekolah. All rights reserved.
  </footer>
</body>
</html>