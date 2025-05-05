<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #1a56db;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
        }
        .content {
            padding: 20px;
            background: #f9fafb;
            border-radius: 5px;
            margin-top: 20px;
        }
        .status {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            margin: 10px 0;
        }
        .status-accepted {
            background-color: #dcfce7;
            color: #166534;
        }
        .status-rejected {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            color: #666;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Open Tender KKL D3 TI UDINUS</h1>
        </div>
        <div class="content">
            <h2>Halo {{ $user->name }},</h2>
            <p>Proposal penawaran Anda untuk tender KKL D3 TI UDINUS telah selesai direview.</p>

            <p><strong>Status Proposal:</strong></p>
            <div class="status {{ $status === 'accepted' ? 'status-accepted' : 'status-rejected' }}">
                {{ $status === 'accepted' ? 'Proposal Diterima' : 'Proposal Ditolak' }}
            </div>

            <p><strong>Catatan Review:</strong></p>
            <p>{{ $notes }}</p>

            <p><strong>Detail Proposal:</strong></p>
            <ul>
                <li>Nama Biro: {{ $proposal->nama_biro }}</li>
                <li>Tanggal Submit: {{ $proposal->updated_at->isoFormat('dddd, D MMMM Y HH:mm') }}</li>
            </ul>

            @if($status === 'accepted')
                <p>Selamat! Proposal Anda telah diterima. Tim kami akan menghubungi Anda untuk proses selanjutnya.</p>
            @else
                <p>Mohon maaf proposal Anda belum dapat kami terima. Silakan perhatikan catatan review di atas untuk perbaikan.</p>
            @endif

            <div style="margin-top: 30px">
                <p>Salam,<br>Tim Open Tender KKL D3 TI UDINUS</p>
            </div>
        </div>
        <div class="footer">
            <p>Email ini dikirim secara otomatis, mohon untuk tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html>
