@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-3xl">
    <h1 class="text-2xl font-bold mb-4">Tambah Soal Tes</h1>

    @php($initialOptions = old('options', [[ 'text'=>'', 'subject_id'=>'' ], [ 'text'=>'', 'subject_id'=>'' ]]))
    <script type="application/json" id="init-options">@json($initialOptions)</script>

    <form action="{{ route('questions.store') }}" method="POST" class="space-y-4"
          x-data="{ options: [], add(){ this.options.push({text: '', subject_id: ''}); }, remove(i){ if(this.options.length>2){ this.options.splice(i,1); } } }"
          x-init="options = JSON.parse(document.getElementById('init-options').textContent)">
        @csrf

        <div>
            <label class="block font-semibold">Pertanyaan</label>
            <input type="text" name="text" class="w-full border rounded px-2 py-2" required value="{{ old('text') }}">
            @error('text')<div class="text-red-500 text-xs">{{ $message }}</div>@enderror
        </div>

        <div class="space-y-3">
            <template x-for="(opt, idx) in options" :key="idx">
                <div class="grid grid-cols-12 gap-2 items-end">
                    <div class="col-span-1 text-center font-semibold">
                        <label class="block text-sm text-gray-600">Key</label>
                        <div class="text-lg" x-text="String.fromCharCode(65+idx)"></div>
                    </div>
                    <div class="col-span-6">
                        <label class="block">Teks Opsi</label>
                        <input type="text" :name="`options[${idx}][text]`" class="w-full border rounded px-2 py-2" required x-model="opt.text" placeholder="Tulis opsi jawaban...">
                    </div>
                    <div class="col-span-4">
                        <label class="block">Subject</label>
                        <select :name="`options[${idx}][subject_id]`" class="w-full border rounded px-2 py-2" required x-model="opt.subject_id">
                            <option value="" disabled>Pilih Subject</option>
                            @foreach($subjects as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-1 text-right">
                        <button type="button" @click="remove(idx)" class="px-2 py-2 text-red-600" x-show="options.length>2" title="Hapus opsi">&times;</button>
                    </div>
                </div>
            </template>
            <div>
                <button type="button" @click="add()" class="mt-2 px-3 py-2 bg-gray-100 rounded border">+ Tambah Pilihan</button>
            </div>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('questions.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
