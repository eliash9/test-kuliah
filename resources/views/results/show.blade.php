@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-3xl">
    <div class="bg-white shadow-lg rounded-2xl p-6">
        <h1 class="text-3xl font-bold mb-6 text-center text-indigo-700">📊 Hasil Tes Minat Saya</h1>

        {{-- Chart Section --}}
        <div class="mb-8">
            <canvas id="resultChart" height="160"></canvas>
        </div>

        {{-- Persentase --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center mb-8">
            @foreach($labels as $index => $label)
                @php
                    $percent = round(($scores[$index] / array_sum($scores)) * 100, 1);
                @endphp
                <div class="bg-gradient-to-r from-indigo-100 to-indigo-200 p-4 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="text-lg font-bold text-indigo-800">{{ $label }}</h3>
                    <p class="text-2xl font-extrabold text-indigo-600">{{ $percent }}%</p>
                </div>
            @endforeach
        </div>

        {{-- Motivasi --}}
        <div class="bg-gradient-to-r from-purple-100 via-pink-100 to-red-100 p-6 rounded-xl shadow mb-8">
            <h2 class="text-xl font-semibold mb-2 text-purple-800">💡 Motivasi Untukmu</h2>
            @php
                $motivasi = [
                    'Multimedia' => 'Kreativitasmu luar biasa! Dunia desain, animasi, dan visual menantimu.',
                    'TKJ' => 'Kamu punya logika dan ketekunan yang kuat, cocok jadi ahli jaringan handal.',
                    'RPL' => 'Kemampuan analisis dan problem solvingmu pas banget untuk jadi programmer hebat.',
                    'Umum' => 'Kamu punya potensi luas. Eksplorasi bidang umum akan membuka banyak peluang.'
                ];
                $maxIndex = array_search(max($scores), $scores);
                $motivasiText = $motivasi[$labels[$maxIndex]] ?? 'Teruslah belajar dan temukan passionmu!';
            @endphp
            <p class="text-lg text-gray-700">{{ $motivasiText }}</p>
        </div>

        {{-- Rekomendasi --}}
        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-4 text-indigo-700">🎯 Rekomendasi Mata Kuliah</h2>
            <ul class="list-disc list-inside space-y-2 text-gray-700">
                @forelse($recommendedSubjects as $subject)
                    <li>
                        <strong class="text-indigo-600">{{ $subject->name }}</strong> 
                        – {{ $subject->description ?? 'Tidak ada deskripsi' }}
                    </li>
                @empty
                    <li>Tidak ada rekomendasi mata kuliah</li>
                @endforelse
            </ul>
        </div>

        {{-- Actions --}}
        <div class="flex justify-center space-x-4">
            <a href="{{ route('results.printPdf', $result) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-full shadow-lg transition transform hover:scale-105">
                📄 Cetak PDF
            </a>
            <a href="{{ route('results.index') }}" class="text-indigo-600 font-semibold hover:underline flex items-center">
                ← Kembali ke Rekap
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('resultChart').getContext('2d');
    new Chart(ctx, {
        type: 'radar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Skor Minat',
                data: @json($scores),
                backgroundColor: 'rgba(99, 102, 241, 0.2)',
                borderColor: 'rgba(99, 102, 241, 1)',
                pointBackgroundColor: 'rgba(99, 102, 241, 1)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: {
                r: {
                    angleLines: { display: true },
                    suggestedMin: 0,
                    suggestedMax: 100,
                    ticks: { stepSize: 20 }
                }
            }
        }
    });
</script>
@endsection
