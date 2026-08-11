<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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

    </style>

</head>

<body>

<div class="d-flex">

    <!-- Sidebar -->
    <div class="sidebar text-white p-3 d-flex flex-column">

        <div>

            <h4>Puskesmas Somagede</h4>

            <p class="small">
                Pembayaran
            </p>

            <hr>

            <ul class="nav flex-column">

                <li class="nav-item">
                    <a href="/pembayaran" class="nav-link">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('pembayaran.index') }}" class="nav-link">
                        Transaksi Pembayaran
                    </a>
                </li>

                <li class="nav-item">
                    <a href="">
                        Daftar Tarif
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('pembayaran.riwayat.index') }}" class="nav-link">
                        Riwayat Pembayaran
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

        <h2>@yield('page-title')</h2>

        <hr>

        @yield('content')

    </div>

</div>

</body>
</html>