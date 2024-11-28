<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        /* Reset and Base Styles */
        body {
            font-family: "Montserrat", serif;
            background-color: #f3ece5;
            color: #000000;
            text-align: center;
            margin: 0;
            padding: 0;
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
            color: #B17457;
        }
        .header i {
            font-size: 24px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
        }
        h2 {
            font-size: 32px;
            font-weight: bold;
            margin: 20px 0;
            color:#798466;
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
        .message-thread {
            background-color: #798466;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .message-main {
            color: #f3ece5;
            font-weight: bold;
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
    <h2>All Messages</h2>
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
</body>
</html>
