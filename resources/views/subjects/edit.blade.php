@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Edit Mata Pelajaran</h1>
    <form action="{{ route('subjects.update', $subject) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-semibold">Nama Mata Pelajaran</label>
            <input type="text" name="name" class="w-full border rounded px-2 py-1" required value="{{ old('name', $subject->name) }}">
            @error('name')<div class="text-red-500 text-xs">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block font-semibold">Deskripsi</label>
            <textarea name="description" class="w-full border rounded px-2 py-1">{{ old('description', $subject->description) }}</textarea>
            @error('description')<div class="text-red-500 text-xs">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('subjects.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection