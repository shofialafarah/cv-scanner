<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Kirim Lamaran | AI Scanner</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&display=swap"
        rel="stylesheet">
    <style>
        * {
            font-family: 'Bricolage Grotesque', sans-serif;
        }
    </style>
</head>

<body class="bg-[#0B0F1A] text-slate-200 flex items-center justify-center min-h-screen p-6 selection:bg-indigo-500/30">

    <div
        class="bg-[#161B2D] border border-slate-800 p-10 rounded-[2.5rem] shadow-2xl w-full max-w-md relative overflow-hidden group">
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-indigo-600/10 blur-[80px] rounded-full"></div>

        <div class="relative">
            <div class="mb-8 text-center">
                <span
                    class="inline-block px-4 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-[10px] font-black uppercase tracking-widest mb-4">
                    Applying for: {{ $job->title ?? 'Position' }}
                </span>

                {{-- <div
                    class="inline-flex items-center justify-center w-16 h-16 bg-white/5 rounded-2xl mb-4 border border-white/10">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </div> --}}
                <h1 class="text-3xl font-black text-white mb-2">Upload CV</h1>
                <p class="text-slate-400 text-sm px-4">Pastikan CV dalam format PDF agar AI dapat menganalisis skill-mu
                    dengan akurat.</p>
            </div>

            @if ($errors->any())
                ...
            @endif

            <form id="uploadForm" action="{{ route('candidates.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                <input type="hidden" name="job_post_id" value="{{ request('job_post_id') }}">

                <div class="space-y-3">
                    <label class="block text-sm font-bold text-slate-300 ml-1 flex justify-between">
                        Curriculum Vitae
                        <span class="text-indigo-400 font-normal text-[10px]">PDF ONLY</span>
                    </label>

                    <div class="relative group cursor-pointer">
                        <input type="file" name="cv" id="cvInput" accept=".pdf"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" required>
                        <div id="fileDisplay"
                            class="bg-slate-900/50 rounded-2xl border-2 border-dashed border-slate-800 p-6 text-center group-hover:border-indigo-500/50 transition-all">
                            <div id="fileIcon" class="mb-2 flex justify-center">
                                <svg class="w-8 h-8 text-slate-600 group-hover:text-indigo-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <p id="fileName" class="text-xs text-slate-500 font-medium">Klik atau tarik file PDF ke
                                sini</p>
                        </div>
                    </div>
                    <p class="text-[10px] text-slate-500 ml-1 italic">* Maksimal ukuran file 2MB</p>
                </div>

                <div class="pt-4 text-center">
                    <button type="submit" id="submitBtn"
                        class="group relative w-full bg-indigo-600 text-white font-black py-4 px-6 rounded-2xl transition-all duration-300 hover:bg-indigo-500 shadow-xl shadow-indigo-500/20 overflow-hidden">
                        <span id="btnText" class="relative z-10 flex items-center justify-center gap-2">
                            Kirim Lamaran
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </span>
                        <div id="loadingOverlay"
                            class="absolute inset-0 bg-slate-900 translate-y-full transition-transform duration-500 ease-out">
                        </div>
                    </button>

                    <a href="{{ route('candidates.available') }}"
                        class="inline-block mt-6 text-xs font-bold text-slate-500 hover:text-indigo-400 transition-colors">
                        &larr; Batalkan & Kembali
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

        document.getElementById('cvInput').onchange = function() {
            let fileName = this.files[0].name;
            document.getElementById('fileName').innerText = fileName;
            document.getElementById('fileName').classList.replace('text-slate-500', 'text-indigo-400');
            document.getElementById('fileDisplay').classList.add('border-indigo-500/50', 'bg-indigo-500/5');
            document.getElementById('fileIcon').innerHTML = `
        <svg class="w-8 h-8 text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A1 1 0 0112 2.586L15.414 6A1 1 0 0116 6.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
        </svg>
    `;
        };
    </script>
</body>

</html>
