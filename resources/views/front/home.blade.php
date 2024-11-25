<!DOCTYPE html>
<html>
<head>
    <title>Guestbook</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Montserrat", serif;
            text-align: center;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            color: #000000;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start; /* Nama di kiri, role di kanan */
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            color: #000000;
        }
        .header i {
            font-size: 24px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
        }
        .welcome {
            font-size: 48px;
            font-weight: bold;
            margin-top: 50px;
            color: #000000;
        }
        .names {
            font-family: 'Great Vibes', cursive;
            font-size: 60px;
            margin: 20px 0;
            text-align: center; /* Nama tetap rata kiri */
            color: #000000;

        }
        .role-selection {
            margin-top: 20px;
            display: flex;
            flex-direction: column; /* Role dibuat vertikal */
            align-items: center;
        }
        .role-selection h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .role-selection button {
            font-size: 18px;
            padding: 10px 20px;
            margin: 10px 0; /* Jarak antar tombol */
            border: none;
            border-radius: 5px;
            background-color:#ccc;
            cursor: pointer;
            width: 200px; /* Ukuran tombol konsisten */
            text-align: center;
        }
        .role-selection button a {
            text-decoration: none;
            color: #000;
            display: block; /* Area tautan mencakup seluruh tombol */
        }
        .role-selection button:hover {
            background-color: #b4b3b3;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="{{ route('front.index') }}"><i class="fas fa-home"></i></a>
        <div class="title">GUESTBOOK</div>
        <!-- Menu Dashboard Dinamis -->
        <a href="{{ session('id_admin') ? route('admin.dashboard') : route('front.dashboard') }}">
            <i class="fas fa-user"></i>
        </a>
    </div>
    <div class="welcome">Welcome!</div>
    <div class="container">
        <div class="names">
            Dhani<br>&<br>Rose
        </div>
        <div class="role-selection">
            <h2>Choose Your Role!</h2>
            <button>
                <a href="{{ route('front.login-guest') }}">Guest</a>
            </button>
            <button>
                <a href="{{ route('front.login-Admin') }}">Admin</a>
            </button>
        </div>
    </div>
</body>
</html>
