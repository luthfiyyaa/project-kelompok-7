<html>
<head>
    <title>Guestbook Reply</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Montserrat", serif;
            text-align: center;
            background-color: #f3ece5;
            color: #000000;
        }
        .container {
            max-width: 600px;
            margin: 10px auto;
            padding: 20px;
            background-color: #798466;
            border-radius: 10px;
            color: #f3ece5;
            font-weight: bold;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            color: #B17457;
        }
        .header i {
            font-size: 24px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
        }
        h1 {
            font-size: 24px;
            font-weight: normal;
            margin: 0;
        }
        h2 {
            font-size: 36px;
            font-weight: bold;
            margin: 20px 0;
            color: #798466;
        }
        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 18px;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f0f2f2;
        }
        .form-group textarea {
            height: 150px;
            resize: none;
        }
        .submit-btn {
            display: flex;
            justify-content: flex-end;
        }
        .submit-btn button {
            background-color: #B17457;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .submit-btn button:hover {
            background-color: #845538;
        }
        /* Tambahan style untuk link di dalam button */
        .submit-btn button a {
            color: #ffffff;
            text-decoration: none;
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

    <h2>Reply!</h2>

    <div class="container">
        <form action="{{ route('balasan.store') }}" method="POST">
            @csrf
            {{-- Hidden input untuk code_admin dari session --}}
            <input type="hidden" name="code_admin" value="{{ session('id_admin') }}">
            
            <div class="form-group">
                <label for="reply-to">Reply to</label>
                <input type="text" id="reply-to" value="{{ $pesan->guest->nama }}" readonly>
                {{-- Hidden input untuk pesan_id --}}
                <input type="hidden" name="pesan_id" value="{{ $pesan->id_pesan }}">
            </div>

            {{-- Menampilkan pesan yang dibalas --}}
            <div class="form-group">
                <label>Original Message</label>
                <textarea readonly>{{ $pesan->isi }}</textarea>
            </div>
            
            <div class="form-group">
                <label for="isi_balasan">Your Reply</label>
                <textarea id="isi_balasan" name="isi_balasan" required placeholder="Tulis balasanmu di sini"></textarea>
            </div>

            <div class="submit-btn">
                <button type="submit">Send Reply</button>
            </div>
        </form>
    </div>
</body>
</html>
