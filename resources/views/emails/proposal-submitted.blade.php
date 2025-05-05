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
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #1a56db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
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
            <p>Terima kasih telah mengajukan proposal penawaran untuk tender KKL D3 TI UDINUS. Proposal Anda telah berhasil disubmit pada {{ $proposal->updated_at->isoFormat('dddd, D MMMM Y HH:mm') }}.</p>

            <p>Detail Proposal:</p>
            <ul>
                <li>Nama Biro: {{ $proposal->nama_biro }}</li>
                <li>Email: {{ $proposal->email_biro }}</li>
                <li>Nomor Telepon: {{ $proposal->nomor_telepon }}</li>
            </ul>

            <p>Tim kami akan melakukan review terhadap proposal yang Anda ajukan. Kami akan menginformasikan hasil review melalui email ini.</p>

            <p>Mohon untuk menunggu informasi selanjutnya dari kami.</p>

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
