<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $questions = Question::all();
    return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = \App\Models\Subject::all();
        return view('questions.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'text' => 'required|string',
            'options' => 'required|array|min:2',
            'options.*.text' => 'required|string',
            'options.*.subject_id' => 'required|exists:subjects,id',
        ]);

        $question = Question::create(['text' => $data['text']]);
        // Create options
        foreach ($data['options'] as $idx => $opt) {
            $question->options()->create([
                'text' => $opt['text'],
                'subject_id' => $opt['subject_id'],
                'key' => chr(65 + $idx), // A, B, C, ...
            ]);
        }

        return redirect()->route('questions.index')->with('success', 'Soal berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
    return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        $subjects = \App\Models\Subject::all();
        $question->load('options');
        return view('questions.edit', compact('question','subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $data = $request->validate([
            'text' => 'required|string',
            'options' => 'required|array|min:2',
            'options.*.id' => 'nullable|integer',
            'options.*.text' => 'required|string',
            'options.*.subject_id' => 'required|exists:subjects,id',
        ]);

        $question->update(['text' => $data['text']]);

        // Sync options: simple approach - delete old and recreate
        $question->options()->delete();
        foreach ($data['options'] as $idx => $opt) {
            $question->options()->create([
                'text' => $opt['text'],
                'subject_id' => $opt['subject_id'],
                'key' => chr(65 + $idx),
            ]);
        }

        return redirect()->route('questions.index')->with('success', 'Soal berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
    $question->delete();
    return redirect()->route('questions.index')->with('success', 'Soal berhasil dihapus');
    }
}
