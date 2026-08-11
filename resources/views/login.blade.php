<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Puskesmas Somagede</title>

    <link rel="stylesheet" href="{{ asset('public/css/login.css') }}">
<script src="{{ asset('public/js/login.js') }}"></script>
</head>
<body>

<div class="login-container">

    <!-- Left Section -->
    <div class="login-left">

        <div class="brand">
            <div class="logo">
                ❤
            </div>

            <div>
                <h3>Puskesmas Somagede</h3>
                <p>Kabupaten Banyumas</p>
            </div>
        </div>

        <div class="hero-content">

            <h1>
                Sistem Informasi
                <br>
                Pelayanan
                <br>
                Rawat Jalan
            </h1>

            <p>
                Platform terintegrasi untuk petugas puskesmas dalam memberikan
                pelayanan rawat jalan yang efisien dan terorganisir.
            </p>

            <ul>
                <li>Pendaftaran & Antrian Digital</li>
                <li>Rekam Medis Elektronik</li>
                <li>Pembayaran Cash & QRIS</li>
                <li>Manajemen Stok Farmasi</li>
            </ul>

        </div>

    </div>

    <!-- Right Section -->
    <div class="login-right">

        <div class="login-card">

            <div class="login-header">

                <div class="logo">
                    ❤
                </div>

                <h2>Masuk ke Sistem</h2>
                <p>Puskesmas Somagede</p>

            </div>

            <form id="loginForm" action="https://puskesomagede.site/login" method="POST">
                @csrf

                <div class="form-group">
                    <label>Email</label>
                    <input
                        type="email"
                        name="email"
                        placeholder="Masukkan email"
                        value="{{ old('email') }}"
                    >
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                    >
                </div>

                <button type="submit" class="btn-login">
                    Masuk
                </button>

            </form>

            <div class="demo-account">

                <h4>Demo Akun</h4>

                <button type="button" onclick="fillLogin('admin@gmail.com','123456')">
                    Administrator
                </button>

                <button type="button" onclick="fillLogin('pendaftaran@gmail.com','123456')">
                    Petugas Pendaftaran
                </button>

                <button type="button" onclick="fillLogin('pemeriksaan@gmail.com','123456')">
                    Petugas Pemeriksaan
                </button>

                <button type="button" onclick="fillLogin('kasir@gmail.com','123456')">
                    Petugas Kasir
                </button>

                <button type="button" onclick="fillLogin('farmasi@gmail.com','123456')">
                    Petugas Farmasi
                </button>

            </div>

        </div>

    </div>

</div>

<script src="{{ asset('js/login.js') }}"></script>

</body>
</html>
