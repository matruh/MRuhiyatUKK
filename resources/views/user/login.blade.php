<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpustakaan Wikrama</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background-image: url('img/librarybg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            width: 100%;
            padding: 15px;
            margin-top: 60px; /* Adjust margin to clear the navbar */
        }
        .card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        .card-header {
            background-color: #337ab7;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            font-size: 1.5rem;
            border-bottom: none;
        }
        .card-body {
            padding: 25px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 5px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .form-control:focus {
            border-color: #337ab7;
            box-shadow: 0 0 8px rgba(51, 122, 183, 0.5);
        }
        .input-group-text {
            background-color: #fff;
            border-left: none;
            border-radius: 0 5px 5px 0;
        }
        .btn-primary {
            background-color: #337ab7;
            border-color: #337ab7;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s, border-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #23527c;
            border-color: #23527c;
        }
        .text-center a {
            color: #337ab7;
            transition: color 0.3s;
        }
        .text-center a:hover {
            color: #23527c;
            text-decoration: underline;
        }
        .fa-eye, .fa-eye-slash {
            cursor: pointer;
        }
        /* Custom Navbar Styling */
        .navbar {
            background-color: #343a40;
            color: #ffffff;
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        .navbar-brand {
            color: #ffffff;
            font-size: 1.75rem;
            font-weight: bold;
        }
        .navbar-nav .nav-link {
            color: #ffffff;
            font-size: 1rem;
            padding: 0.5rem 1rem;
        }
        .navbar-nav .nav-link:hover {
            color: #f0f0f0;
        }
        .search-form {
            flex-grow: 1;
            margin: 0 20px;
        }
        @media (max-width: 768px) {
            .search-form {
                width: 100%;
                order: 1;
            }
            .navbar-nav {
                flex-direction: column;
                align-items: center;
                order: 2;
            }
        }
    </style>
</head>
<body>
    {{-- <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Library Wikrama</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> --}}

    <div class="container">
        <div class="card">
            <div class="card-header">Login Perpustakaan Digital</div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="font-weight-bold">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password" class="font-weight-bold">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" placeholder="password must be at least 8 characters" name="password" required>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login   <i class="fa-solid fa-right-to-bracket"></i></button>
                </form>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('register') }}" class="text-decoration-none">Belum Memiliki Akun? Daftar Disini</a>
            </div>
            <div class="text-center mt-3 mb-3">
                {{-- <a href="{{ route('index') }}" class="text-decoration-none">Enter as guest</a> <i class="fa-solid fa-user"></i> --}}
            </div>
        </div>
    </div>

    <!-- Link ke Bootstrap JS atau JS yang diperlukan -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Custom Script -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function (e) {
            const passwordField = document.getElementById('password');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Toggle icon class
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
