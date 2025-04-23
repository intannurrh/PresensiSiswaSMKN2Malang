<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rekap Presensi Mingguan</title>
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

    .rekap-container {
      max-width: 900px;
      margin: 3rem auto;
      background: white;
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 2rem;
      color: #333;
    }

    .toolbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
      flex-wrap: wrap;
    }

    .toolbar select, .toolbar button {
      padding: 0.6rem 1rem;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
      margin: 0.5rem 0;
    }

    .toolbar button {
      background-color: #2196f3;
      color: white;
      border: none;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .toolbar button:hover {
      background-color: #1976d2;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 1rem;
      text-align: center;
      border-bottom: 1px solid #ccc;
    }

    th {
      background-color: #2196f3;
      color: white;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    footer {
      margin-top: auto;
      text-align: center;
      padding: 1rem;
      color: #777;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>
  <header>
    <h1>Rekap Presensi Mingguan</h1>
  </header>

  <div class="rekap-container">
    <h2>Minggu Ini</h2>

    <div class="toolbar">
      <select name="kelas" id="kelas">
        <option value="">Pilih Kelas</option>
        <option value="X-IPA-1">X IPA 1</option>
        <option value="X-IPA-2">X IPA 2</option>
        <option value="X-IPS-1">X IPS 1</option>
        <!-- Tambahin kelas lain sesuai data -->
      </select>
      <div>
        <button><i class="fas fa-file-pdf"></i> Download PDF</button>
        <button><i class="fas fa-file-excel"></i> Download Excel</button>
      </div>
    </div>

    <table>
      <thead>
        <tr>
          <th>Nama Siswa</th>
          <th>Sen</th>
          <th>Sel</th>
          <th>Rab</th>
          <th>Kam</th>
          <th>Jum</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Ahmad Fadli</td>
          <td>Hadir</td>
          <td>Hadir</td>
          <td>Izin</td>
          <td>Hadir</td>
          <td>Alpha</td>
        </tr>
        <tr>
          <td>Siti Nurhaliza</td>
          <td>Hadir</td>
          <td>Hadir</td>
          <td>Hadir</td>
          <td>Hadir</td>
          <td>Hadir</td>
        </tr>
      </tbody>
    </table>
  </div>

  <footer>© 2025 Sistem Presensi Sekolah. All rights reserved.</footer>
</body>
</html>