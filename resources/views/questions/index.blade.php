@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Soal Tes Minat</h1>
    <a href="{{ route('questions.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Soal</a>
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">{{ session('success') }}</div>
    @endif
    <table class="min-w-full bg-white rounded-lg shadow-lg overflow-hidden">
                <thead class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
            <tr>
                <th class="border px-2 py-1">#</th>
                <th class="border px-2 py-1">Pertanyaan</th>
                <th class="border px-2 py-1">A</th>
                <th class="border px-2 py-1">B</th>
                <th class="border px-2 py-1">C</th>
                <th class="border px-2 py-1">D</th>
                <th class="border px-2 py-1">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $q)
            <tr>
                <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                <td class="border px-2 py-1">{{ $q->text }}</td>
                <td class="border px-2 py-1">{{ $q->option_a }}<br><span class="text-xs text-gray-500">({{ $q->option_a_sub }})</span></td>
                <td class="border px-2 py-1">{{ $q->option_b }}<br><span class="text-xs text-gray-500">({{ $q->option_b_sub }})</span></td>
                <td class="border px-2 py-1">{{ $q->option_c }}<br><span class="text-xs text-gray-500">({{ $q->option_c_sub }})</span></td>
                <td class="border px-2 py-1">{{ $q->option_d }}<br><span class="text-xs text-gray-500">({{ $q->option_d_sub }})</span></td>
                <td class="border px-2 py-1">
                    <a href="{{ route('questions.edit', $q) }}" class="text-blue-600">Edit</a> |
                    <form action="{{ route('questions.destroy', $q) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600" onclick="return confirm('Hapus soal ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
