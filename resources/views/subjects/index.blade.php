@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Mata Pelajaran</h1>
    <a href="{{ route('subjects.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Mata Pelajaran</a>
    
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">{{ session('success') }}</div>
    @endif
    
    <table class="min-w-full bg-white rounded-lg shadow-lg overflow-hidden">
                <thead class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
            <tr>
                <th class="border px-2 py-1">#</th>
                <th class="border px-2 py-1">Nama</th>
                <th class="border px-2 py-1">Deskripsi</th>
                <th class="border px-2 py-1">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subjects as $subject)
            <tr>
                <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                <td class="border px-2 py-1">{{ $subject->name }}</td>
                <td class="border px-2 py-1">{{ $subject->description ?? '-' }}</td>
                <td class="border px-2 py-1">
                    <a href="{{ route('subjects.edit', $subject) }}" class="text-blue-600">Edit</a> |
                    <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600" onclick="return confirm('Hapus mata pelajaran ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection