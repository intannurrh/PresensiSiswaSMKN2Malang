<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
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

        .login-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #666;
            text-decoration: none;
            margin-bottom: 20px;
            transition: color 0.3s;
        }

        .back-button:hover {
            color: #1565c0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1em;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            border-color: #1565c0;
            outline: none;
        }

        .login-button {
            width: 100%;
            padding: 12px;
            background: #1565c0;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.3s;
        }

        .login-button:hover {
            background: #0d47a1;
        }

        .role-indicator {
            text-align: center;
            color: #666;
            margin-bottom: 20px;
            font-size: 0.9em;
        }

        .role-indicator i {
            margin-right: 5px;
            color: #1565c0;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <a href="/user-select" class="back-button">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>

        <div class="role-indicator">
            <i class="fas fa-user-circle"></i>
            Login sebagai <span id="roleText">{{ ucfirst(request()->query('role', 'Pengguna')) }}</span>
        </div>

        <h1>Login</h1>

        <form action="/check-login" method="POST">
            @csrf
            <input type="hidden" name="role" value="{{ request()->query('role') }}">

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="login-button">Login</button>
        </form>
    </div>
</body>
</html>