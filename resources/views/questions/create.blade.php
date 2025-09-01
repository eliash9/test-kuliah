@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Tambah Soal Tes</h1>
    <form action="{{ route('questions.store') }}" method="POST" class="space-y-4" x-data="{ options: [{text:'',subject_id:''},{text:'',subject_id:''},{text:'',subject_id:''},{text:'',subject_id:''}] }">
        @csrf
        <div>
            <label class="block font-semibold">Pertanyaan</label>
            <input type="text" name="text" class="w-full border rounded px-2 py-1" required value="{{ old('text') }}">
            @error('text')<div class="text-red-500 text-xs">{{ $message }}</div>@enderror
        </div>
        <div class="space-y-3">
            <template x-for="(opt, idx) in options" :key="idx">
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block">Opsi <span x-text="String.fromCharCode(65+idx)"></span></label>
                        <input type="text" :name="`options[${idx}][text]`" class="w-full border rounded px-2 py-1" required x-model="opt.text">
                    </div>
                    <div>
                        <label class="block">Subject</label>
                        <select :name="`options[${idx}][subject_id]`" class="w-full border rounded px-2 py-1" required x-model="opt.subject_id">
                            <option value="" disabled>Pilih Subject</option>
                            @foreach($subjects as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </template>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('questions.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
