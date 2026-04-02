<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Catering</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            background: url('https://images.unsplash.com/photo-1490645935967-10de6ba17061') no-repeat center;
            background-size: cover;
        }

        .overlay {
            background: rgba(0,0,0,0.75);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .register-card {
            display: flex;
            width: 1000px;
            max-width: 95%;
            border-radius: 20px;
            overflow: hidden;
            backdrop-filter: blur(12px);
            background: rgba(0,0,0,0.55);
            box-shadow: 0 15px 50px rgba(0,0,0,0.7);
            animation: fadeIn 0.8s ease;
        }

        .form-side {
            width: 50%;
            padding: 40px;
            color: white;
        }

        .image-side {
            width: 50%;
            background: url('https://images.unsplash.com/photo-1546069901-ba9599a7e63c') no-repeat center;
            background-size: cover;
        }

        h3 {
            color: #20c997;
            font-size: 26px;
        }

        .form-control {
            margin-bottom: 15px;
            border-radius: 8px;
            padding: 12px;
        }

        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
        }

        .btn-register {
            background: linear-gradient(45deg, #28a745, #20c997);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: bold;
            color: white;
            transition: 0.3s;
        }

        .btn-register:hover {
            transform: scale(1.05);
        }

        .login-link {
            margin-top: 10px;
        }

        .login-link a {
            color: #20c997;
            font-weight: bold;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
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
            .register-card {
                flex-direction: column;
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

    <div class="register-card">

        <!-- FORM -->
        <div class="form-side">
            <h3>Register</h3>
            <p>Buat akun untuk mulai pesan makanan</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Nama --}}
                <input type="text" name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="Nama" required>

                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                {{-- Email --}}
                <input type="email" name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="Email" required>

                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                {{-- Password --}}
                <input type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password" required>

                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                {{-- Konfirmasi --}}
                <input type="password" name="password_confirmation"
                    class="form-control"
                    placeholder="Konfirmasi Password" required>

                <button class="btn btn-register w-100">Register</button>

                <div class="login-link">
                    Sudah punya akun?
                    <a href="{{ route('login') }}">Login</a>
                </div>

            </form>
        </div>

        <!-- IMAGE -->
        <div class="image-side"></div>

    </div>

</div>

</body>
</html>