<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        body {
            margin: 0;
            background: #f8f9fa;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;

            width: 250px;
            height: 100vh;

            background: linear-gradient(180deg,
                    #0d6efd 0%,
                    #0b5ed7 100%);

            color: white;
            overflow-y: auto;
            z-index: 1000;
        }

        .logo {
            font-weight: 700;
            padding: 20px 0;
        }

        .sidebar .nav-link {
            color: white;
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 10px;
            transition: .3s;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, .2);
            color: white;
        }

        .active-menu {
            background: white;
            color: #0d6efd !important;
            font-weight: 600;
        }

        /* CONTENT */
        .main-content {
            margin-left: 250px;
            min-height: 100vh;
        }

        .navbar {
            background: white !important;
        }

        @media (max-width: 768px) {

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>

</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">

        <h4 class="text-center logo">
            🎓 SIAKAD
        </h4>

        <hr class="text-white">

        <ul class="nav flex-column mt-3">

            <li class="nav-item">
                <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active-menu' : '' }}">
                    <i class="bi bi-house-door-fill"></i>
                    Beranda
                </a>
            </li>

            <li class="nav-item">
                <a href="/data-akademik" class="nav-link {{ request()->is('data-akademik') ? 'active-menu' : '' }}">
                    <i class="bi bi-table"></i>
                    Data Akademik
                </a>
            </li>

            <li class="nav-item">
                <a href="/input-data" class="nav-link {{ request()->is('input-data') ? 'active-menu' : '' }}">
                    <i class="bi bi-pencil-square"></i>
                    Input Data
                </a>
            </li>

            <li class="nav-item mt-5">
                <a href="/logout" class="nav-link text-warning">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </a>
            </li>

        </ul>

    </div>

    <!-- CONTENT -->
    <div class="main-content">

        <nav class="navbar shadow-sm">

            <div class="container-fluid">

                <span class="navbar-brand mb-0 h1">
                    Dashboard Admin
                </span>

            </div>

        </nav>

        <div class="p-4">

            @yield('content')

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
