@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-2xl">
    <h1 class="text-2xl md:text-3xl font-bold mb-6 text-center text-indigo-700">
        📝 Tes Minat Mahasiswa
    </h1>

   <form action="{{ route('answers.store') }}" method="POST" x-data="quizForm()" @submit.prevent="submitForm($el)">
        @csrf

        {{-- Progress Bar --}}
        <div class="w-full bg-gray-200 rounded-full h-3 mb-8">
            <div class="bg-indigo-600 h-3 rounded-full transition-all duration-500" 
                 :style="{ width: ((step / total) * 100) + '%' }"></div>
        </div>

        {{-- Questions --}}
        @foreach($questions as $index => $question)
        <div 
            x-show="step === {{ $index+1 }}" 
            x-transition:enter="transition ease-out duration-500" 
            x-transition:enter-start="opacity-0 translate-x-10" 
            x-transition:enter-end="opacity-100 translate-x-0" 
            x-transition:leave="transition ease-in duration-300" 
            x-transition:leave-start="opacity-100 translate-x-0" 
            x-transition:leave-end="opacity-0 -translate-x-10"
            class="bg-white p-6 rounded-xl shadow-md mb-6"
        >
            <p class="font-semibold mb-4 text-lg">
                {{ $loop->iteration }}. {{ $question->text }}
            </p>
            <div class="space-y-3">
                @php($opts = $question->options)
                @foreach($opts as $opt)
                <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-indigo-50">
                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $opt->id }}" class="mr-3" required>
                    <span>
                        {{ $opt->text }}
                        
                    </span>
                </label>
                @endforeach
            </div>
        </div>
        @endforeach

        {{-- Navigation --}}
        <div class="flex justify-between items-center mt-6">
            <button type="button" 
                class="px-4 py-2 bg-gray-300 text-gray-700 rounded disabled:opacity-50" 
                @click="prevStep" 
                :disabled="step === 1">
                ← Sebelumnya
            </button>

            <template x-if="step < total">
                <button type="button" 
                    class="px-6 py-2 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700 transition" 
                    @click="nextStep">
                    Selanjutnya →
                </button>
            </template>

            <template x-if="step === total">
                <button type="submit" 
                    class="px-6 py-2 bg-green-500 text-white rounded shadow hover:bg-green-600 transition">
                    ✅ Selesai & Kirim
                </button>
            </template>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
function quizForm() {
    return {
        step: 1,
        total: {{ count($questions) }},
        nextStep() {
            if (this.step < this.total) this.step++;
        },
        prevStep() {
            if (this.step > 1) this.step--;
        },
        submitForm(formEl) {
            formEl.submit(); // submit form yg benar
        }
    }
}
</script>
@endsection
