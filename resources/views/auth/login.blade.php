<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Catering</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            background: url('https://images.unsplash.com/photo-1504674900247-0877df9cc836') no-repeat center;
            background-size: cover;
        }

        .overlay {
            background: rgba(0,0,0,0.75);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            display: flex;
            width: 950px; /* 🔥 dari 700 → 950 */
            max-width: 95%;
            border-radius: 20px;
            overflow: hidden;
            backdrop-filter: blur(12px);
            background: rgba(0,0,0,0.55);
            box-shadow: 0 15px 50px rgba(0,0,0,0.7);
        }

        .form-side {
            width: 50%;
            padding: 30px;
            color: white;
        }

        .form-side {
            width: 50%;
            padding: 40px; /* dari 30 → 40 */
        }

        .image-side {
            width: 50%;
            min-height: 450px; /* 🔥 biar tinggi */
        }

        h3 {
            font-size: 26px;
        }

        .form-control {
            padding: 12px;
            font-size: 15px;
        }

        .overlay {
            padding: 20px;
        }

        .btn-login {
            padding: 12px;
            font-size: 16px;
        }

        .image-side {
            width: 50%;
            background: url('https://images.unsplash.com/photo-1546069901-ba9599a7e63c') no-repeat center;
            background-size: cover;
        }

        .form-control {
            margin-bottom: 15px;
            border-radius: 8px;
            padding: 10px;
        }

        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
        }

        .btn-login {
            background: linear-gradient(45deg, #28a745, #20c997);
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-login:hover {
            transform: scale(1.05);
        }

        .register-link {
            margin-top: 10px;
        }

        .register-link a {
            color: #20c997;
            font-weight: bold;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        h3 {
            color: #20c997;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* RESPONSIVE */
        @media(max-width: 768px){
            .login-card {
                flex-direction: column;
                width: 90%;
            }

            .image-side {
                height: 200px;
                width: 100%;
            }

            .form-side {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="overlay">

    <div class="login-card">

        <!-- FORM -->
        <div class="form-side">
            <h3>Login</h3>
            <p>Masuk untuk mulai pesan makanan</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input type="email" name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="Email" required>

                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <input type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password" required>

                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <button class="btn btn-login w-100">Login</button>

                <div class="register-link">
                    Belum punya akun?
                    <a href="{{ route('register') }}">Register</a>
                </div>
            </form>
        </div>

        <!-- IMAGE -->
        <div class="image-side"></div>

    </div>

</div>

</body>
</html>