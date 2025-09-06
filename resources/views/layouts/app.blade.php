<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Tes Minat Mahasiswa') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white border-b shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-2 font-bold text-xl text-blue-700 hover:text-blue-800">
                 <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-amber-500 text-white font-bold">E</span>
                <span class="font-semibold tracking-tight">EduBrand</span>
            </a>

            <!-- Menu (Desktop) -->
            <div class="hidden md:flex items-center gap-6">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 transition">Dashboard</a>
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('questions.index') }}" class="text-gray-700 hover:text-blue-600 transition">Kelola Soal</a>
                        <a href="{{ route('subjects.index') }}" class="text-gray-700 hover:text-blue-600 transition">Mata Kuliah</a>
                        <a href="{{ route('adminresults.index') }}" class="text-gray-700 hover:text-blue-600 transition">Hasil Tes</a>
                    @endif
                    @if(Auth::user()->isMahasiswa())
                        <a href="{{ route('test.instructions') }}" class="text-gray-700 hover:text-blue-600 transition">Tes Minat</a>
                        <a href="{{ route('results.index') }}" class="text-gray-700 hover:text-blue-600 transition">Hasil Tes</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                            Logout
                        </button>
                    </form>
                @else
                    <nav class="flex items-center gap-6 text-sm">
                        <a href="#how-it-works" class="hover:text-amber-600 transition">Cara Kerja</a>
                        <a href="#riasec" class="hover:text-amber-600 transition">Tipe Kepribadian</a>
                        <a href="#faq" class="hover:text-amber-600 transition">FAQ</a>
                    </nav>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}" class="rounded-xl border border-slate-300 px-4 py-2 text-sm font-medium hover:bg-slate-50">Masuk</a>
                        <a href="{{ route('test.instructions') }}" class="inline-flex rounded-xl bg-amber-500 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-amber-600 transition">Coba Gratis</a>
                    </div>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden" x-data="{ open:false }">
                <button @click="open=!open" class="text-gray-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <!-- Dropdown Mobile -->
                <div x-show="open" @click.away="open=false" 
                     class="absolute right-4 mt-2 w-52 bg-white shadow-lg rounded-lg py-2 z-50">
                    @auth
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dashboard</a>
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('questions.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Kelola Soal</a>
                            <a href="{{ route('subjects.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Mata Kuliah</a>
                            <a href="{{ route('adminresults.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Hasil Tes</a>
                        @endif
                        @if(Auth::user()->isMahasiswa())
                            <a href="{{ route('test.instructions') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Tes Minat</a>
                            <a href="{{ route('results.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Hasil Tes</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-100">Logout</button>
                        </form>
                    @else
                        <a href="#how-it-works" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Cara Kerja</a>
                        <a href="#riasec" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Tipe Kepribadian</a>
                        <a href="#faq" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">FAQ</a>
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Masuk</a>
                        <a href="{{ route('test.instructions') }}" class="block px-4 py-2 text-white bg-amber-500 hover:bg-amber-600 rounded-lg mx-2 my-1 text-center">Coba Gratis</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main -->
    <main class="flex-1 container mx-auto px-4 py-6">
        @yield('content')
    </main>
    <footer id="download" class="border-t border-slate-100 bg-slate-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid gap-10 md:grid-cols-3">
        <div>
          <div class="flex items-center gap-2">
            <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-amber-500 text-white font-bold">E</span>
            <span class="font-semibold tracking-tight">EduBrand</span>
          </div>
          <p class="mt-3 text-sm text-slate-600 max-w-sm">Platform belajar dengan fitur tes minat & bakat untuk bantu kamu memilih jurusan dan merencanakan karier.</p>
          <div class="mt-4 flex gap-3">
            <a class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm shadow hover:bg-slate-50">Google Play</a>
            <a class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm shadow hover:bg-slate-50">App Store</a>
          </div>
        </div>
        <div>
          <h4 class="font-semibold">Kontak</h4>
          <ul class="mt-3 space-y-2 text-sm text-slate-600">
            <li class="flex gap-2"><svg class="mt-1 h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M10 2a6 6 0 0 1 6 6c0 5-6 10-6 10S4 13 4 8a6 6 0 0 1 6-6zm0 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg> Jl. Contoh Raya No. 123, Jakarta</li>
            <li class="flex gap-2"><svg class="mt-1 h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M2.94 6.34a1 1 0 0 1 1.4-.28L10 10.2l5.66-4.14a1 1 0 1 1 1.12 1.64l-6.22 4.55a1 1 0 0 1-1.12 0L2.94 7.7a1 1 0 0 1-.28-1.36z"/><path d="M18 8v6a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8l8 5 8-5z"/></svg> support@edubrand.id</li>
            <li class="flex gap-2"><svg class="mt-1 h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M2.3 3.8A2 2 0 0 1 4.2 3h11.6a2 2 0 0 1 1.9 2.8l-3.9 9.9a2 2 0 0 1-1.9 1.3H6.1a2 2 0 0 1-1.9-1.3L2.3 5.8a2 2 0 0 1 0-2z"/></svg> +62-812-0000-0000</li>
          </ul>
        </div>
        <div>
          <h4 class="font-semibold">Tautan</h4>
          <ul class="mt-3 space-y-2 text-sm text-slate-600">
            <li><a href="#how-it-works" class="hover:text-amber-600">Cara Kerja</a></li>
            <li><a href="#riasec" class="hover:text-amber-600">Tipe Kepribadian</a></li>
            <li><a href="#faq" class="hover:text-amber-600">FAQ</a></li>
            <li><a href="#" class="hover:text-amber-600">Kebijakan Privasi</a></li>
            <li><a href="#" class="hover:text-amber-600">Syarat & Ketentuan</a></li>
          </ul>
        </div>
      </div>
      <div class="mt-10 border-t border-slate-200 pt-6 text-xs text-slate-500">© 2021–2025 EduBrand. All rights reserved.</div>
    </div>
  </footer>


    @yield('scripts')
</body>
</html>
