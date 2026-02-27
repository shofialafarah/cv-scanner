<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\CandidateController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Artisan;

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
    Route::delete('/jobs/{job}', [JobPostController::class, 'destroy'])->name('jobs.destroy');
});

// --- AREA KANDIDAT & UMUM (Auth) ---
Route::middleware(['auth'])->group(function () {
    Route::get('/candidates', [CandidateController::class, 'index'])->name('candidates.index');
    
    Route::get('/candidates/apply', [CandidateController::class, 'create'])->name('candidates.create');
    Route::post('/candidates/store', [CandidateController::class, 'store'])->name('candidates.store');
    Route::get('/candidates/{candidate}', [CandidateController::class, 'show'])->name('candidates.show');
    Route::get('/available-jobs', [CandidateController::class, 'availableJobs'])->name('candidates.available');
});
require __DIR__.'/auth.php';

Route::get('/gas-migrate', function () {
    try {
        Artisan::call('migrate:fresh', ['--force' => true]);
        return "Migrasi Berhasil! Berikut detailnya: <br><pre>" . Artisan::output() . "</pre>";
    } catch (\Exception $e) {
        return "❌ Gagal Migrate: " . $e->getMessage();
    }
});