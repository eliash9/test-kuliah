<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Tes Minat Mahasiswa') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs" ></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white border-b shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-2 font-bold text-xl text-blue-700 hover:text-blue-800">
                🎓 Tes Minat
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
                        <a href="{{ route('answers.create') }}" class="text-gray-700 hover:text-blue-600 transition">Tes Minat</a>
                        <a href="{{ route('results.index') }}" class="text-gray-700 hover:text-blue-600 transition">Hasil Tes</a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 transition">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Register
                    </a>
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
                     class="absolute right-4 mt-2 w-48 bg-white shadow-lg rounded-lg py-2 z-50">
                    @auth
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dashboard</a>
                        
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('questions.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Kelola Soal</a>
                            <a href="{{ route('subjects.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Mata Kuliah</a>
                            <a href="{{ route('adminresults.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Hasil Tes</a>
                        @endif
                        
                        @if(Auth::user()->isMahasiswa())
                            <a href="{{ route('answers.create') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Tes Minat</a>
                            <a href="{{ route('results.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Hasil Tes</a>
                        @endif
                        
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-100">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Login</a>
                        <a href="{{ route('register') }}" class="block px-4 py-2 text-blue-600 hover:bg-blue-50">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main -->
    <main class="flex-1 container mx-auto px-4 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-8">
        <div class="container mx-auto px-4 py-6 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} Tes Minat Mahasiswa. Dibuat dengan ❤️ untuk mahasiswa baru.
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
