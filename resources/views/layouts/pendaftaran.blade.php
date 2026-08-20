
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

.table-fit {
    width: auto !important;
    table-layout: auto;
}

.table-fit th,
.table-fit td {
    white-space: nowrap;
    vertical-align: middle;
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
<div class="sidebar text-white p-3 d-flex flex-column"
     style="width:250px; min-height:100vh;">

    <div>

        <h4>Puskesmas</h4>

        <hr>

        <ul class="nav flex-column">

            <ul class="nav flex-column mt-3">

    <li class="nav-item mb-2">

        <a href="/pendaftaran"
        class="nav-link text-white">

            <i class="fas fa-home me-2"></i>

            Dashboard

        </a>

    </li>

    <li class="nav-item mb-2">

        <a href="{{ route('antrian.index') }}"
        class="nav-link text-white">

            <i class="fas fa-print me-2"></i>

            Cetak Antrian

        </a>

    </li>

    <li class="nav-item mb-2">

        <a href="{{ route('pendaftaran.daftar.index') }}"
        class="nav-link text-white">

            <i class="fas fa-notes-medical me-2"></i>

            Daftar Kunjungan

        </a>

    </li>

     <li class="nav-item mb-2">

        <a href="{{ route('pasien.index') }}"
        class="nav-link text-white">

            <i class="fas fa-user me-2"></i>

            Data Pasien

        </a>

    </li>

    <li class="nav-item">

        <a href="{{ route('pendaftaran.riwayat.index') }}"
        class="nav-link text-white">

            <i class="fas fa-history me-2"></i>

            Riwayat Pendaftaran

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

    <!-- Isi Halaman -->
    @yield('content')

</div>

<script>

function updateClock() {

    const now = new Date();

    document.getElementById('live-clock').innerHTML =
        now.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });

}

updateClock();

setInterval(updateClock, 1000);

</script>


</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
