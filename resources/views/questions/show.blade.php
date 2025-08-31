@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Detail Soal Tes</h1>
    <div class="mb-4">
        <strong>Pertanyaan:</strong> {{ $question->text }}
    </div>
    <ul class="mb-4">
        <li><strong>A:</strong> {{ $question->option_a }} <span class="text-xs text-gray-500">({{ $question->option_a_sub }})</span></li>
        <li><strong>B:</strong> {{ $question->option_b }} <span class="text-xs text-gray-500">({{ $question->option_b_sub }})</span></li>
        <li><strong>C:</strong> {{ $question->option_c }} <span class="text-xs text-gray-500">({{ $question->option_c_sub }})</span></li>
        <li><strong>D:</strong> {{ $question->option_d }} <span class="text-xs text-gray-500">({{ $question->option_d_sub }})</span></li>
    </ul>
    <a href="{{ route('questions.edit', $question) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
    <a href="{{ route('questions.index') }}" class="ml-2 text-gray-600">Kembali</a>
</div>
@endsection
