<html>
<head>
    <title>Guestbook</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        /* Reset and Base Styles */
        body {
            font-family: "Montserrat", serif;
            text-align: center;
            background-color: #f3ece5;
            margin: 0;
            padding: 0;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #ddd;
        }
        .header i {
            font-size: 24px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            margin-top: 50px;
        }
        .content h1 {
            font-size: 48px;
            font-weight: bold;
            margin: 0;
        }
        .content p {
            font-size: 18px;
            color: #555;
            margin: 20px 0;
        }
        .button {
            margin-top: 30px;
        }
        .button button {
            font-size: 18px;
            padding: 10px 20px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
        }
        .button button:hover {
            background-color: #e0e0e0;
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
    <div class="content">
        <h1>Welcome, {{ session('nama_guest') }}</h1>
        <p>Send message to the bride and groom!<br>Congratulate them and share your best moment!</p>
        <div class="button">
            <button> <a href="pesan-tamu.php">send message</a>
        </div>
    </div>
</body>
</html> 
