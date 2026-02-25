<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\JobPost;
use App\Services\AIService;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $candidates = Candidate::latest()->get();
        return view('candidates.index', compact('candidates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil semua data lowongan
        $jobs = JobPost::all();

        // Mengirim variabel $jobs ke view candidates.create
        return view('candidates.create', compact('jobs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, AIService $aiService)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf|max:2048'
        ]);

        $path = $request->file('cv')->store('cvs', 'public');

        $parser = new Parser();
        $pdf = $parser->parseFile(storage_path('app/public/' . $path));
        $text = $pdf->getText();

        $aiResult = $aiService->analyzeCV($text);

        Candidate::create([
            'name' => $aiResult['name'] ?? null,
            'email' => $aiResult['email'] ?? null,
            'phone' => $aiResult['phone'] ?? null,
            'cv_file' => $path,
            'skills' => $aiResult['skills'] ?? [],
            'score' => $aiResult['score'] ?? null,
            'ai_summary' => $aiResult['summary'] ?? null,
            'parsed_data' => $aiResult
        ]);

        return redirect()->route('candidates.index')
            ->with('success', 'CV berhasil dianalisis oleh AI!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
