<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pendaftaran Siswa</title>
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

    form {
      background: white;
      max-width: 500px;
      margin: 3rem auto;
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    form h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: #333;
    }

    .form-group {
      margin-bottom: 1.2rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 600;
      color: #444;
    }

    .form-group input, .form-group select {
      width: 100%;
      padding: 0.8rem;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 1rem;
    }

    button {
      width: 100%;
      padding: 0.9rem;
      border: none;
      border-radius: 8px;
      background-color: #2196f3;
      color: white;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #1976d2;
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
    <h1>Pendaftaran Data Siswa</h1>
  </header>

  <form>
    <h2>Formulir Pendaftaran</h2>
    <div class="form-group">
      <label for="nama">Nama Lengkap</label>
      <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required />
    </div>
    <div class="form-group">
      <label for="nis">NIS</label>
      <input type="text" id="nis" name="nis" placeholder="Masukkan NIS" required />
    </div>
    <div class="form-group">
      <label for="kelas">Kelas</label>
      <input type="text" id="kelas" name="kelas" placeholder="Masukkan kelas" required />
    </div>
    <div class="form-group">
      <label for="foto">Unggah Foto Wajah</label>
      <input type="file" id="foto" name="foto" accept="image/*" required />
    </div>
    <button type="submit">Daftar</button>
  </form>

  <footer>© 2025 Sistem Presensi Sekolah. All rights reserved.</footer>
</body>
</html>