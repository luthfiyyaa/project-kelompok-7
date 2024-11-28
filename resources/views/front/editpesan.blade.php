<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Message - Guestbook</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        /* Reset and Base Styles */
        body {
            font-family: "Montserrat", serif;
            background-color: #f3ece5;
            color: #000000;
            margin: 0;
            padding: 0;
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

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #798466;
            border-radius: 10px;
        }

        h1{
            color: #f3ece5;
        }

        .form-group {
            margin-bottom: 10px;
            color: #f3ece5;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            min-height: 150px;
            margin-bottom: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }

        .btn-primary {
            background-color: #B17457;
            color: white;
        }

        .btn-primary:hover { 
            background-color: #845538;
        }

        .btn-secondary {
            background-color: #B17457;
            color: white;
            margin-left: 10px;
        }

        .btn-secondary:hover { 
            background-color: #845538;
        }

        .attachment-preview {
            margin-top: 10px;
            color: #f3ece5;
            margin-bottom: 20px;
        }

        .attachment-preview img {
            max-width: 400px;
            width: 100%;
            height: auto;
            border-radius: 5px;
            margin: 10px 0;
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
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('guest.update-pesan', $pesan->id_pesan) }}" method="POST">
            @csrf
            @method('PUT')

            <h1 style="text-align: center">Edit your Message</h1>
            
            <div class="form-group">
                <label for="message">Message</label>
                <textarea 
                    name="message" 
                    id="message" 
                    rows="6">{{ old('message', $pesan->isi) }}</textarea>
                @error('message')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        
            @if($pesan->lampiran)
                <div class="attachment-preview">
                    <label>Current Attachment</label>
                    <img src="{{ Storage::url($pesan->lampiran) }}" alt="Message attachment">
                </div>
            @endif
        
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Message</button>
                <a href="{{ route('front.dashboard') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
</html>