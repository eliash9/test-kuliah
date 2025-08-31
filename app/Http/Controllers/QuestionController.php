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
    return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required',
            'option_a' => 'required',
            'option_a_sub' => 'required',
            'option_b' => 'required',
            'option_b_sub' => 'required',
            'option_c' => 'required',
            'option_c_sub' => 'required',
            'option_d' => 'required',
            'option_d_sub' => 'required',
        ]);
        Question::create($validated);
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
    return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'text' => 'required',
            'option_a' => 'required',
            'option_a_sub' => 'required',
            'option_b' => 'required',
            'option_b_sub' => 'required',
            'option_c' => 'required',
            'option_c_sub' => 'required',
            'option_d' => 'required',
            'option_d_sub' => 'required',
        ]);
        $question->update($validated);
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
