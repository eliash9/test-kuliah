<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\AdminResultController;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Protected routes - only accessible to authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->isAdmin()) {
            return view('dashboard');
        } else {
            return view('dashboard');
        }
    })->name('dashboard');

    // Route khusus admin
    Route::middleware('admin')->group(function () {
        Route::resource('questions', QuestionController::class);
        Route::resource('subjects', SubjectController::class);
        Route::get('/adminresults', [AdminResultController::class, 'index'])->name('adminresults.index');
        Route::get('/adminresults/{user}', [AdminResultController::class, 'show'])->name('adminresults.show');
        Route::get('/adminresults/{user}/print-pdf', [AdminResultController::class, 'printPdf'])->name('adminresults.printPdf');
    });

    // Route khusus mahasiswa
    Route::middleware('mahasiswa')->group(function () {
        Route::resource('answers', AnswerController::class)->only(['index', 'create', 'store']);
        Route::get('/results', [ResultController::class, 'index'])->name('results.index');
        Route::get('/results/show', [ResultController::class, 'show'])->name('results.show');
        Route::get('/results/print-pdf', [ResultController::class, 'printPdf'])->name('results.printPdf');
    });
});
