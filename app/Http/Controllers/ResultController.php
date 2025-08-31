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
        
        // Hanya mahasiswa yang bisa mengakses
        if (!$user->isMahasiswa()) {
            abort(403, 'Akses ditolak.');
        }
        
        // Mahasiswa hanya dapat melihat hasil mereka sendiri
        $results = Result::where('user_id', $user->id)->with('user')->get();
        
        return view('results.index', compact('results'));
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
        
        // Hanya mahasiswa yang bisa mengakses
        if (!$user->isMahasiswa()) {
            abort(403, 'Akses ditolak.');
        }
        
        // Mahasiswa hanya dapat melihat hasil mereka sendiri
        if ($result->user_id != $user->id) {
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

        return view('results.show', [
            'result' => $result,
            'labels' => $labels,
            'scores' => $scores,
            'recommendedSubjects' => $recommendedSubjects,
        ]);
    }

    /**
     * Generate PDF of the result.
     */
    public function printPdf(Result $result)
    {
        $user = Auth::user();
        
        // Hanya mahasiswa yang bisa mengakses
        if (!$user->isMahasiswa()) {
            abort(403, 'Akses ditolak.');
        }
        
        // Mahasiswa hanya dapat melihat hasil mereka sendiri
        if ($result->user_id != $user->id) {
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
        $subMap = ['multimedia', 'tkj', 'rpl', 'umum'];
        $topSub = $subMap[$maxIndex];

        // Rekomendasi mata kuliah
        $recommendedSubjects = Subject::where('name', 'like', '%' . $topSub . '%')->get();

        $data = [
            'result' => $result,
            'labels' => $labels,
            'scores' => $scores,
            'recommendedSubjects' => $recommendedSubjects,
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
