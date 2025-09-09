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
    public function printPdf__(User $user)
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

        // Top info for display and chart label
        $sumScores = array_sum($scores);
        $topIndex = null; $topScore = null; $topLabel = null; $topPercent = 0;
        if (!empty($scores)) {
            $topIndex = array_keys($scores, max($scores))[0];
            $topScore = $scores[$topIndex] ?? 0;
            $topLabel = $labels[$topIndex] ?? null;
            $topPercent = $sumScores > 0 ? round(($topScore / $sumScores) * 100, 1) : 0;
        }

        // Build chart image (PNG) using GD for reliable PDF rendering
        $chartBase64 = null;
        try {
            if (extension_loaded('gd')) {
                $size = 260; $cx = (int)($size/2); $cy = (int)($size/2);
                $outer = 220; // diameter for arc
                $inner = 130; // diameter for donut hole
                $img = imagecreatetruecolor($size, $size);

                // Colors
                $white = imagecolorallocate($img, 255, 255, 255);
                $lightGray = imagecolorallocate($img, 229, 231, 235);
                $textDark = imagecolorallocate($img, 55, 65, 81); // gray-700
                $paletteHex = ['#6366f1','#22c55e','#f59e0b','#ef4444','#06b6d4','#a855f7'];
                $palette = [];
                foreach ($paletteHex as $hex) {
                    $hex = ltrim($hex, '#');
                    $r = hexdec(substr($hex, 0, 2));
                    $g = hexdec(substr($hex, 2, 2));
                    $b = hexdec(substr($hex, 4, 2));
                    $palette[] = imagecolorallocate($img, $r, $g, $b);
                }

                // Background
                imagefilledrectangle($img, 0, 0, $size, $size, $white);

                // If no data, draw a light gray ring
                $sum = $sumScores;
                if ($sum <= 0) {
                    imagefilledarc($img, $cx, $cy, $outer, $outer, 0, 359, $lightGray, IMG_ARC_PIE);
                } else {
                    $start = 0.0; // degrees, 0 at 3 o'clock, clockwise
                    foreach ($scores as $i => $val) {
                        $val = (float)$val;
                        if ($val <= 0) continue;
                        $angle = ($val / $sum) * 360.0;
                        $end = $start + $angle;
                        $color = $palette[$i % count($palette)];
                        imagefilledarc($img, $cx, $cy, $outer, $outer, (int)round($start), (int)round($end), $color, IMG_ARC_PIE);
                        $start = $end;
                    }
                }

                // Cut inner circle for donut effect
                imagefilledellipse($img, $cx, $cy, $inner, $inner, $white);

                // Center text: top label and percent
                $labelText = $topLabel ?? '';
                $percentText = ($sum > 0 && $topScore !== null) ? (round(($topScore / $sum) * 100) . '%') : '0%';
                // Fit label within inner width with ellipsis
                $fontSmall = 3; // built-in bitmap font
                $fontBig = 5;
                $maxPx = $inner - 20; // padding
                $charW = imagefontwidth($fontSmall);
                $charHSmall = imagefontheight($fontSmall);
                $charHBig = imagefontheight($fontBig);
                if ($labelText) {
                    $maxChars = $charW > 0 ? (int)floor($maxPx / $charW) : strlen($labelText);
                    if ($maxChars > 0 && strlen($labelText) > $maxChars) {
                        $labelText = substr($labelText, 0, max(0, $maxChars - 1)) . '…';
                    }
                    $labelW = strlen($labelText) * $charW;
                    $lx = (int)round($cx - ($labelW / 2));
                    $ly = (int)round($cy - ($charHSmall));
                    imagestring($img, $fontSmall, $lx, $ly, $labelText, $textDark);
                }
                $percW = strlen($percentText) * imagefontwidth($fontBig);
                $px = (int)round($cx - ($percW / 2));
                $py = (int)round($cy + 2);
                imagestring($img, $fontBig, $px, $py, $percentText, $textDark);

                // Export to base64
                ob_start();
                imagepng($img);
                $pngData = ob_get_clean();
                imagedestroy($img);
                $chartBase64 = base64_encode($pngData);
            }
        } catch (\Throwable $e) {
            // Leave $chartBase64 as null; SVG fallback in view will handle
        }

        $data = [
            'labels' => $labels,
            'scores' => $scores,
            'recommendedSubjects' => $recommendedSubjects,
            'user' => $user,
            'chartBase64' => $chartBase64,
            'topLabel' => $topLabel,
            'topPercent' => $topPercent,
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
