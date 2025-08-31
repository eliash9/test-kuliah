<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Subject;
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
        
        // Hanya admin yang bisa mengakses
        if (!$user->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }
        
        // Admin dapat melihat semua hasil
        $results = Result::with('user')->get();
        
        return view('adminresults.index', compact('results'));
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
    public function show(Result $result)
    {
        $user = Auth::user();
        
        // Hanya admin yang bisa mengakses
        if (!$user->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }
        
        // Admin dapat melihat semua hasil
        // Tidak perlu pengecekan tambahan untuk admin
        
        // Ambil skor hasil tes
        $labels = ['Multimedia', 'TKJ', 'RPL', 'Umum'];
        $scores = [
            $result->multimedia_score,
            $result->tkj_score,
            $result->rpl_score,
            $result->umum_score,
        ];

        // Cari sub dengan skor tertinggi
        $max = max($scores);
        $maxIndex = array_search($max, $scores);
        $subMap = ['multimedia', 'Jaringan', 'Rekayasa Perangkat Lunak', 'MBKM'];
        $topSub = $subMap[$maxIndex];

        // Rekomendasi mata kuliah
        $recommendedSubjects = Subject::where('name', 'like', '%' . $topSub . '%')->get();

        return view('adminresults.show', [
            'result' => $result,
            'labels' => $labels,
            'scores' => $scores,
            'recommendedSubjects' => $recommendedSubjects,
        ]);
    }

    /**
     * Generate PDF of the result for admin.
     */
    public function printPdf(Result $result)
    {
        $user = Auth::user();
        
        // Hanya admin yang bisa mengakses
        if (!$user->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }
        
        // Ambil skor hasil tes
        $labels = ['Multimedia', 'TKJ', 'RPL', 'Umum'];
        $scores = [
            $result->multimedia_score,
            $result->tkj_score,
            $result->rpl_score,
            $result->umum_score,
        ];

        // Cari sub dengan skor tertinggi
        $max = max($scores);
        $maxIndex = array_search($max, $scores);
        $subMap = ['multimedia', 'Jaringan', 'Rekayasa Perangkat Lunak', 'MBKM'];
        $topSub = $subMap[$maxIndex];

        // Rekomendasi mata kuliah
        $recommendedSubjects = Subject::where('name', 'like', '%' . $topSub . '%')->get();

        $data = [
            'result' => $result,
            'labels' => $labels,
            'scores' => $scores,
            'recommendedSubjects' => $recommendedSubjects,
        ];

        $pdf = Pdf::loadView('adminresults.pdf', $data);
        return $pdf->download('hasil_tes_minat_' . $result->user->name . '.pdf');
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
