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
        $answers = Answer::with('question')->where('user_id', Auth::id())->get();
        return view('answers.index', compact('answers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $questions = Question::all();
        return view('answers.create', compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $questions = Question::all();
        $data = $request->input('answers');

        // Hapus jawaban lama user (jika ingin 1x tes saja)
        Answer::where('user_id', $user->id)->delete();

        $scores = [
            'multimedia' => 0,
            'tkj' => 0,
            'rpl' => 0,
            'umum' => 0,
        ];

        foreach ($questions as $q) {
            $opt = $data[$q->id] ?? null;
            if (!$opt) continue;
            $sub = $q['option_' . $opt . '_sub'];
            $scores[$sub]++;
            Answer::create([
                'user_id' => $user->id,
                'question_id' => $q->id,
                'chosen_option' => $opt,
                'sub' => $sub,
            ]);
        }

        // Simpan hasil ke tabel results
        Result::updateOrCreate(
            ['user_id' => $user->id],
            [
                'multimedia_score' => $scores['multimedia'],
                'tkj_score' => $scores['tkj'],
                'rpl_score' => $scores['rpl'],
                'umum_score' => $scores['umum'],
            ]
        );

        // Redirect to results page
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
