<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 30px 20px;
            color: #333333;
        }
        .button {
            display: inline-block;
            background: #2563eb;
            color: #ffffff;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
            transition: background 0.3s;
        }
        .button:hover {
            background: #1e40af;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #666666;
            font-size: 14px;
            border-top: 1px solid #eeeeee;
        }
        .info {
            background: #f0f9ff;
            border-left: 4px solid #2563eb;
            padding: 15px;
            margin: 20px 0;
            font-size: 14px;
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
            <p>Terima kasih telah mendaftar di portal Open Tender KKL D3 TI UDINUS. Untuk melanjutkan proses pendaftaran, silakan verifikasi alamat email Anda dengan mengklik tombol di bawah ini:</p>

            <div style="text-align: center;">
                <a href="{{ $url }}" class="button">Verifikasi Email</a>
            </div>

            <div class="info">
                <p>Jika Anda tidak merasa mendaftar di portal Open Tender KKL D3 TI UDINUS, Anda dapat mengabaikan email ini.</p>
            </div>

            <p>Link verifikasi ini akan kedaluwarsa dalam 60 menit.</p>

            <p>Jika Anda mengalami masalah saat mengklik tombol "Verifikasi Email", salin dan tempel URL berikut ke browser Anda:</p>
            <p style="word-break: break-all; font-size: 14px; color: #666666;">{{ $url }}</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Open Tender KKL D3 TI UDINUS. All rights reserved.</p>
            <p>Jl. Imam Bonjol No.207, Semarang</p>
        </div>
    </div>
</body>
</html>
