@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Jawaban Tes Minat</h1>
    <a href="{{ route('answers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Kerjakan Tes</a>
    <table class="min-w-full bg-white rounded-lg shadow-lg overflow-hidden">
                <thead class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
            <tr>
                <th class="border px-2 py-1">#</th>
                <th class="border px-2 py-1">Soal</th>
                <th class="border px-2 py-1">Jawaban</th>
                <th class="border px-2 py-1">Sub</th>
            </tr>
        </thead>
        <tbody>
            @foreach($answers as $a)
            <tr>
                <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                <td class="border px-2 py-1">{{ $a->question->text ?? '-' }}</td>
                <td class="border px-2 py-1">{{ $a->chosen_option }}</td>
                <td class="border px-2 py-1">{{ $a->sub }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
