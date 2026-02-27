<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;

class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua lowongan beserta jumlah kandidat yang melamar
        $jobs = JobPost::withCount('candidates')->latest()->get();
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required|date|after_or_equal:today',
            'required_skills' => 'required'
        ], [
            'deadline.after_or_equal' => 'Masa iya tenggat waktunya kemarin? Yuk, pilih tanggal hari ini atau besok!',
            'deadline.date' => 'Format tanggal salah ya!',
        ]);

        JobPost::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'required_skills' => $request->required_skills
                ? explode(',', $request->required_skills)
                : []
        ]);

        return redirect()->route('jobs.index')
            ->with('success', 'Job berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPost $job)
    {
        $candidates = $job->candidates()->orderBy('score', 'desc')->get();

        $daysLeft = (int) now()->diffInDays(\Carbon\Carbon::parse($job->deadline), false);

        $isUrgent = $daysLeft <= 2 && $daysLeft >= 0;

        return view('jobs.show', compact('job', 'candidates', 'isUrgent', 'daysLeft'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobPost $job)
    {
        return view('jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobPost $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'deadline' => 'required|date|after_or_equal:today',
            'required_skills' => 'required',
        ], [
            'deadline.after_or_equal' => 'Masa iya tenggat waktunya kemarin? Yuk, pilih tanggal hari ini atau besok!',
            'deadline.date' => 'Format tanggal salah ya!',
        ]);

        // Jika di database kamu simpan sebagai array (JSON)
        if (is_string($request->required_skills)) {
            $validated['required_skills'] = array_map('trim', explode(',', $request->required_skills));
        }

        $job->update($validated);

        return redirect()->route('jobs.index')->with('success', 'Lowongan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPost $job)
    {
        // Cek dulu, kalau sudah ada pelamar, jangan izinkan hapus permanen
        if ($job->candidates()->count() > 0) {
            return back()->with('error', 'Gagal! Lowongan ini sudah memiliki pelamar. Gunakan fitur "Tutup Lowongan" saja agar data pelamar tetap tersimpan.');
        }

        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Lowongan kosong berhasil dihapus.');
    }
}
