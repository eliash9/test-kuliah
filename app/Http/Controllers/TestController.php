<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Answer;

class TestController extends Controller
{
    public function instructions()
    {
        return view('test.instructions');
    }

    public function start()
    {
        $questions = Question::with('options.subject')->get();
        $quizData = $questions->map(function ($q) {
            return [
                'id' => $q->id,
                'text' => $q->text,
                'options' => $q->options->map(function ($o) {
                    return [
                        'id' => $o->id,
                        'text' => $o->text,
                        'subject' => [
                            'name' => optional($o->subject)->name,
                        ],
                    ];
                })->values(),
            ];
        })->values();

        return view('test.start', [
            'questions' => $questions,
            'quizData' => $quizData,
        ]);
    }

    public function finish(Request $request)
    {
        $data = $request->validate([
            'answers' => 'required|array',
        ]);

        // Store selections in session for later commit
        $request->session()->put('pending_answers', $data['answers']);

        if (Auth::check()) {
            // Commit immediately for logged-in users
            $this->commitAnswers(Auth::id(), $data['answers']);
            return redirect()->route('results.index')->with('success', 'Jawaban tersimpan.');
        }

        // Tampilkan halaman selesai dengan CTA login/daftar untuk melihat hasil
        return view('test.finished');
    }

    public static function commitAnswers(int $userId, array $answers): void
    {
        $questions = Question::with('options')->get();
        Answer::where('user_id', $userId)->delete();
        foreach ($questions as $q) {
            $optionId = $answers[$q->id] ?? null;
            if (!$optionId) continue;
            $opt = $q->options->firstWhere('id', (int)$optionId);
            if (!$opt) continue;
            Answer::create([
                'user_id' => $userId,
                'question_id' => $q->id,
                'option_id' => $opt->id,
            ]);
        }
    }
}
