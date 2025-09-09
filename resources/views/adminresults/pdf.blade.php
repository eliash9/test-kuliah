<!DOCTYPE html>
<html>
<head>
    <title>Hasil Tes Minat - {{ $user->name ?? 'Mahasiswa' }}</title>
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
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        .signature-box {
            width: 45%;
        }
        .signature-line {
            margin-top: 40px;
            border-top: 1px solid #333;
            padding-top: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>HASIL TES MINAT</h1>
        <h2>{{ $user->name ?? 'Mahasiswa' }}</h2>
    </div>

    <div class="info-section">
        <h3>Informasi Mahasiswa</h3>
        <table class="info-table">
            <tr>
                <th>Nama</th>
                <td>{{ $user->name ?? '-' }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tanggal Tes</th>
                <td>{{ date('d F Y') }}</td>
            </tr>
        </table>
    </div>

    
    <div class="chart-section">
        <h3>Skor (Persentase)</h3>
        @php
            $colors = ['#6366f1','#22c55e','#f59e0b','#ef4444','#06b6d4','#a855f7'];
        @endphp
        <table style="width:100%; border-collapse: collapse;">
            <tr>
                <td style="width: 260px; vertical-align: top; padding: 8px 0; text-align:center;">
                    @if(!empty($chartBase64))
                        <img alt="Pie chart" src="data:image/png;base64,{{ $chartBase64 }}" style="width:240px; height:240px;" />
                    @else
                        @php
                            // Fallback to SVG if GD is unavailable
                            $r = 80; $cx = 110; $cy = 110; $sw = 28;
                            $circ = 2 * pi() * $r; $acc = 0.0;
                            $fmt = function($n){ return number_format($n, 3, '.', ''); };
                        @endphp
                        <svg width="220" height="220" viewBox="0 0 220 220" xmlns="http://www.w3.org/2000/svg">
                            <g transform="rotate(-90 110 110)">
                                <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" fill="none" stroke="#e5e7eb" stroke-width="{{ $sw }}" />
                                @foreach($labels as $i => $label)
                                    @php
                                        $val = (float)($scores[$i] ?? 0);
                                        $pct = $total > 0 ? ($val / $total) : 0;
                                        $seg = $pct * $circ;
                                        $dasharray = $fmt($seg) . ' ' . $fmt($circ - $seg);
                                        $dashoffset = $fmt(-$acc);
                                        $color = $colors[$i % count($colors)];
                                        $acc += $seg;
                                    @endphp
                                    @if($seg > 0)
                                    <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" fill="none"
                                            stroke="{{ $color }}" stroke-width="{{ $sw }}"
                                            stroke-dasharray="{{ $dasharray }}"
                                            stroke-dashoffset="{{ $dashoffset }}" />
                                    @endif
                                @endforeach
                            </g>
                            @php
                                $centerLabel = $topLabel ?? '';
                                $centerPercent = isset($topPercent) ? ($topPercent . '%') : '';
                            @endphp
                            <g>
                                <text x="110" y="108" text-anchor="middle" fill="#374151" font-size="12" font-family="Arial, sans-serif">{{ $centerLabel }}</text>
                                <text x="110" y="126" text-anchor="middle" fill="#374151" font-size="16" font-weight="bold" font-family="Arial, sans-serif">{{ $centerPercent }}</text>
                            </g>
                        </svg>
                    @endif
                </td>
                <td style="vertical-align: top; padding-left: 12px;">
                    <div>
                        @foreach($labels as $index => $label)
                            @php
                                $total = max(array_sum($scores), 1);
                                $percent = round(($scores[$index] / $total) * 100, 1);
                                $color = $colors[$index % count($colors)];
                            @endphp
                            <div style="display: flex; align-items: center; margin-bottom: 12px;">
                                <div style="width: 16px; height: 16px; border-radius: 50%; background: {{ $color }}; margin-right: 10px;"></div>
                                <div style="flex: 1;">
                                    <span style="font-weight: bold; color: #333;">{{ $label }}</span>
                                </div>
                                <div style="width: 70px; text-align: right; font-size: 13px; color: #4f46e5; font-weight: bold;">
                                    {{ $percent }}%
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                </td>
            </tr>
        </table>
    </div>

    <div class="info-section" style="margin-top: 8px;">
        <h3>Motivasi Untukmu</h3>
        @php $motLabel = $topLabel ?? null; @endphp
        <p style="margin: 0;">{{ $motLabel ? "Fokus minatmu paling kuat pada: $motLabel. Terus perdalam dan eksplorasi bidang tersebut!" : 'Teruslah belajar dan temukan passionmu!' }}</p>
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
                    <div class="signature-line">{{ $user->name ?? 'Mahasiswa' }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ date('d F Y H:i:s') }} | Sistem Tes Minat</p>
    </div>
</body>
</html>
