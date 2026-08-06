<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') — Admin Puskesmas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6fb; }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #102347;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .sidebar .brand {
            padding: 20px 20px 10px;
            border-bottom: 1px solid #1e3a6e;
        }

        .sidebar .brand h5 {
            color: #fff;
            margin: 0;
            font-weight: 700;
            font-size: 1rem;
        }

        .sidebar .brand small {
            color: #8aafd4;
            font-size: 0.75rem;
        }

        .sidebar .nav-link {
            color: #D6E4F0;
            border-radius: 8px;
            padding: 10px 16px;
            margin-bottom: 2px;
            transition: .2s;
            font-size: 0.9rem;
        }

        .sidebar .nav-link:hover {
            background: #18315D;
            color: #fff;
        }

        .sidebar .nav-link.active {
            background: #2F80ED;
            color: #fff;
            font-weight: 600;
        }

        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
        }

        .main-content {
            margin-left: 250px;
            padding: 28px 32px;
            min-height: 100vh;
        }

        .page-header {
            margin-bottom: 24px;
        }

        .page-header h2 {
            font-weight: 700;
            color: #1a2e4a;
            font-size: 1.4rem;
        }

        .stat-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,.07);
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid #eef0f4;
            border-radius: 12px 12px 0 0 !important;
            padding: 16px 20px;
        }

        .table th {
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: .5px;
            font-weight: 600;
        }

        .badge-role {
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 20px;
        }
    </style>
</head>
<body>

<div class="sidebar p-3">
    <div class="brand mb-3">
        <h5><i class="fas fa-hospital-alt me-2"></i>Puskesmas</h5>
        <small>Somagede — Panel Admin</small>
    </div>

    <ul class="nav flex-column flex-grow-1">
        <li class="nav-item">
            <a href="{{ route('admin.index') }}"
               class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                <i class="fas fa-chart-pie me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.user.index') }}"
               class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                <i class="fas fa-users-cog me-2"></i> Manajemen User
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.pasien.index') }}"
               class="nav-link {{ request()->routeIs('admin.pasien.*') ? 'active' : '' }}">
                <i class="fas fa-user-injured me-2"></i> Data Pasien
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.obat.index') }}"
               class="nav-link {{ request()->routeIs('admin.obat.*') ? 'active' : '' }}">
                <i class="fas fa-pills me-2"></i> Data Obat
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.tarif.index') }}"
               class="nav-link {{ request()->routeIs('admin.tarif.*') ? 'active' : '' }}">
                <i class="fas fa-receipt me-2"></i> Data Tarif
            </a>
        </li>
    </ul>

    <div class="mt-auto">
        <hr style="border-color:#1e3a6e;">
        <a href="{{ route('logout') }}" class="nav-link text-danger">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </a>
    </div>
</div>

<div class="main-content">
    <div class="page-header d-flex justify-content-between align-items-start">
        <div>
            <h2>@yield('page-title')</h2>
            <div class="text-muted small">
                <i class="fas fa-calendar-alt me-1"></i>
                {{ now()->translatedFormat('l, d F Y') }}
                &nbsp;|&nbsp;
                <i class="fas fa-clock me-1"></i>
                <span id="live-clock"></span> WIB
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function updateClock() {
        document.getElementById('live-clock').textContent =
            new Date().toLocaleTimeString('id-ID', { hour:'2-digit', minute:'2-digit', second:'2-digit' });
    }
    updateClock();
    setInterval(updateClock, 1000);
</script>
</body>
</html>
