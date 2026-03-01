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
    Route::patch('/candidates/{candidate}/status', [CandidateController::class, 'updateStatus'])->name('candidates.updateStatus');
});

// --- AREA KANDIDAT & UMUM (Auth) ---
Route::middleware(['auth'])->group(function () {
    // 1. Yang URL-nya 'fix' (tulisan tetap) taruh di paling atas
    Route::get('/candidates', [CandidateController::class, 'index'])->name('candidates.index');
    Route::get('/candidates/apply', [CandidateController::class, 'create'])->name('candidates.create');
    Route::get('/available-jobs', [CandidateController::class, 'availableJobs'])->name('candidates.available');
    
    // 2. Yang pakai POST (simpan data)
    Route::post('/candidates/store', [CandidateController::class, 'store'])->name('candidates.store');

    // 3. Yang pakai {parameter} (ID angka) taruh di paling bawah
    Route::get('/candidates/{candidate}', [CandidateController::class, 'show'])->name('candidates.show');
    Route::delete('/candidates/{candidate}', [CandidateController::class, 'destroy'])->name('candidates.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/gas-migrate', function () {
    try {
        Artisan::call('migrate:fresh', ['--force' => true]);
        return "Migrasi Berhasil! Berikut detailnya: <br><pre>" . Artisan::output() . "</pre>";
    } catch (\Exception $e) {
        return "❌ Gagal Migrate: " . $e->getMessage();
    }
});