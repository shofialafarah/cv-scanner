<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Kirim Lamaran | AI Scanner</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Bricolage Grotesque', sans-serif; }
    </style>
</head>

<body class="bg-[#0B0F1A] text-slate-200 flex items-center justify-center min-h-screen p-6 selection:bg-indigo-500/30">

    <div class="bg-[#161B2D] border border-slate-800 p-10 rounded-[2.5rem] shadow-2xl w-full max-w-md relative overflow-hidden group">
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-indigo-600/10 blur-[80px] rounded-full"></div>
        
        <div class="relative">
            <div class="mb-8 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-500/10 rounded-2xl mb-4 border border-indigo-500/20">
                    <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </div>
                <h1 class="text-3xl font-black text-white mb-2">Apply Job</h1>
                <p class="text-slate-400 text-sm">Upload CV terbaikmu, biar AI kami yang bekerja menganalisis keahlianmu secara otomatis.</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 text-xs rounded-2xl">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="uploadForm" action="{{ route('candidates.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <input type="hidden" name="job_post_id" value="{{ request('job_post_id') }}">

                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-300 ml-1">Curriculum Vitae (PDF)</label>
                    <div class="relative group">
                        <input type="file" name="cv" id="cvInput" accept=".pdf"
                            class="block w-full text-sm text-slate-400
                            file:mr-4 file:py-3 file:px-6
                            file:rounded-2xl file:border-0
                            file:text-xs file:font-black
                            file:bg-indigo-600 file:text-white
                            hover:file:bg-indigo-500
                            file:transition-all
                            bg-slate-900/50 rounded-2xl border border-slate-800 p-2 focus:outline-none focus:border-indigo-500/50 transition-colors" required>
                    </div>
                    <p class="text-[10px] text-slate-500 ml-1 italic">* Maksimal ukuran file 2MB</p>
                </div>

                <div class="pt-4 text-center">
                    <button type="submit" id="submitBtn"
                        class="group relative w-full bg-white text-[#0B0F1A] font-black py-4 px-6 rounded-2xl transition-all duration-300 hover:bg-indigo-500 hover:text-white shadow-xl shadow-white/5 overflow-hidden">
                        <span id="btnText" class="relative z-10 flex items-center justify-center gap-2">
                            Kirim Lamaran 
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </span>
                        <div id="loadingOverlay" class="absolute inset-0 bg-indigo-600 translate-y-full transition-transform duration-500 ease-out"></div>
                    </button>
                    
                    <a href="{{ route('home') }}" class="inline-block mt-6 text-xs font-bold text-slate-500 hover:text-slate-300 transition-colors">
                        &larr; Kembali ke Daftar Lowongan
                    </a>
                </div>
            </form>
        </div>
    </div>

    

    <script>
        document.getElementById('uploadForm').onsubmit = function() {
            let btn = document.getElementById('submitBtn');
            let btnText = document.getElementById('btnText');
            let overlay = document.getElementById('loadingOverlay');
            
            // Efek Loading Animasi
            overlay.classList.remove('translate-y-full');
            btnText.innerHTML = `
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                AI sedang menganalisis CV...
            `;
            btn.classList.add('cursor-not-allowed');
            btn.style.color = "white";
        };
    </script>
</body>
</html>