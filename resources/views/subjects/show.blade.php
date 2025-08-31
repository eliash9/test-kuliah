@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Detail Mata Pelajaran</h1>
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-xl font-semibold">{{ $subject->name }}</h2>
        <p class="mt-2">{{ $subject->description ?? 'Tidak ada deskripsi' }}</p>
    </div>
    <div class="mt-4">
        <a href="{{ route('subjects.edit', $subject) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Edit</a>
        <a href="{{ route('subjects.index') }}" class="ml-2 text-gray-600">Kembali</a>
    </div>
</div>
@endsection