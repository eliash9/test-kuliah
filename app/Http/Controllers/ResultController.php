<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user->isMahasiswa()) {
            abort(403, 'Akses ditolak.');
        }

        // Aggregate dynamic scores per subject from answers
        $answers = \App\Models\Answer::with('option.subject')
            ->where('user_id', $user->id)
            ->get();

        $scores = [];
        foreach ($answers as $a) {
            if (!$a->option || !$a->option->subject) continue;
            $sid = $a->option->subject->id;
            $sname = $a->option->subject->name;
            if (!isset($scores[$sid])) {
                $scores[$sid] = ['subject_id' => $sid, 'subject_name' => $sname, 'score' => 0];
            }
            $scores[$sid]['score']++;
        }

        // Sort by score desc
        usort($scores, fn($a,$b) => $b['score'] <=> $a['score']);

        return view('results.index', [
            'scores' => $scores,
            'user' => $user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = Auth::user();
        if (!$user->isMahasiswa()) {
            abort(403, 'Akses ditolak.');
        }

        $answers = \App\Models\Answer::with('option.subject')
            ->where('user_id', $user->id)
            ->get();

        $bySubject = [];
        foreach ($answers as $a) {
            if (!$a->option || !$a->option->subject) continue;
            $sid = $a->option->subject->id;
            $sname = $a->option->subject->name;
            if (!isset($bySubject[$sid])) {
                $bySubject[$sid] = ['label' => $sname, 'score' => 0, 'subject' => $a->option->subject];
            }
            $bySubject[$sid]['score']++;
        }

        // Top subject
        $sorted = array_values($bySubject);
        usort($sorted, fn($a,$b) => $b['score'] <=> $a['score']);
        $top = $sorted[0] ?? null;

        $recommendedSubjects = [];
        if ($top) {
            // Rekomendasi: semua Subject dengan nama mengandung kata kunci top, atau cukup subject top itu sendiri
            $recommendedSubjects = Subject::where('id', $bySubject[array_key_first($bySubject)]['subject']->id ?? 0)->get();
        }

        $labels = array_map(fn($r) => $r['label'], $sorted);
        $scores = array_map(fn($r) => $r['score'], $sorted);

        return view('results.show', [
            'labels' => $labels,
            'scores' => $scores,
            'recommendedSubjects' => $recommendedSubjects,
            'user' => $user,
        ]);
    }

    /**
     * Generate PDF of the result.
     */
    public function printPdf()
    {
        $user = Auth::user();
        if (!$user->isMahasiswa()) {
            abort(403, 'Akses ditolak.');
        }

        $answers = \App\Models\Answer::with('option.subject')
            ->where('user_id', $user->id)
            ->get();

        $bySubject = [];
        foreach ($answers as $a) {
            if (!$a->option || !$a->option->subject) continue;
            $sid = $a->option->subject->id;
            $sname = $a->option->subject->name;
            if (!isset($bySubject[$sid])) {
                $bySubject[$sid] = ['label' => $sname, 'score' => 0, 'subject' => $a->option->subject];
            }
            $bySubject[$sid]['score']++;
        }
        $sorted = array_values($bySubject);
        usort($sorted, fn($a,$b) => $b['score'] <=> $a['score']);

        $labels = array_map(fn($r) => $r['label'], $sorted);
        $scores = array_map(fn($r) => $r['score'], $sorted);
        $recommendedSubjects = !empty($sorted) ? collect([$sorted[0]['subject']]) : collect();

        $data = [
            'labels' => $labels,
            'scores' => $scores,
            'recommendedSubjects' => $recommendedSubjects,
            'user' => $user,
        ];

        $pdf = Pdf::loadView('results.pdf', $data);
        return $pdf->download('hasil_tes_minat_' . $user->name . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        //
    }
}
