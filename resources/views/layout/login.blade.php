<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Presensi SMKN 2 Malang</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body,
        html {
            height: 100%;
            background: linear-gradient(135deg, #ffffff, #f9fafb);
        }

        .container {
            max-width: 900px;
            height: 600px;
            margin: 40px auto;
            display: flex;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(21, 101, 192, 0.15);
            overflow: hidden;
            background: white;
        }

        /* Left side login form */
        .login-side {
            flex: 1;
            padding: 40px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #1565c0;
            font-weight: 600;
            text-decoration: none;
            margin-bottom: 25px;
            user-select: none;
            transition: color 0.3s ease;
        }

        .back-button:hover {
            color: 0 15px 35px rgba(30, 144, 255, 0.3);

        }

        h1 {
            font-size: 2.5rem;
            font-weight: 600;
            color: #1565c0;
            margin-bottom: 25px;
            user-select: none;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .role-indicator {
            color: #1565c0;
            font-weight: 600;
            margin-bottom: 35px;
            font-size: 1.1rem;
            user-select: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .role-indicator i {
            font-size: 1.4rem;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        label {
            font-weight: 600;
            color: #1565c0;
            margin-bottom: 8px;
            display: block;
            user-select: none;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 14px 45px 14px 14px;
            font-size: 1rem;
            border: 1.8px solid #ddd;
            border-radius: 15px;
            box-shadow: inset 0 1px 3px rgb(0 0 0 / 0.05);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #1565c0;
            box-shadow: 0 0 8px rgba(21, 101, 192, 0.3);
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 14px;
            transform: translateY(50%);
            cursor: pointer;
            color: #888;
            font-size: 1.15rem;
            user-select: none;
            transition: color 0.3s ease;
        }

        .toggle-password:hover {
            color: #1565c0;
        }

        button.login-button {
            width: 100%;
            background: #1565c0;
            border: none;
            border-radius: 15px;
            padding: 14px;
            font-weight: 600;
            font-size: 1.1rem;
            color: white;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(21, 101, 192, 0.15);
            transition: background 0.3s ease, box-shadow 0.3s ease;
        }

        button.login-button:hover {
            background: #1e90ff;
            box-shadow: 0 15px 35px rgba(30, 144, 255, 0.3);
        }

        /* Right side image */
        .image-side {
            flex: 1;
            background-image: url('{{ asset('assets/Login-pana.png') }}');
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            filter: brightness(0.85);
            transition: filter 0.3s ease;
        }

        .image-side:hover {
            filter: brightness(1);
        }

        /* Responsive */
        @media (max-width: 900px) {
            .container {
                flex-direction: column;
                height: auto;
                max-width: 400px;
            }

            .image-side {
                height: 180px;
                border-radius: 20px 20px 0 0;
                filter: brightness(1);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-side">
            <a href="/" class="back-button">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>

            <div class="role-indicator">
                <i class="fas fa-user-circle"></i>
                Login sebagai <span id="roleText">{{ ucfirst(request()->query('role', 'Pengguna')) }}</span>
            </div>

            <h1>Login</h1>

            <form action="/check-login" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="role" value="{{ request()->query('role') }}">

                <div class="form-group">
                    @php
                        $role = request()->query('role', 'pengguna');
                    @endphp

                    <label for="nomor_pengenal">
                        @if($role === 'guru')
                            NIP
                        @elseif($role === 'siswa' || $role === 'orangtua')
                            NIS
                        @else
                            NIP / NIS
                        @endif
                    </label>
                    <input type="text" id="nomor_pengenal" name="nomor_pengenal" required autofocus
                        autocomplete="username" />
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password" />
                    <span class="toggle-password" id="togglePassword" title="Tampilkan / sembunyikan password">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>

                <button type="submit" class="login-button">Login</button>
            </form>
        </div>

        <div class="image-side" style="background-image: url('{{ asset('assets/Login-pana.png') }}');"
            aria-hidden="true"></div>

    </div>

    <script>
        // Toggle password visibility
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const icon = togglePassword.querySelector('i');

        togglePassword.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
</body>

</html>