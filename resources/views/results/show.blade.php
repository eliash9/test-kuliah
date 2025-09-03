@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-3xl">
    <div class="bg-white shadow-lg rounded-2xl p-6">
        <h1 class="text-3xl font-bold mb-6 text-center text-indigo-700">Hasil Tes Minat Saya</h1>

        <div class="mb-8">
            <canvas id="resultChart" height="200"></canvas>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center mb-8">
            @foreach($labels as $index => $label)
                @php
                    $total = max(array_sum($scores), 1);
                    $percent = round(($scores[$index] / $total) * 100, 1);
                @endphp
                <div class="bg-gradient-to-r from-indigo-100 to-indigo-200 p-4 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="text-lg font-bold text-indigo-800">{{ $label }}</h3>
                    <p class="text-2xl font-extrabold text-indigo-600">{{ $percent }}%</p>
                </div>
            @endforeach
        </div>

        <div class="bg-gradient-to-r from-purple-100 via-pink-100 to-red-100 p-6 rounded-xl shadow mb-8">
            <h2 class="text-xl font-semibold mb-2 text-purple-800">Motivasi Untukmu</h2>
            @php
                $maxIndex = array_search(max($scores), $scores);
                $top = $labels[$maxIndex] ?? null;
            @endphp
            <p class="text-lg text-gray-700">{{ $top ? "Fokus minatmu paling kuat pada: $top. Terus perdalam dan eksplorasi bidang tersebut!" : 'Teruslah belajar dan temukan passionmu!' }}</p>
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-4 text-indigo-700">Rekomendasi Mata Kuliah</h2>
            <ul class="list-disc list-inside space-y-2 text-gray-700">
                @forelse($recommendedSubjects as $subject)
                    <li>
                        <strong class="text-indigo-600">{{ $subject->name }}</strong>
                        - {{ $subject->description ?? 'Tidak ada deskripsi' }}
                    </li>
                @empty
                    <li>Tidak ada rekomendasi mata kuliah</li>
                @endforelse
            </ul>
        </div>

        <div class="flex justify-center space-x-4">
            <a href="{{ route('results.printPdf') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-full shadow-lg transition transform hover:scale-105">
                Cetak PDF
            </a>
            <a href="{{ route('results.index') }}" class="text-indigo-600 font-semibold hover:underline flex items-center">
                Kembali ke Rekap
            </a>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('resultChart').getContext('2d');
    const labels = @json($labels);
    const dataVals = @json($scores);
    const total = Math.max(dataVals.reduce((a,b)=>a+b,0),1);
    const bg = ['#6366f1','#22c55e','#f59e0b','#ef4444','#06b6d4','#a855f7'];
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels.map((l,i)=>`${l} (${Math.round((dataVals[i]/total)*100)}%)`),
            datasets: [{
                data: dataVals,
                backgroundColor: labels.map((_,i)=> bg[i%bg.length])
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } }
        }
    });
</script>
@endsection
