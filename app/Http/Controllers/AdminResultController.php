<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Result;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        // Ambil semua user yang memiliki jawaban
        $userIds = Answer::select('user_id')->distinct()->pluck('user_id');
        $users = User::whereIn('id', $userIds)->get();

        return view('adminresults.index', compact('users'));
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
    public function show(User $user)
    {
        $authUser = Auth::user();
        if (!$authUser->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }
        // Aggregate dynamic scores for the selected user
        $answers = Answer::with('option.subject')
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

        return view('adminresults.show', compact('user','labels','scores','recommendedSubjects'));
    }

    /**
     * Generate PDF of the result for admin.
     */
    public function printPdf(User $user)
    {
        $authUser = Auth::user();
        if (!$authUser->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }
        // Aggregate dynamic scores for the selected user
        $answers = Answer::with('option.subject')
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
            'user' => $user,
            'labels' => $labels,
            'scores' => $scores,
            'recommendedSubjects' => $recommendedSubjects,
        ];

        // Gunakan PDF view yang sama dengan user untuk konsistensi
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
