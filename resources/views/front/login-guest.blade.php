<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guestbook - Dhani & Rose</title>
    
    <!-- External CSS -->
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
            margin: 20px auto;
            padding: 10px;
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

        /* Names Section */
        .names {
            font-family: 'Great Vibes', cursive;
            font-size: 48px;
            margin: 10px 0 40px 0;
            color: #333;
            line-height: 1.4;
        }

        /* Login Box Styles */
        .login-box {
            background-color: #f8f8f8;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            height: 300px;
        }

        .login-box h2 {
            font-size: 24px;
            margin-bottom: 25px;
            color: #333;
            text-align: center;
            margin-top: 30px;
        }

        .login-box input {
            width: 80%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 2px solid #eee;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .login-box input:focus {
            outline: none;
            border-color: #666;
        }

        .login-box button {
            width: 80%;
            padding: 12px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            justify-content: center;
            transition: background-color 0.3s ease;
        }

        .login-box button:hover {
            background-color: #444;
        }

        /* Alert Styles */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .alert-danger {
            background-color: #ffe6e6;
            color: #cc0000;
            border: 1px solid #ffcccc;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }

            .login-box {
                padding: 30px 20px;
            }

            .names {
                font-size: 36px;
            }

            .header .title {
                font-size: 24px;
            }
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

    <div class="container">
        <div class="names">
            Dhani<br>&amp;<br>Rose
        </div>

        <div class="login-box">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('front.guestLogin') }}" method="POST">
                @csrf
                <h2>Log In</h2>
                <input 
                    name="nama" 
                    type="text" 
                    placeholder="Your Name" 
                    required 
                    value="{{ old('nama') }}"
                >
                <input 
                    name="kode_guest" 
                    type="text" 
                    placeholder="Guest/Admin Code" 
                    required 
                    value="{{ old('kode_guest') }}"
                >
                <button type="submit">Log In</button>
            </form>
        </div>
    </div>
</body>
</html>