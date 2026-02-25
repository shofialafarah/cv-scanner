<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\JobPostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/candidates', [CandidateController::class, 'index'])->name('candidates.index');
Route::get('/candidates/create', [CandidateController::class, 'create'])->name('candidates.create');
Route::post('/candidates', [CandidateController::class, 'store'])->name('candidates.store');

Route::get('/jobs', [JobPostController::class, 'index'])->name('jobs.index');
Route::get('/jobs/create', [JobPostController::class, 'create'])->name('jobs.create');
Route::post('/jobs', [JobPostController::class, 'store'])->name('jobs.store');