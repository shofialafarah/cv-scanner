<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
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
        return view('candidates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { {
            $request->validate([
                'cv' => 'required|mimes:pdf|max:2048'
            ]);

            // Simpan file
            $path = $request->file('cv')->store('cvs', 'public');

            // Ambil teks dari PDF
            $parser = new Parser();
            $pdf = $parser->parseFile(storage_path('app/public/' . $path));
            $text = $pdf->getText();

            // Simpan ke DB (Sementara data AI masih kosong)
            Candidate::create([
                'cv_file' => $path,
                'name' => 'Processing...',
                'email' => 'Processing...',
                'parsed_data' => ['raw_text' => $text]
            ]);

            return redirect()->route('candidates.index')
                ->with('success', 'CV berhasil diupload!');
        }
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
