<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Ambil lowongan terbaru untuk ditampilkan di depan
        $jobs = JobPost::latest()->get();
        return view('welcome', compact('jobs'));
    }
}
