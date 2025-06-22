<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Data Mahasiswa</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap & DataTables (hanya bootstrap5.css DataTables yang dipakai) -->
    <link rel="stylesheet" href="{{ asset('assets/assets/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/assets/DataTables-1.13.3/css/dataTables.bootstrap5.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS Fix untuk panah select -->
    <style>
        .dataTables_length select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 140 140' xmlns='http://www.w3.org/2000/svg'%3E%3Cpolygon points='70,100 20,40 120,40' fill='black'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 10px;
            padding-right: 30px;
            padding: 6px 12px;
            font-size: 14px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            background-color: #fff;
        }
    </style>
</head>
<body>
    <div class="d-flex" style="min-height: 100vh;">
        <div class="bg-danger text-white p-3" style="min-height: 220px;">
            <div class="mb-4 text-center">
                <img src="{{ asset('assets/assets/image/logo.png') }}" style="max-width: 180px; height: auto;" alt="Logo">
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="/" class="nav-link text-white">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mahasiswa') }}" class="nav-link text-white">Data Mahasiswa</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link text-white">Logout</a>
                </li>
            </ul>
        </div>

        <div class="flex-fill">
            <nav class="navbar navbar-expand-lg navbar-light bg-light px-4 d-flex justify-content-between">
                <span class="navbar-brand">Sistem Akademik</span>
                <div class="ms-auto">
                    <span class="navbar-text">Selamat Datang, {{ Auth::user()->name }}</span>
                </div>
            </nav>

            <div class="p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('assets/assets/jquery-3.6.1.js')}}"></script>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- DataTables JS -->
    <script src="{{ asset('assets/assets/DataTables-1.13.3/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/assets/DataTables-1.13.3/js/dataTables.bootstrap5.min.js')}}"></script>

    @yield('scripts')
</body>
</html>
