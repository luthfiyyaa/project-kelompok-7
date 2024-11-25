<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guestbook</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        /* Reset and Base Styles */
        body {
            font-family: "Montserrat", serif;
            text-align: center;
            background-color: #ffffff;
            color: #000000;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            
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
        .user-info {
            background-color: #f5f5f5;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: left;
        }
        h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 30px;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
        }
        label {
            font-size: 18px;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        textarea {
            height: 150px;
            resize: vertical;
        }
        .attachment {
            display: flex;
            align-items: center;
            width: 100%;
            margin-bottom: 20px;
        }
        .attachment input[type="file"] {
            flex: 1;
            padding: 10px;
        }
        .submit-button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .submit-button:hover {
            background-color: #555;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
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
        <div class="user-info">
            <p><strong>Guest Code:</strong> {{ session('kode_guest') }}</p>
            <p><strong>Name:</strong> {{ session('nama_guest') }}</p>
        </div>

        <h1>GUESTBOOK</h1>
        <h2>Send Your Message</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('pesan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="code_guest" value="{{ session('kode_guest') }}">
            
            <label for="isi">Message</label>
            <textarea id="isi" 
                      name="isi" 
                      placeholder="Fill out your message here!" 
                      required>{{ old('isi') }}</textarea>
            @error('isi')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <label for="lampiran">Attachment</label>
            <div class="attachment">
                <input type="file" 
                       id="lampiran" 
                       name="lampiran" 
                       accept="image/*">
            </div>
            @error('lampiran')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <button type="submit" class="submit-button">Send Message</button>
        </form>
    </div>
</body>
</html>