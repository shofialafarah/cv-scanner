<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\CandidateController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    $user = Auth::user(); 

    if ($user && $user->role === 'hr') {
        return redirect()->route('jobs.index');
    }
    return redirect()->route('candidates.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- AREA HR ---
Route::middleware(['auth', 'role:hr'])->group(function () {
    Route::resource('jobs', JobPostController::class);
});

// --- AREA KANDIDAT & UMUM (Auth) ---
Route::middleware(['auth'])->group(function () {
    Route::get('/candidates', [CandidateController::class, 'index'])->name('candidates.index');
    
    Route::get('/candidates/apply', [CandidateController::class, 'create'])->name('candidates.create');
    Route::post('/candidates/store', [CandidateController::class, 'store'])->name('candidates.store');

    Route::get('/candidates/{candidate}', [CandidateController::class, 'show'])->name('candidates.show');
});
require __DIR__.'/auth.php';
