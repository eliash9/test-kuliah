@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-3xl">
    <div class="bg-white rounded-2xl shadow p-6">
        <h1 class="text-2xl font-bold mb-4 text-indigo-700">Tes Minat</h1>

        <form action="{{ route('test.finish') }}" method="POST" x-data="quiz()" x-ref="testForm" @submit.prevent="submitForm($el)">
            @csrf

            <template x-for="(q, idx) in questions" :key="q.id">
                <div x-show="step===idx" class="space-y-4">
                    <h2 class="text-lg font-semibold" x-text="(idx+1)+'. '+q.text"></h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <template x-for="opt in q.options" :key="opt.id">
                            <label class="border rounded-xl p-4 flex items-center gap-4 hover:border-indigo-400 cursor-pointer transition"
                                   @click="choose(q.id, opt.id)">
                                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-indigo-50 text-indigo-600">
                                    <!-- icon placeholder -->
                                    <svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                        <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7'/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-medium" x-text="opt.text"></div>
                                    <div class="text-xs text-gray-500" x-text="opt.subject?.name ?? 'Subject'"></div>
                                </div>
                            </label>
                        </template>
                    </div>
                </div>
            </template>

            <!-- hidden inputs to submit -->
            <template x-for="(val, key) in answers" :key="key">
                <input type="hidden" :name="`answers[${key}]`" :value="val">
            </template>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
function quiz(){
    return {
        step: 0,
        answers: {},
        questions: @js($quizData),
        choose(qid, oid){
            this.answers[qid] = oid;
            if(this.step < this.questions.length-1){
                this.step++;
            } else {
                // submit when last answered
                this.$refs.testForm.submit();
            }
        },
        submitForm(form){ form.submit(); }
    }
}
</script>
@endsection
