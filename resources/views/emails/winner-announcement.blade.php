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
            background-color: #047857;
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
            <h2>Selamat {{ $user->name }}!</h2>

            <h3>{{ $announcement->title }}</h3>

            <div style="margin: 20px 0;">
                <p>Dengan senang hati kami informasikan bahwa biro perjalanan Anda telah terpilih sebagai <strong>pemenang tender KKL D3 TI UDINUS</strong>. Keputusan ini diambil setelah melalui proses evaluasi yang menyeluruh terhadap proposal dan presentasi yang telah Anda berikan.</p>

                {!! nl2br(e($announcement->content)) !!}

                <div style="margin: 20px 0; padding: 15px; background-color: #ecfdf5; border: 1px solid #047857; border-radius: 5px;">
                    <p style="color: #047857; margin: 0;"><strong>Jadwal Pelaksanaan:</strong><br>
                    {{ $announcement->announcement_date->isoFormat('dddd, D MMMM Y HH:mm') }}</p>
                </div>

                <p>Tim kami akan segera menghubungi Anda untuk membahas langkah selanjutnya dan detail pelaksanaan KKL.</p>
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
