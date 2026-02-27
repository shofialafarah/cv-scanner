<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-white tracking-tight">
                Analisis AI: <span class="text-indigo-400">{{ $candidate->name }}</span>
            </h2>
            <a href="{{ route('candidates.index') }}" class="text-xs font-black text-slate-400 hover:text-white transition-all flex items-center gap-2 bg-slate-800/50 px-4 py-2 rounded-xl border border-slate-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                KEMBALI KE RIWAYAT
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-[#0B0F1A] min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="bg-[#161B2D] overflow-hidden shadow-2xl rounded-[2.5rem] p-10 border border-slate-800 relative group">
                <div class="absolute top-0 right-0 p-10 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-32 h-32 text-indigo-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </div>

                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <span class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em]">Overall Compatibility</span>
                            <h3 class="text-xl font-bold text-white mt-1">Ringkasan Analisis</h3>
                        </div>
                        <div class="text-right">
                            <div class="text-5xl font-black text-indigo-400 drop-shadow-[0_0_15px_rgba(99,102,241,0.4)]">
                                {{ $candidate->score }}<span class="text-2xl">%</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-900/50 rounded-3xl p-6 border border-slate-800/50">
                        <p class="text-slate-300 leading-relaxed italic text-lg font-light">
                            " {{ $candidate->ai_summary ?? 'AI tidak memberikan ringkasan.' }} "
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-[#161B2D] p-8 rounded-[2.5rem] border border-slate-800 shadow-xl">
                    <h3 class="font-black text-sm text-slate-400 mb-6 uppercase tracking-widest flex items-center">
                        <span class="w-2 h-2 bg-indigo-500 rounded-full mr-3 animate-pulse"></span>
                        Skills Terdeteksi
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($candidate->skills as $skill)
                            <span class="bg-indigo-500/10 text-indigo-300 px-4 py-2 rounded-xl text-xs font-bold border border-indigo-500/20 hover:bg-indigo-500 hover:text-white transition-all cursor-default">
                                {{ $skill }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="bg-[#161B2D] p-8 rounded-[2.5rem] border border-slate-800 shadow-xl">
                    <h3 class="font-black text-sm text-slate-400 mb-6 uppercase tracking-widest flex items-center">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full mr-3"></span>
                        Informasi Kontak
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between bg-slate-900/40 p-3 rounded-2xl border border-slate-800">
                            <span class="text-xs text-slate-500 font-bold">Email</span>
                            <span class="text-sm text-white font-medium">{{ $candidate->email }}</span>
                        </div>
                        
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $candidate->phone) }}" target="_blank" 
                           class="flex items-center justify-between bg-emerald-500/5 p-3 rounded-2xl border border-emerald-500/10 hover:bg-emerald-500/10 transition-colors group">
                            <span class="text-xs text-slate-500 font-bold">WhatsApp</span>
                            <span class="text-sm text-emerald-400 font-bold group-hover:underline">{{ $candidate->phone }}</span>
                        </a>

                        <a href="{{ asset('storage/' . $candidate->cv_file) }}" target="_blank"
                           class="flex items-center justify-center gap-3 w-full bg-indigo-600 hover:bg-indigo-500 text-white font-black py-4 rounded-2xl transition-all shadow-lg shadow-indigo-900/20 mt-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            BUKA FILE CV ASLI
                        </a>
                    </div>
                </div>
            </div>

            @if (Auth::user()->role === 'hr')
                <div class="bg-indigo-950/20 p-10 rounded-[2.5rem] border-2 border-dashed border-indigo-500/30 mt-10">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-black text-white flex items-center justify-center gap-3">
                            ⚖️ Tentukan Keputusan
                        </h3>
                        <p class="text-slate-400 text-sm mt-2">Keputusan ini akan mengubah status lamaran kandidat secara permanen.</p>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <form action="{{ route('candidates.update', $candidate->id) }}" method="POST" class="w-full sm:w-auto">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="interview">
                            <button type="submit"
                                class="w-full bg-emerald-600 text-white px-10 py-4 rounded-2xl font-black hover:bg-emerald-500 transition-all shadow-xl shadow-emerald-900/20 transform hover:-translate-y-1">
                                PANGGIL INTERVIEW
                            </button>
                        </form>

                        <form action="{{ route('candidates.update', $candidate->id) }}" method="POST" class="w-full sm:w-auto">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit"
                                class="w-full bg-red-600/10 text-red-500 border border-red-600/20 px-10 py-4 rounded-2xl font-black hover:bg-red-600 hover:text-white transition-all transform hover:-translate-y-1">
                                TOLAK LAMARAN
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>