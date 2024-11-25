<html>
<head>
    <title>Guestbook</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        /* Reset and Base Styles */
        body {
            font-family: "Montserrat", serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            text-align: center;
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
        h1 {
            font-size: 48px;
            font-weight: bold;
            margin: 20px 0;
        }
        label {
            display: block;
            text-align: left;
            margin: 10px 0 5px;
            font-size: 18px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f0f2f1;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
        }
        .welcome {
            font-size: 36px;
            font-weight: bold;
            margin: 20px 0;
        }
        .message-box {
            background-color: #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
            text-align: left;
        }
        .message-box label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .message-box input[type="text"],
        .message-box textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            background-color: #f0f0f0;
        }
        .message-box textarea {
            height: 100px;
        }
        .attachment {
            width: 100%;
            height: 150px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f0f2f1;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
            font-size: 18px;
            color: #888888;
        }
        .reply-button {
            background-color: #d3d3d3;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            transition: background-color 0.3s;
        }
        .reply-button:hover {
            background-color: #636060;
        }
        .no-replies {
            padding: 15px;
            color: #666;
            text-align: center;
            border-top: 1px solid #eee;
            margin-top: 10px;
        }
        .replies-container {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .reply-item {
            padding: 10px;
            background-color: white;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .reply-header {
            color: #666;
            margin-bottom: 5px;
        }
        .reply-content {
            padding: 10px 0;
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
        <div class="welcome">Welcome, {{ session('nama') }}</div>

        <div class="messages-section">
            @forelse ($pesan as $item)    
            <div class="message-thread">
                <div class="message-main">
                    <div class="form-group">
                        <label for="guest_name_{{ $item->id }}">Guest</label>
                        <input type="text" 
                        class="form-control"
                        id="guest_name_{{ $item->id }}" 
                        value="{{ $item->guest->nama ?? 'Unknown Guest' }}" 
                        readonly>
                    </div>
                    <div class="form-group">
                        <label for="message_{{ $item->id }}">Message</label>
                        <textarea 
                        class="form-control"
                        id="message_{{ $item->id }}" 
                        readonly
                        rows="4"
                        >{{ $item->isi ?? '' }}</textarea>
                    </div>
                    
                    @if($item->lampiran)
                        <div class="attachment-container">
                            <img src="{{ Storage::url($item->lampiran) }}" 
                                alt="Message attachment" style="max-width: 400px">
                        </div>
                    @endif
                </div>
                <div class="replies-container">
                    <h4>Balasan:</h4>
                    @if($item->balasan)
                        <div class="reply-item">
                            <div class="reply-header">
                                <span>
                                    <i class="fas fa-user-circle"></i> 
                                    Admin 
                                </span>
                                <span class="timestamp">
                                    - {{ $item->balasan->created_at->format('d M Y H:i') }}
                                </span>
                            </div>
                            <div class="reply-content">
                                {{ $item->balasan->isi_balasan }}
                            </div>
                        </div>
                    @else
                        <div class="no-replies">
                            Belum ada balasan untuk pesan ini
                            <br>
                            <a href="{{ route('balasan.create', $item->id_pesan) }}" 
                                class="reply-button"
                                onclick="return confirm('Apakah Anda yakin ingin membalas pesan ini?')">
                                <i class="fas fa-reply"></i> Reply
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            @empty
                <div class="message-thread">
                    <div class="no-replies">
                        Tidak ada pesan
                    </div>
                </div>
            @endforelse       
        </div>
    </div>
</body>
</html>