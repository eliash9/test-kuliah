@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-600 text-white">
    <div class="container mx-auto p-8 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 animate-bounce">
            Selamat Datang di Tes Minat Mahasiswa 🎓
        </h1>
        <p class="mb-6 text-lg md:text-xl">
            Temukan arah studi terbaikmu melalui serangkaian pertanyaan sederhana & analisis cerdas.
        </p>

        @auth
            <a href="{{ route('dashboard') }}" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-8 py-3 rounded-full text-lg font-semibold shadow-lg transition transform hover:scale-105">
                🚀 Ke Dashboard
            </a>
        @else
            <a href="{{ route('register') }}" class="bg-green-400 hover:bg-green-500 text-gray-900 px-8 py-3 rounded-full text-lg font-semibold shadow-lg transition transform hover:scale-105">
                ✨ Daftar Sekarang
            </a>
            <div class="mt-4">
                <a href="{{ route('login') }}" class="text-yellow-200 hover:underline">Sudah punya akun? Login</a>
            </div>
        @endauth
    </div>
</div>

{{-- Section Fitur --}}
<div class="container mx-auto px-6 py-16">
    <h2 class="text-3xl font-bold text-center mb-10">🔥 Fitur Unggulan</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">
            <h3 class="text-xl font-semibold mb-2">📝 Tes Minat</h3>
            <p class="text-gray-600">Ikuti serangkaian pertanyaan interaktif untuk menemukan minat studi Anda.</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">
            <h3 class="text-xl font-semibold mb-2">📊 Hasil Analisis</h3>
            <p class="text-gray-600">Dapatkan hasil visual berupa grafik dan persentase minat studi Anda.</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">
            <h3 class="text-xl font-semibold mb-2">🎯 Rekomendasi</h3>
            <p class="text-gray-600">Temukan rekomendasi mata kuliah sesuai dengan hasil minat Anda.</p>
        </div>
    </div>
</div>

{{-- Section Testimoni --}}
<div class="bg-gray-100 py-16">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-10">💬 Testimoni Mahasiswa</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <p class="italic text-gray-700">“Tes ini benar-benar membantu saya memahami minat studi saya. Sangat bermanfaat!”</p>
                <h4 class="mt-4 font-bold">– Andi, RPL</h4>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <p class="italic text-gray-700">“Dulu bingung pilih jurusan, sekarang jadi lebih yakin setelah ikut tes minat ini.”</p>
                <h4 class="mt-4 font-bold">– Sinta, Multimedia</h4>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <p class="italic text-gray-700">“Analisis hasilnya keren, ada grafik yang bikin lebih mudah dimengerti.”</p>
                <h4 class="mt-4 font-bold">– Budi, TKJ</h4>
            </div>
        </div>
    </div>
</div>

{{-- Section CTA --}}
<div class="bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 text-white py-20">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-extrabold mb-6">Siap Temukan Minatmu? 🚀</h2>
        <p class="mb-8 text-lg">Jangan tunggu lagi, mulai tes sekarang dan temukan jurusan yang paling sesuai dengan potensimu.</p>
        <a href="{{ route('register') }}" class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-full font-bold shadow-lg transition transform hover:scale-110">
            Mulai Tes Sekarang
        </a>
    </div>
</div>
@endsection
