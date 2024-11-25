<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guestbook Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        /* Reset and Base Styles */
        body {
            font-family: "Montserrat", serif;
            background-color: #ffffff;
            color: #000000;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
        }
        .header i {
            font-size: 24px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
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
            background-color: #ffffff;
            border: 2px solid #000000;
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
        }
        .dashboard-title {
            font-size: 32px;
            font-weight: bold;
            margin-top: 20px;
        }
        .profile-card {
            background-color: #f5f7f6;
            border-radius: 20px;
            padding: 40px;
            margin: 40px auto;
            width: 60%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-card i {
            font-size: 150px;
            margin-right: 40px;
        }

        .profile-info {
            text-align: center;
        }
        .profile-info h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .profile-info .info {
            background-color: #d3d3d3;
            border-radius: 10px;
            padding: 10px 20px;
            margin-bottom: 10px;
            font-size: 18px;
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
    </header>
    <div class="header">
        <a href="{{ route('front.index') }}"><i class="fas fa-home"></i></a>
        <div class="title">GUESTBOOK</div>
        <!-- Menu Dashboard Dinamis -->
        <a href="{{ session('id_admin') ? route('admin.dashboard') : route('front.dashboard') }}">
            <i class="fas fa-user"></i>
        </a>
    </div>
    
    <div class="dashboard-title">DashBoard!</div>
    <div class="profile-card">
        <i class="fas fa-user-circle" style="font-size: 150px;"></i>
        <div class="profile-info">
            <h2>Profile</h2>
            <div class="info">{{ session('nama_guest') ?? 'Guest' }}</div>
            <div class="info">{{ session('alamat') ?? 'No address' }}</div>
        </div>
    </div>
    <div class="container">
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
                    No messages yet
                </div>
            </div>
            @endforelse
    </div>
    </div>
</div>
</body>
</html>