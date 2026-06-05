<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SIAKAD</title>

    {{-- @vite(['resources/css/app.css']) --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            overflow: hidden;
        }

        .login-container {
            height: 100vh;
        }

        /* LEFT */
        .left-side {
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .left-side img {
            width: 60%;
            max-width: 350px;
        }

        /* RIGHT */
        .right-side {
            background: #0d6efd;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Card */
        .login-card {
            width: 380px;
            background: #fff;
            border-radius: 12px;
            padding: 35px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .15);
            z-index: 2;
        }

        .login-card h2 {
            font-weight: 700;
            color: #222;
        }

        .login-card p {
            color: #777;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .form-control {
            border-radius: 30px;
            height: 50px;
            padding-left: 45px;
        }

        .input-group-text {
            border-radius: 30px 0 0 30px;
            background: white;
            border-right: none;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #0d6efd;
        }

        .btn-login {
            background: #0d6efd;
            color: white;
            border-radius: 30px;
            height: 50px;
            font-weight: 600;
            transition: .3s;
        }

        .btn-login:hover {
            background: #0b5ed7;
            color: white;
        }

        .forgot {
            text-decoration: none;
            color: #666;
            font-size: 13px;
        }

        .forgot:hover {
            color: #0d6efd;
        }

        /* Ornament */
        .circle1 {
            position: absolute;
            width: 300px;
            height: 300px;
            border: 1px solid rgba(255, 255, 255, .3);
            border-radius: 50%;
            bottom: -120px;
            right: -120px;
        }

        .circle2 {
            position: absolute;
            width: 220px;
            height: 220px;
            border: 1px solid rgba(255, 255, 255, .3);
            border-radius: 50%;
            bottom: -80px;
            right: -80px;
        }

        @media(max-width:768px) {

            .left-side {
                display: none;
            }

            .login-card {
                width: 90%;
            }
        }
    </style>

</head>

<body>

    <div class="container-fluid">
        <div class="row login-container">

            <!-- LEFT -->
            <div class="col-md-6 left-side">

                <!-- Ganti dengan ilustrasi Anda -->
                <img src="{{ asset('image/logosekolah.png') }}" alt="Login">

            </div>

            <!-- RIGHT -->
            <div class="col-md-6 right-side">

                <div class="login-card">

                    <h2>Hello!</h2>

                    <p>Login Admin SIAKAD</p>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="/login" method="POST">

                        @csrf

                        <div class="mb-3">

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-person"></i>
                                </span>

                                <input type="text" class="form-control" name="username" placeholder="Username"
                                    required>

                            </div>

                        </div>

                        <div class="mb-4">

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-lock"></i>
                                </span>

                                <input type="password" class="form-control" name="password" placeholder="Password"
                                    required>

                            </div>

                        </div>

                        <button type="submit" class="btn btn-login w-100">
                            Login
                        </button>

                        <div class="mt-3">

                            <a href="#" class="forgot">
                                Forgot Password?
                            </a>

                        </div>

                    </form>

                </div>

                <div class="circle1"></div>
                <div class="circle2"></div>

            </div>

        </div>
    </div>

</body>

</html>
