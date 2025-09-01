<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Result;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $answers = Answer::with(['question','option.subject'])->where('user_id', Auth::id())->get();
        return view('answers.index', compact('answers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $questions = Question::with('options.subject')->get();
        return view('answers.create', compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $questions = Question::with('options')->get();
        $data = $request->validate([
            'answers' => 'required|array',
        ])['answers'];

        // Hapus jawaban lama user (jika ingin 1x tes saja)
        Answer::where('user_id', $user->id)->delete();

        foreach ($questions as $q) {
            $optionId = $data[$q->id] ?? null;
            if (!$optionId) continue;

            $option = $q->options->firstWhere('id', (int)$optionId);
            if (!$option) continue; // skip invalid option

            Answer::create([
                'user_id' => $user->id,
                'question_id' => $q->id,
                'option_id' => $option->id,
            ]);
        }

        return redirect()->route('results.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        return view('answers.show', compact('answer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        //
    }
}
