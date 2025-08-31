<!DOCTYPE html>
<html>
<head>
    <title>Hasil Tes Minat - {{ $result->user->name ?? 'Mahasiswa' }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
        }
        .header h2 {
            margin: 5px 0 0 0;
            font-size: 16px;
            color: #666;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-section h3 {
            margin: 0 0 10px 0;
            font-size: 14px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .info-table th, .info-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .info-table th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .chart-container {
            margin: 20px 0;
            text-align: center;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        .signature-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        .signature-box {
            width: 45%;
        }
        .signature-line {
            margin-top: 60px;
            border-top: 1px solid #333;
            padding-top: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>HASIL TES MINAT</h1>
        <h2>{{ $result->user->name ?? 'Mahasiswa' }}</h2>
    </div>

    <div class="info-section">
        <h3>Informasi Mahasiswa</h3>
        <table class="info-table">
            <tr>
                <th>Nama</th>
                <td>{{ $result->user->name ?? '-' }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $result->user->email ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tanggal Tes</th>
                <td>{{ $result->created_at->format('d F Y') }}</td>
            </tr>
        </table>
    </div>

    <div class="info-section">
        <h3>Hasil Tes Minat</h3>
        <table class="info-table">
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Skor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Multimedia</td>
                    <td>{{ $result->multimedia_score }}</td>
                </tr>
                <tr>
                    <td>TKJ (Teknik Komputer dan Jaringan)</td>
                    <td>{{ $result->tkj_score }}</td>
                </tr>
                <tr>
                    <td>RPL (Rekayasa Perangkat Lunak)</td>
                    <td>{{ $result->rpl_score }}</td>
                </tr>
                <tr>
                    <td>Umum</td>
                    <td>{{ $result->umum_score }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="info-section">
        <h3>Rekomendasi Mata Kuliah</h3>
        <table class="info-table">
            <thead>
                <tr>
                    <th>Nama Mata Kuliah</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recommendedSubjects as $subject)
                <tr>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->description ?? 'Tidak ada deskripsi' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="2">Tidak ada rekomendasi mata kuliah</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="signature-section">
        <div class="signature-box">
            <p>Mengetahui,</p>
            <div class="signature-line">Admin</div>
        </div>
        <div class="signature-box">
            <p>Malang, {{ date('d F Y') }}</p>
            <div class="signature-line">Mahasiswa</div>
        </div>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ date('d F Y H:i:s') }} | Sistem Tes Minat</p>
    </div>
</body>
</html>