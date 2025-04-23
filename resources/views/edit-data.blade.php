<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Data Siswa</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
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
      margin-bottom: 0.5rem;
    }

    .form-container {
      background: white;
      border-radius: 1rem;
      padding: 3rem;
      width: 60%;
      max-width: 1000px;
      margin: 2rem auto;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .form-group {
      margin-bottom: 1.8rem;
      display: flex;
      flex-direction: column;
    }

    label {
      font-weight: 600;
      margin-bottom: 0.6rem;
      font-size: 1.1rem;
    }

    input, select {
      padding: 1.2rem;
      font-size: 1.05rem;
      border-radius: 12px;
      border: 1.5px solid #ccc;
      transition: border-color 0.3s ease;
    }

    input:focus, select:focus {
      border-color: #2196f3;
      outline: none;
    }

    button {
      margin-top: 2rem;
      width: 100%;
      padding: 1.2rem;
      background-color: #2196f3;
      color: white;
      border: none;
      border-radius: 12px;
      font-weight: 600;
      font-size: 1.1rem;
      cursor: pointer;
    }

    button:hover {
      background-color: #1976d2;
    }

    footer {
      text-align: center;
      padding: 1rem;
      font-size: 0.9rem;
      color: #777;
      margin-top: auto;
    }
  </style>
</head>
<body>
  <header>
    <h1>Edit Data Siswa</h1>
    <p>Ubah informasi siswa di bawah ini</p>
  </header>
  <div class="form-container">
    <form>
      <div class="form-group">
        <label for="nis">NIS</label>
        <input type="text" id="nis" value="22001" />
      </div>
      <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" id="nama" value="Rafi Ahmad" />
      </div>
      <div class="form-group">
        <label for="kelas">Kelas</label>
        <input type="text" id="kelas" value="10 IPA 1" />
      </div>
      <div class="form-group">
        <label for="jk">Jenis Kelamin</label>
        <select id="jk">
          <option selected>Laki-laki</option>
          <option>Perempuan</option>
        </select>
      </div>
      <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" id="alamat" value="Jl. Pendidikan No. 10" />
      </div>
      <div class="form-group">
        <label for="hp">No. HP Orang Tua</label>
        <input type="text" id="hp" value="08123456789" />
      </div>
      <button type="submit">Simpan Perubahan</button>
    </form>
  </div>
  <footer>© 2025 Sistem Presensi Sekolah.</footer>
</body>
</html>
