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
        $jobs = JobPost::latest()->get();
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
            'required_skills' => 'nullable'
        ]);

        JobPost::create([
            'title' => $request->title,
            'description' => $request->description,
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
        // Mengambil kandidat yang melamar khusus di lowongan ini
        $candidates = $job->candidates()->orderBy('score', 'desc')->get();

        return view('jobs.show', compact('job', 'candidates'));
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
