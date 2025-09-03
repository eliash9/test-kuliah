@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-3xl">
    <div class="bg-white rounded-2xl shadow p-8">
        <h1 class="text-3xl font-bold text-indigo-700 mb-4">Instruksi Tes Minat</h1>
        <p class="text-gray-700 mb-4">Tes ini terdiri dari beberapa pertanyaan singkat. Pilih jawaban yang paling sesuai dengan diri kamu. Tidak ada jawaban benar/salah.</p>
        <ul class="list-disc list-inside text-gray-700 space-y-1 mb-6">
            <li>Setiap pertanyaan hanya boleh dipilih satu jawaban.</li>
            <li>Setelah memilih, kamu akan otomatis berpindah ke pertanyaan berikutnya.</li>
            <li>Tidak perlu login untuk mengerjakan tes. Login/Daftar hanya diperlukan untuk melihat hasil.</li>
        </ul>
        <a href="{{ route('test.start') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg">Mulai Tes</a>
    </div>
</div>
@endsection

