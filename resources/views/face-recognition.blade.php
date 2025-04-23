<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Presensi Wajah</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }
    body {
      background: linear-gradient(135deg, #4facfe, #00f2fe);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .container {
      background-color: #fff;
      padding: 2rem 3rem;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      text-align: center;
      max-width: 500px;
      width: 100%;
    }
    h1 {
      font-size: 1.8rem;
      color: #333;
      margin-bottom: 1rem;
    }
    p {
      font-size: 1rem;
      color: #666;
      margin-bottom: 1.5rem;
    }
    video {
      width: 100%;
      border-radius: 12px;
      margin-bottom: 1rem;
    }
    button {
      padding: 0.8rem 2rem;
      background-color: #4facfe;
      color: #fff;
      border: none;
      border-radius: 10px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    button:hover {
      background-color: #3a9bdc;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Presensi Wajah</h1>
    <p>Arahkan wajahmu ke kamera untuk melakukan presensi.</p>
    <video id="video" autoplay playsinline></video>
    <button id="captureBtn">Presensi Sekarang</button>
  </div>

  <script>
    const video = document.getElementById('video');
    const captureBtn = document.getElementById('captureBtn');

    navigator.mediaDevices.getUserMedia({ video: true })
      .then((stream) => {
        video.srcObject = stream;
      })
      .catch((err) => {
        alert("Gagal mengakses kamera: " + err);
      });

    captureBtn.addEventListener('click', () => {
      alert("Presensi wajah berhasil! (simulasi)");
    });
  </script>
</body>
</html>