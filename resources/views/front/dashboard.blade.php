<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guestbook Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: "Montserrat", serif;
        }

        body {
            background-color: #f3ece5;
            color: #2f3a27;
            text-align: left;
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
        }

        /* Title Styles */
        h1 {
            font-size: 48px;
            font-weight: bold;
            margin: 20px 0;
        }

        .dashboard-title {
            font-size: 32px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
        }

        /* Profile Card Styles */
        .profile-card {
            background-color: #798466;
            border-radius: 20px;
            padding: 40px;
            margin: 40px auto;
            width: 50%;
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
            color: #F3ece5;
        }

        .profile-info .info {
            background-color: #F3ece5;
            border-radius: 10px;
            padding: 10px 20px;
            margin-bottom: 10px;
            font-size: 18px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 0 20px;
            text-align: left;
            width: 100%;
        }

        label {
            display: block;
            text-align: left;
            margin: 10px 0 5px;
            font-size: 18px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f0f2f1;
            box-sizing: border-box;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        /* Messages Section */
        .messages-section {
            width: 100%;
            margin-bottom: 10px;
        }

        .message-thread {
            background-color: #ABBA7C;
            border-radius: 10px;
            padding: 20px;
            margin: 20px;
            width: 100%;
            box-sizing: border-box;
            font-weight: 500;
        }

        .attachment-container {
            display: flex; /* Menggunakan Flexbox */
            justify-content: center; /* Memposisikan gambar di tengah horizontal */
            align-items: center; /* Memposisikan gambar di tengah vertikal (opsional jika tinggi container terpengaruh) */
        }

        .attachment-container img {
            max-width: 400px;
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin: 10px 0;
        }

        /* Reply Section */
        .replies-container {
            margin-top: 20px;
            padding: 15px;
            background-color: #ffffff;
            border-radius: 10px;
        }

        .reply-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .reply-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .no-replies {
            color: #666;
            text-align: center;
            padding: 20px;
        }

        .create-message-container {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .create-message-btn {
            background-color: #644934;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .create-message-btn:hover {
            background-color: #8b6548;
        }

        .btn {
            background-color: #F3ece5;
            color: black;
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            align-items: center;
            gap: 50px;
            width: auto;
            height: auto;
            transition: background-color 0.3s ease;
            margin: 20px 10px 0 0;
        }

        .btn:hover {
            background-color: #f1dcc7;
        }

        .dashboard-title {
            color: #798466;
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
    
    <div class="dashboard-title">Dashboard Guest</div>
    
    <div class="profile-card">
        <i class="fas fa-user-circle" style="font-size: 150px;"></i>
        <div class="profile-info">
            <h2>Profile</h2>
            <div class="info">{{ session('nama_guest') ?? 'Guest' }}</div>
            <div class="info">{{ session('alamat') ?? 'No address' }}</div>
        </div>
    </div>

    <div class="create-message-container">
        <a href="{{ route('pesan.create') }}" class="create-message-btn">
            <i class="fas fa-plus"></i>
            Create New Message
        </a>
    </div>

    <div class="container">
        <!-- In your existing blade file -->
    <div class="messages-section">
        @forelse ($pesan as $item)    
            <div class="message-thread" id="message-{{ $item->id_pesan }}">
                <div class="message-main">
                    <div class="form-group">
                        <label for="guest_name_{{ $item->id }}">Guest</label>
                        <input type="text" 
                            class="form-control"
                            id="guest_name_{{ $item->id_pesan }}" 
                            value="{{ $item->guest->nama ?? 'Unknown Guest' }}" 
                            readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="message_{{ $item->id_pesan }}">Message</label>
                        <textarea 
                            class="form-control"
                            id="message_{{ $item->id_pesan }}" 
                            readonly
                            rows="4">{{ $item->isi ?? '' }}</textarea>
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
                                Belum ada balasan untuk pesan ini.
                            </div>
                        @endif
                    </div>
                    <div class="message-actions">
                        <a href="{{ route('guest.edit-pesan', $item->id_pesan) }}" class="btn">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('guest.delete-pesan', $item->id_pesan) }}" 
                              method="POST" 
                              style="display: inline;"
                              onsubmit="return confirm('Are you sure you want to delete this message?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
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
</body>
</html>