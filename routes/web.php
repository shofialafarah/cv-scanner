<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\CandidateController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- AREA HR ---
// Hanya User yang sudah Login DAN punya role 'hr' yang bisa akses
Route::middleware(['auth', 'role:hr'])->group(function () {
    Route::resource('jobs', JobPostController::class);
});

// --- AREA KANDIDAT ---
// User biasa yang sudah login bisa apply
Route::middleware(['auth'])->group(function () {
    Route::get('/apply/{job_post_id}', [CandidateController::class, 'create'])->name('candidates.create');
    Route::post('/apply', [CandidateController::class, 'store'])->name('candidates.store');
});
require __DIR__.'/auth.php';
