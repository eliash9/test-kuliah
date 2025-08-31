@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-2xl">
    <h1 class="text-2xl font-bold mb-4">Hasil Tes Minat - {{ $result->user->name ?? 'Mahasiswa' }}</h1>
    
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Informasi Mahasiswa</h2>
        <div class="bg-gray-100 p-4 rounded">
            <p><strong>Nama:</strong> {{ $result->user->name ?? '-' }}</p>
            <p><strong>Email:</strong> {{ $result->user->email ?? '-' }}</p>
        </div>
    </div>
    
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Grafik Hasil Tes</h2>
        <canvas id="resultChart" height="120"></canvas>
    </div>
    
    <div class="mb-4">
        <h2 class="font-semibold mb-2">Rekomendasi Mata Kuliah:</h2>
        <ul class="list-disc list-inside">
            @forelse($recommendedSubjects as $subject)
            <li><strong>{{ $subject->name }}</strong> - {{ $subject->description ?? 'Tidak ada deskripsi' }}</li>
            @empty
            <li>Tidak ada rekomendasi mata kuliah</li>
            @endforelse
        </ul>
    </div>
    
    <div class="mt-6">
        <a href="{{ route('adminresults.printPdf', $result) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Cetak PDF
        </a>
        <a href="{{ route('adminresults.index') }}" class="text-blue-600 ml-4">← Kembali ke Rekap Hasil</a>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('resultChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Skor',
                data: @json($scores),
                backgroundColor: [
                    '#2563eb', '#16a34a', '#f59e42', '#a855f7'
                ],
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });
</script>
@endsection