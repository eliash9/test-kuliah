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
        .chart-section { margin: 24px 0; }
        .chart-row { margin: 8px 0; }
        .chart-label { display: inline-block; width: 140px; font-weight: bold; }
        .chart-bar-wrap { display: inline-block; width: 65%; background: #f3f4f6; border-radius: 4px; vertical-align: middle; }
        .chart-bar { height: 14px; background: #4f46e5; border-radius: 4px; }
        .chart-val { display: inline-block; width: 70px; text-align: right; font-size: 11px; }
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

    @php($total = max(array_sum($scores ?? []), 1))
    <div class="info-section">
        <h3>Hasil Tes Minat</h3>
        <table class="info-table">
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Skor</th>
                    <th>Persentase</th>
                </tr>
            </thead>
            <tbody>
                @foreach($labels as $i => $label)
                @php($val = (int)($scores[$i] ?? 0))
                @php($pct = round(($val / $total) * 100, 1))
                <tr>
                    <td>{{ $label }}</td>
                    <td>{{ $val }}</td>
                    <td>{{ $pct }}%</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="chart-section">
        <h3>Chart Skor (Persentase)</h3>
        @php($barWidth = 300)
        <table style="width:100%; border-collapse: collapse; margin-top: 6px;">
            @foreach($labels as $i => $label)
                @php($val = (int)($scores[$i] ?? 0))
                @php($pct = round(($val / $total) * 100))
                @php($px = round(($pct/100) * $barWidth))
                <tr>
                    <td style="padding:6px 6px 6px 0; width: 35%; font-weight: bold;">{{ $label }}</td>
                    <td style="padding:6px 8px; width: {{ $barWidth+12 }}px;">
                        <div style="width: {{ $barWidth }}px; height: 12px; background: #f3f4f6; border: 1px solid #e5e7eb; border-radius: 3px;">
                            <div style="width: {{ $px }}px; height: 100%; background: #4f46e5;"></div>
                        </div>
                    </td>
                    <td style="padding:6px 0; text-align: right; width: 10%;">{{ $pct }}%</td>
                </tr>
            @endforeach
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
        <table style="width:100%; margin-top: 24px;">
            <tr>
                <td style="width:50%; text-align:center; vertical-align:bottom;">
                    <div>Mengetahui,</div>
                    <div style="height:60px;"></div>
                    <div class="signature-line">Admin</div>
                </td>
                <td style="width:50%; text-align:center; vertical-align:bottom;">
                    <div>Malang, {{ date('d F Y') }}</div>
                    <div style="height:60px;"></div>
                    <div class="signature-line">{{ $result->user->name ?? 'Mahasiswa' }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ date('d F Y H:i:s') }} | Sistem Tes Minat</p>
    </div>
</body>
</html>
