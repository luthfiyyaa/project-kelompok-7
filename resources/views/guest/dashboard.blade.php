<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guestbook Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Reset and Base Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            color: #000000;
            text-align: left;
            margin: 0;
            padding: 0;
        }

        /* Layout Components */
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
            text-align: left;
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

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
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
            background-color: #f5f7f6;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            width: 100%;
            box-sizing: border-box;
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
        <i class="fas fa-user-circle"></i>
        <div class="profile-info">
            <h2>Profile</h2>
            <div class="info">{{ session('nama_guest') ?? 'Guest' }}</div>
            <div class="info">{{ session('alamat') ?? 'No address' }}</div>
        </div>
    </div>

    <div class="container">
        <!-- In your existing blade file -->
    <div class="messages-section">
        @forelse ($pesan as $item)    
            <div class="message-thread" id="message-{{ $item->id_pesan }}">
                <div class="message-actions">
                    <a href="{{ route('guest.edit-message', $item->id_pesan) }}" class="btn btn-edit">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('guest.delete-message', $item->id_pesan) }}" 
                        method="POST" 
                        style="display: inline;"
                        onsubmit="return confirm('Are you sure you want to delete this message?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>

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
                                alt="Message attachment">
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
                        </div>
                    @endif
                </div>
                <!-- Replies section remains the same -->
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