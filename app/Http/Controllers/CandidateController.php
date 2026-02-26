<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\JobPost;
use App\Services\AIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Smalot\PdfParser\Parser;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cek apakah user sudah login (sebenarnya bisa pakai middleware 'auth' di route)
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil lamaran berdasarkan user_id (jauh lebih akurat daripada email)
        $applications = Candidate::where('user_id', Auth::id())
            ->with('jobPost')
            ->latest()
            ->get();

        return view('candidates.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Ambil job_post_id dari URL (?job_post_id=1)
        $jobId = $request->query('job_post_id');

        // Cari data lowongannya untuk ditampilkan di halaman upload (opsional)
        $job = JobPost::find($jobId);

        return view('candidates.create', compact('job'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, AIService $aiService)
    {
        // 1. Validasi: Pastikan job_post_id ada
        $request->validate([
            'cv' => 'required|mimes:pdf|max:2048',
            'job_post_id' => 'required|exists:job_posts,id'
        ]);

        // 2. Simpan File
        $path = $request->file('cv')->store('cvs', 'public');

        // 3. Ambil Detail Lowongan (untuk dikirim ke AI)
        $job = JobPost::findOrFail($request->job_post_id);

        // 4. Parse PDF
        $parser = new Parser();
        $pdf = $parser->parseFile(storage_path('app/public/' . $path));
        $text = $pdf->getText();

        // 5. Jalankan AI dengan menyertakan Required Skills dari database
        // Kita kirim required_skills agar AI bisa membandingkan secara spesifik
        $aiResult = $aiService->analyzeCV($text, $job->required_skills);

        // 6. Simpan ke Database
        Candidate::create([
            'user_id'     => Auth::id(), // WAJIB: Simpan siapa yang login
            'job_post_id' => $job->id, // HUBUNGAN KE LOWONGAN
            'name'        => $aiResult['name'] ?? 'Unknown',
            'email'       => $aiResult['email'] ?? null,
            'phone'       => $aiResult['phone'] ?? null,
            'cv_file'     => $path,
            'skills'      => $aiResult['skills'] ?? [],
            'score'       => $aiResult['score'] ?? 0,
            'ai_summary'  => $aiResult['summary'] ?? null,
            'parsed_data' => $aiResult
        ]);

        return redirect()->route('candidates.index')->with('success', 'Lamaran berhasil terkirim dan dianalisis oleh AI!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate)
    {
        // Pastikan data skills di-decode jika formatnya string JSON
        return view('candidates.show', compact('candidate'));
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
    public function update(Request $request, Candidate $candidate)
    {
        $request->validate([
            'status' => 'required|in:pending,interview,rejected'
        ]);

        $candidate->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status kandidat berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
