<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\JobPost;
use App\Services\AIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\Storage;

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
        // 1. Validasi
        $request->validate([
            'cv' => 'required|mimes:pdf|max:2048',
            'job_post_id' => 'required|exists:job_posts,id'
        ]);

        $existingApplication = Candidate::where('user_id', Auth::id())
            ->where('job_post_id', $request->job_post_id)
            ->first();

        if ($existingApplication) {
            return redirect()->route('candidates.index')->with('error', 'Kamu sudah melamar di lowongan ini!');
        }

        // --- MULAI PERUBAHAN UNTUK SUPABASE & VERCEL ---

        // 2. Simpan File ke Supabase Storage
        $file = $request->file('cv');
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Upload langsung ke bucket Supabase menggunakan disk 'supabase' yang sudah kita buat
        $path = Storage::disk('supabase')->putFileAs('', $file, $fileName);

        // 3. Ambil Detail Lowongan
        $job = JobPost::findOrFail($request->job_post_id);

        // 4. Parse PDF (Gunakan folder /tmp karena PDF Parser butuh akses file lokal di server)
        $tempPath = '/tmp/' . $fileName;
        file_put_contents($tempPath, file_get_contents($file->getRealPath()));

        $parser = new Parser();
        $pdf = $parser->parseFile($tempPath);
        $text = $pdf->getText();

        // Hapus file sementara di /tmp setelah di-parse agar tidak memenuhi disk serverless
        if (file_exists($tempPath)) {
            unlink($tempPath);
        }

        // --- SELESAI PERUBAHAN ---

        // 5. Jalankan AI
        $aiResult = $aiService->analyzeCV($text, $job->required_skills);

        // 6. Simpan ke Database
        Candidate::create([
            'user_id'     => Auth::id(),
            'job_post_id' => $job->id,
            'name'        => $aiResult['name'] ?? 'Unknown',
            'email'       => $aiResult['email'] ?? null,
            'phone'       => $aiResult['phone'] ?? null,
            'cv_file'     => $path, // Ini sekarang menyimpan path di Supabase
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
    public function destroy(Candidate $candidate)
    {
        if ($candidate->user_id !== Auth::id()) {
            return back()->with('error', 'Kamu tidak punya akses untuk melakukan ini.');
        }

        // Hapus file dari disk Supabase
        if ($candidate->cv_file && Storage::disk('supabase')->exists($candidate->cv_file)) {
            Storage::disk('supabase')->delete($candidate->cv_file);
        }

        $candidate->delete();

        return redirect()->route('candidates.index')->with('success', 'Lamaran berhasil dibatalkan.');
    }

    public function availableJobs()
    {
        $jobs = JobPost::with('candidates')
            ->where('deadline', '>=', now()->startOfDay())
            ->latest()
            ->get();

        return view('candidates.available_jobs', compact('jobs'));
    }

    public function updateStatus(Request $request, Candidate $candidate)
    {
        $request->validate([
            'status' => 'required|in:pending,interview,rejected'
        ]);

        $candidate->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status ' . $candidate->name . ' berhasil diperbarui ke ' . strtoupper($request->status));
    }
}
