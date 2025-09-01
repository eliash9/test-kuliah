@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Edit Soal Tes</h1>
    <form action="{{ route('questions.update', $question) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-semibold">Pertanyaan</label>
            <input type="text" name="text" class="w-full border rounded px-2 py-1" required value="{{ old('text', $question->text) }}">
            @error('text')<div class="text-red-500 text-xs">{{ $message }}</div>@enderror
        </div>
        <div class="space-y-3">
            @php($opts = $question->options)
            @foreach($opts as $idx => $opt)
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block">Opsi {{ chr(65+$idx) }}</label>
                        <input type="text" name="options[{{ $idx }}][text]" class="w-full border rounded px-2 py-1" required value="{{ old("options.$idx.text", $opt->text) }}">
                    </div>
                    <div>
                        <label class="block">Subject</label>
                        <select name="options[{{ $idx }}][subject_id]" class="w-full border rounded px-2 py-1" required>
                            @foreach($subjects as $s)
                                <option value="{{ $s->id }}" @selected(old("options.$idx.subject_id", $opt->subject_id) == $s->id)>{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('questions.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
