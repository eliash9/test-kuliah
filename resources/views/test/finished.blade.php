@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-2xl">
    <div class="bg-white rounded-2xl shadow p-8 text-center">
        <h1 class="text-3xl font-bold text-indigo-700 mb-3">Tes Selesai!</h1>
        <p class="text-gray-700 mb-6">Jawabanmu sudah tersimpan. Silakan login atau daftar untuk melihat hasil tes dan rekomendasi.</p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('login') }}" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">Login untuk Lihat Hasil</a>
            <a href="{{ route('register') }}" class="px-6 py-3 border border-indigo-600 text-indigo-700 rounded-lg">Daftar Sekarang</a>
        </div>
        <div class="mt-6">
            <a href="{{ route('test.instructions') }}" class="text-gray-600 hover:underline">Ulangi Tes</a>
            <span class="mx-2 text-gray-400">•</span>
            <a href="{{ url('/') }}" class="text-gray-600 hover:underline">Kembali ke Beranda</a>
        </div>
    </div>
    </div>
@endsection

