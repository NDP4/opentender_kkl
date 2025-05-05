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
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #1a56db;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
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
                {!! nl2br(e($announcement->content)) !!}

                @if($announcement->type === 'presentation')
                    <div style="margin: 20px 0; padding: 15px; background-color: #e5edff; border: 1px solid #1a56db; border-radius: 5px;">
                        <p style="color: #1a56db; margin: 0;"><strong>Jadwal Presentasi:</strong><br>
                        {{ $announcement->announcement_date->isoFormat('dddd, D MMMM Y HH:mm') }}</p>
                    </div>

                    <p>Mohon untuk segera mengkonfirmasi kehadiran Anda melalui sistem.</p>
                @endif
            </div>

            <div style="margin-top: 30px">
                <p>Salam,<br>Tim Open Tender KKL D3 TI UDINUS</p>
            </div>

            @if($announcement->type === 'presentation')
                <div style="text-align: center; margin-top: 30px;">
                    <a href="{{ route('biro.announcements') }}" class="button">
                        Konfirmasi Kehadiran
                    </a>
                </div>
            @endif
        </div>
        <div class="footer">
            <p>Email ini dikirim secara otomatis, mohon untuk tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html>
