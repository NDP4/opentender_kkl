<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
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
        }
        .header h1 {
            margin: 0;
        }
        .content {
            padding: 20px;
            background-color: #f9fafb;
        }
        .footer {
            text-align: center;
            padding: 20px;
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

            <h3>{{ $announcement->title }}</h3>

            <div style="margin: 20px 0;">
                <p>Terima kasih atas partisipasi Anda dalam proses tender KKL D3 TI UDINUS. Setelah melalui proses evaluasi yang menyeluruh, dengan berat hati kami informasikan bahwa biro perjalanan Anda belum terpilih sebagai pemenang tender KKL.</p>

                <p>Kami sangat menghargai waktu dan upaya yang telah Anda berikan selama proses tender ini.</p>

                {!! nl2br(e($announcement->content)) !!}
            </div>

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
