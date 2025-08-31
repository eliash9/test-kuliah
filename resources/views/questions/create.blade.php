@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Tambah Soal Tes</h1>
    <form action="{{ route('questions.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block font-semibold">Pertanyaan</label>
            <input type="text" name="text" class="w-full border rounded px-2 py-1" required value="{{ old('text') }}">
            @error('text')<div class="text-red-500 text-xs">{{ $message }}</div>@enderror
        </div>
        <div class="grid grid-cols-2 gap-2">
            <div>
                <label class="block">Opsi A</label>
                <input type="text" name="option_a" class="w-full border rounded px-2 py-1" required value="{{ old('option_a') }}">
                <input type="text" name="option_a_sub" class="w-full border rounded px-2 py-1 mt-1" placeholder="Sub (multimedia/tkj/rpl/umum)" required value="{{ old('option_a_sub') }}">
            </div>
            <div>
                <label class="block">Opsi B</label>
                <input type="text" name="option_b" class="w-full border rounded px-2 py-1" required value="{{ old('option_b') }}">
                <input type="text" name="option_b_sub" class="w-full border rounded px-2 py-1 mt-1" placeholder="Sub (multimedia/tkj/rpl/umum)" required value="{{ old('option_b_sub') }}">
            </div>
            <div>
                <label class="block">Opsi C</label>
                <input type="text" name="option_c" class="w-full border rounded px-2 py-1" required value="{{ old('option_c') }}">
                <input type="text" name="option_c_sub" class="w-full border rounded px-2 py-1 mt-1" placeholder="Sub (multimedia/tkj/rpl/umum)" required value="{{ old('option_c_sub') }}">
            </div>
            <div>
                <label class="block">Opsi D</label>
                <input type="text" name="option_d" class="w-full border rounded px-2 py-1" required value="{{ old('option_d') }}">
                <input type="text" name="option_d_sub" class="w-full border rounded px-2 py-1 mt-1" placeholder="Sub (multimedia/tkj/rpl/umum)" required value="{{ old('option_d_sub') }}">
            </div>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('questions.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
