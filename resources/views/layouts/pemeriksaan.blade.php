
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>

.sidebar{

    width:240px;

    min-height:100vh;

    background:#102347;

}

.sidebar .nav-link{

    color:#D6E4F0;

    border-radius:10px;

    padding:12px 16px;

    transition:.25s;

}

.sidebar .nav-link:hover{

    background:#18315D;

    color:white;

}

.sidebar .nav-link.active{

    background:#2F80ED;

    color:white;

}

</style>

</head>

<body>

<div class="d-flex">

    <!-- Sidebar -->
<div class="sidebar text-white p-3 d-flex flex-column"
     style="width:250px; min-height:100vh;">

    <div>

        <h4>Puskesmas</h4>

        <hr>

        <ul class="nav flex-column">

            <ul class="nav flex-column mt-3">

    <li class="nav-item mb-2">

        <a href="/pemeriksaan"
        class="nav-link text-white">

            <i class="fas fa-home me-2"></i>

            Dashboard

        </a>

    </li>

    <li class="nav-item mb-2">

        <a href="{{ route('pemeriksaan.awal.index') }}"
        class="nav-link text-white">

            <i class="fas fa-user me-2"></i>

            Pemeriksaan Awal

        </a>

    </li>

    <li class="nav-item mb-2">

        <a href="{{ route('pemeriksaan.poli.index') }}"
        class="nav-link text-white">

            <i class="fas fa-print me-2"></i>

            Pemeriksaaan Poli

        </a>

    </li>

    <li class="nav-item mb-2">

        <a href="{{ route('pendaftaran.daftar.index') }}"
        class="nav-link text-white">

            <i class="fas fa-notes-medical me-2"></i>

            Daftar Kunjungan

        </a>

    </li>

    <li class="nav-item">

        <a href="{{ route('pemeriksaan.riwayat.index') }}"
        class="nav-link text-white">

            <i class="fas fa-history me-2"></i>

            Riwayat Pemeriksaan

        </a>

    </li>

</ul>

        </ul>

    </div>

    <!-- Logout -->
    <div class="mt-auto">

        <hr>

        <a href="{{ route('logout') }}" class="nav-link text-danger">
            Logout
        </a>

    </div>

</div>

    <!-- Content -->
    <div class="flex-grow-1 p-4">

        <h2>@yield('page-title')</h2>

        <hr>

        @yield('content')

    </div>

</div>

</body>
</html>
