@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-md">
    <h1 class="text-2xl font-bold mb-4 text-center">Register</h1>
    
    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-2 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block font-semibold">Nama</label>
            <input type="text" name="name" class="w-full border rounded px-2 py-1" required value="{{ old('name') }}">
        </div>
        <div>
            <label class="block font-semibold">Email</label>
            <input type="email" name="email" class="w-full border rounded px-2 py-1" required value="{{ old('email') }}">
        </div>
        <div>
            <label class="block font-semibold">Password</label>
            <input type="password" name="password" class="w-full border rounded px-2 py-1" required>
        </div>
        <div>
            <label class="block font-semibold">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="w-full border rounded px-2 py-1" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">Register</button>
        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-blue-600">Sudah punya akun? Login</a>
        </div>
    </form>
</div>
@endsection