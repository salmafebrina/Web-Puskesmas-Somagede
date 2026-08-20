<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
      
    <style>

        .sidebar{
            width:250px;
            min-height:100vh;
            background:#102347;
        }

        .sidebar .nav-link{
            color:#D6E4F0;
            border-radius:10px;
            padding:12px 16px;
            margin-bottom:8px;
        }

        .sidebar .nav-link:hover{
            background:#18315D;
            color:white;
        }

        .sidebar .nav-link.active{
            background:#2F80ED;
            color:white;
        }

       .user-profile-btn {
    border: none;
    background: transparent;

    display: flex;
    align-items: center;

    padding: 0;
}

.user-profile-btn::after {
    display: none;
}

.user-profile-btn:focus {
    box-shadow: none;
}

.user-icon {
    width: 48px;
    height: 48px;

    border: 1px solid #d1d5db;
    border-radius: 50%;

    background: white;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 20px;
    color: #102347;
}

.dropdown-menu {
    min-width: 150px;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 4px 15px rgba(0,0,0,0.10);
}

.dropdown-item {
    padding: 10px 15px;
}

    </style>

</head>

<body>

<div class="d-flex">

    <!-- Sidebar -->
    <div class="sidebar text-white p-3 d-flex flex-column">

        <div>

            <h4>Puskesmas Somagede</h4>

            <p class="small">
                Farmasi
            </p>

            <hr>

            <ul class="nav flex-column">

                <li class="nav-item">
                    <a href="{{ route('farmasi') }}" class="nav-link">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('obat-masuk.index') }}" class="nav-link">
                        Obat Masuk
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('farmasi.ObatKeluar.index') }}" class="nav-link">
                        Antrian Resep
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('farmasi.riwayat.index') }}" class="nav-link">
                        Riwayat Penyerahan
                    </a>
                </li>

            </ul>

        </div>

        <div class="mt-auto">

            <hr>

            <a href="{{ route('logout') }}" class="nav-link text-danger">
                Logout
            </a>

        </div>

    </div>

    <!-- Content -->
    <div class="flex-grow-1 p-4">
<!-- Header -->
<div class="d-flex justify-content-between align-items-start">

    <!-- Judul -->
    <div>
        
        <h2 class="mb-2">@yield('page-title')</h2>

        <div class="text-muted">

            <span class="me-4">
                📅 {{ now()->translatedFormat('l, d F Y') }}
            </span>

            <span>
                🕒 <span id="live-clock"></span> WIB
            </span>

        </div>

    </div>

    <!-- Informasi User -->
     <div class="d-flex justify-content-end align-items-center mb-3">

    <div class="dropdown">

        <button
            class="user-profile-btn dropdown-toggle"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
        >

            <div class="text-end me-3">

                <div class="fw-semibold">
                    {{ session('username', 'Pengguna') }}
                </div>

                <small class="text-muted">
                    {{ session('role', 'User') }}
                </small>

            </div>

            <div class="user-icon">
                <i class="fas fa-user"></i>
            </div>

        </button>

        <ul class="dropdown-menu dropdown-menu-end">

            <li>
                <a
                    class="dropdown-item text-danger"
                    href="{{ route('logout') }}"
                >
                    <i class="fas fa-sign-out-alt me-2"></i>
                    Logout
                </a>
            </li>

        </ul>
        </div>
</div>

</div>

        

               <hr>

        @yield('content')

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>