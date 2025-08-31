@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Dashboard</h1>

    {{-- Panduan Pengguna --}}
    <div class="bg-gradient-to-r from-blue-50 to-blue-100 border-l-4 border-blue-500 p-4 rounded-lg shadow mb-6">
        <h2 class="text-lg font-semibold text-blue-700 mb-2">Panduan Penggunaan</h2>
        @if(Auth::user()->isMahasiswa())
            <ul class="list-disc pl-6 text-gray-700 space-y-1">
                <li>Pilih <strong>Tes Minat</strong> untuk memulai menjawab soal.</li>
                <li>Setelah selesai, buka <strong>Hasil Tes</strong> untuk melihat rekomendasi mata kuliah sesuai minat.</li>
            </ul>
        @endif
        @if(Auth::user()->isAdmin())
            <ul class="list-disc pl-6 text-gray-700 space-y-1">
                <li>Gunakan <strong>Manajemen Soal</strong> untuk menambah/mengedit soal tes.</li>
                <li>Atur daftar mata kuliah di menu <strong>Manajemen Mata Kuliah</strong>.</li>
                <li>Lihat seluruh hasil tes mahasiswa melalui <strong>Hasil Tes Mahasiswa</strong>.</li>
            </ul>
        @endif
    </div>

    {{-- Dashboard Mahasiswa --}}
    @if(Auth::user()->isMahasiswa())
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 text-gray-700">
                📘 Tes Minat
            </h2>
            <p class="mb-4 text-gray-600">Ikuti tes minat untuk mengetahui rekomendasi mata kuliah yang sesuai dengan minat Anda.</p>
            <a href="{{ route('answers.create') }}" 
               class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-4 py-2 rounded-lg shadow hover:opacity-90 transition">
               Mulai Tes
            </a>
        </div>
        
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 text-gray-700">
                📊 Hasil Tes
            </h2>
            <p class="mb-4 text-gray-600">Lihat hasil tes minat Anda dan rekomendasi mata kuliah.</p>
            <a href="{{ route('results.index') }}" 
               class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-4 py-2 rounded-lg shadow hover:opacity-90 transition">
               Lihat Hasil
            </a>
        </div>
    </div>
    @endif

    {{-- Dashboard Admin --}}
    @if(Auth::user()->isAdmin())
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 text-gray-700">
                📝 Manajemen Soal
            </h2>
            <p class="mb-4 text-gray-600">Kelola soal-soal tes minat yang akan dikerjakan oleh mahasiswa.</p>
            <a href="{{ route('questions.index') }}" 
               class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-4 py-2 rounded-lg shadow hover:opacity-90 transition">
               Kelola Soal
            </a>
        </div>
        
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 text-gray-700">
                📚 Manajemen Mata Kuliah
            </h2>
            <p class="mb-4 text-gray-600">Kelola daftar mata kuliah untuk rekomendasi berdasarkan hasil tes.</p>
            <a href="{{ route('subjects.index') }}" 
               class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-4 py-2 rounded-lg shadow hover:opacity-90 transition">
               Kelola Mata Kuliah
            </a>
        </div>
        
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h2 class="text-xl font-semibold mb-4 flex items-center gap-2 text-gray-700">
                📊 Hasil Tes Mahasiswa
            </h2>
            <p class="mb-4 text-gray-600">Lihat hasil tes minat dari semua mahasiswa.</p>
            <a href="{{ route('adminresults.index') }}" 
               class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-4 py-2 rounded-lg shadow hover:opacity-90 transition">
               Lihat Hasil
            </a>
        </div>
    </div>
    @endif
</div>
@endsection
