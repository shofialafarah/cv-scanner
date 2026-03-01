@section('title', 'Kirim Lamaran: ' . ($job->title ?? 'Position'))

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('candidates.available') }}" 
               class="p-2 bg-slate-800 rounded-xl text-slate-400 hover:text-white transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h2 class="font-black text-2xl text-white tracking-tight uppercase">
                Kirim Lamaran
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-[#0B0F1A] min-h-screen">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Card Utama --}}
            <div class="bg-[#161B2D] border border-slate-800 p-10 rounded-[2.5rem] shadow-2xl relative overflow-hidden group">
                {{-- Efek Cahaya --}}
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-indigo-600/10 blur-[80px] rounded-full"></div>

                <div class="relative z-10">
                    <div class="mb-8 text-center">
                        <span class="inline-block px-4 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-[10px] font-black uppercase tracking-widest mb-4">
                            Posisi: {{ $job->title ?? 'Position' }}
                        </span>
                        <h1 class="text-3xl font-black text-white mb-2">Upload CV</h1>
                        <p class="text-slate-400 text-sm px-4">Pastikan CV dalam format PDF agar AI dapat menganalisis kualifikasimu dengan akurat.</p>
                    </div>

                    {{-- Menampilkan Error Validasi --}}
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 text-sm rounded-2xl">
                            <ul class="list-disc ml-5 font-bold">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="uploadForm" action="{{ route('candidates.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <input type="hidden" name="job_post_id" value="{{ request('job_post_id') }}">

                        <div class="space-y-3">
                            <label class="block text-sm font-black text-slate-500 uppercase tracking-widest ml-1 flex justify-between">
                                Curriculum Vitae
                                <span class="text-indigo-400 font-mono text-[10px]">PDF ONLY</span>
                            </label>

                            <div class="relative group cursor-pointer">
                                <input type="file" name="cv" id="cvInput" accept=".pdf"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" required>
                                
                                <div id="fileDisplay"
                                    class="bg-slate-900/50 rounded-2xl border-2 border-dashed border-slate-800 p-8 text-center group-hover:border-indigo-500/50 transition-all">
                                    <div id="fileIcon" class="mb-3 flex justify-center">
                                        <svg class="w-10 h-10 text-slate-600 group-hover:text-indigo-400 transition-colors" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <p id="fileName" class="text-sm text-slate-500 font-bold uppercase tracking-tight">
                                        Klik atau tarik file PDF ke sini
                                    </p>
                                </div>
                            </div>
                            <p class="text-[10px] text-slate-600 ml-1 italic">* Maksimal ukuran file 2MB</p>
                        </div>

                        <div class="pt-4 text-center">
                            <button type="submit" id="submitBtn"
                                class="group relative w-full bg-indigo-600 text-white font-black py-5 px-6 rounded-2xl transition-all duration-300 hover:bg-indigo-500 shadow-xl shadow-indigo-500/20 overflow-hidden tracking-[0.2em] uppercase text-sm">
                                <span id="btnText" class="relative z-10 flex items-center justify-center gap-3">
                                    Kirim Lamaran
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </span>
                                <div id="loadingOverlay"
                                    class="absolute inset-0 bg-slate-900 translate-y-full transition-transform duration-500 ease-out">
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-footer />

    <script>
        document.getElementById('uploadForm').onsubmit = function() {
            let btn = document.getElementById('submitBtn');
            let btnText = document.getElementById('btnText');
            let overlay = document.getElementById('loadingOverlay');

            overlay.classList.remove('translate-y-full');
            btnText.innerHTML = `
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                AI Sedang Menganalisis...
            `;
            btn.classList.add('cursor-not-allowed');
        };

        document.getElementById('cvInput').onchange = function() {
            if (this.files.length > 0) {
                let fileName = this.files[0].name;
                document.getElementById('fileName').innerText = fileName;
                document.getElementById('fileName').classList.replace('text-slate-500', 'text-indigo-400');
                document.getElementById('fileDisplay').classList.add('border-indigo-500/50', 'bg-indigo-500/5');
                document.getElementById('fileIcon').innerHTML = `
                    <svg class="w-10 h-10 text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A1 1 0 0112 2.586L15.414 6A1 1 0 0116 6.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                    </svg>
                `;
            }
        };
    </script>
</x-app-layout>