@section('title', 'Riwayat Lamaran')
<x-app-layout>
    <div class="py-12 bg-[#0B0F1A] min-h-screen font-sans selection:bg-indigo-500/30">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <div class="flex justify-between items-end mb-6">
                    <div>
                        <h2 class="text-4xl font-black text-white tracking-tight">Riwayat Lamaran</h2>
                        <p class="text-slate-500 text-sm mt-2">Pantau status analisis AI untuk setiap lamaranmu.</p>
                    </div>
                    <span
                        class="bg-indigo-500/10 text-indigo-400 text-[10px] font-black px-4 py-2 rounded-xl border border-indigo-500/20 uppercase tracking-widest">
                        {{ $applications->count() }} Total Lamaran
                    </span>
                </div>

                <div class="flex items-center justify-between gap-4">
    <div class="flex items-center gap-2 p-1.5 bg-[#161B2D] border border-slate-800 rounded-2xl w-fit">
        <a href="{{ route('candidates.index') }}"
            class="px-6 py-2.5 rounded-xl text-xs font-black transition-all {{ request()->routeIs('candidates.index') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-slate-500 hover:text-slate-300' }}">
            LAMARAN SAYA
        </a>
        <a href="{{ route('candidates.available') }}"
            class="px-6 py-2.5 rounded-xl text-xs font-black transition-all {{ request()->routeIs('candidates.available') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20' : 'text-slate-500 hover:text-slate-300' }}">
            CARI LOWONGAN
        </a>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="flex items-center gap-2 px-5 py-2.5 rounded-2xl text-xs font-black text-red-400 hover:bg-red-500/10 border border-transparent hover:border-red-500/20 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            LOGOUT
        </button>
    </form>
</div>
            </div>

            <div class="grid grid-cols-1 gap-6">
                @forelse($applications as $app)
                    <div
                        class="bg-[#161B2D] rounded-[2rem] shadow-2xl hover:shadow-indigo-500/5 hover:-translate-y-1 transition-all duration-300 border border-slate-800 overflow-hidden group">
                        <div class="p-8">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                                <div class="flex items-center gap-5">
                                    <div
                                        class="p-4 bg-indigo-500/10 rounded-2xl text-indigo-400 border border-indigo-500/20 group-hover:scale-110 transition-transform">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3
                                            class="text-2xl font-bold text-white group-hover:text-indigo-400 transition-colors">
                                            {{ $app->jobPost->title }}</h3>
                                        <p class="text-sm text-slate-500 mt-1 flex items-center">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v14a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            Dilamar pada {{ $app->created_at->translatedFormat('d F Y') }}
                                        </p>
                                    </div>
                                </div>

                                <div
                                    class="flex items-center gap-6 bg-slate-900/50 p-4 rounded-2xl border border-slate-800">
                                    <div class="text-right border-r border-slate-800 pr-6">
                                        <div class="text-3xl font-black text-indigo-400 leading-none">
                                            {{ $app->score }}%</div>
                                        <div
                                            class="text-[10px] uppercase tracking-[0.2em] text-slate-500 font-black mt-1">
                                            Match Score</div>
                                    </div>

                                    <div>
                                        @if ($app->status == 'interview')
                                            <span
                                                class="px-4 py-2 rounded-xl bg-emerald-500/10 text-emerald-400 text-[10px] font-black border border-emerald-500/20 uppercase tracking-widest">INTERVIEW</span>
                                        @elseif($app->status == 'rejected')
                                            <span
                                                class="px-4 py-2 rounded-xl bg-red-500/10 text-red-400 text-[10px] font-black border border-red-500/20 uppercase tracking-widest">DITOLAK</span>
                                        @else
                                            <span
                                                class="px-4 py-2 rounded-xl bg-amber-500/10 text-amber-400 text-[10px] font-black border border-amber-500/20 uppercase tracking-widest">REVIEW
                                                AI</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 flex items-center justify-between pt-6 border-t border-slate-800/50">
                                <div
                                    class="flex items-center text-slate-400 italic text-sm line-clamp-1 flex-1 mr-8 font-light">
                                    <svg class="w-5 h-5 mr-2 text-indigo-500/50" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z">
                                        </path>
                                    </svg>
                                    "{{ $app->ai_summary }}"
                                </div>
                                <a href="{{ route('candidates.show', $app->id) }}"
                                    class="inline-flex items-center px-6 py-3 bg-white text-[#0B0F1A] rounded-xl font-black text-xs hover:bg-indigo-500 hover:text-white transition-all transform active:scale-95 shadow-xl shadow-white/5">
                                    LIHAT DETAIL
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-[#161B2D] rounded-[3rem] p-20 text-center border-2 border-dashed border-slate-800">
                        <div class="inline-flex p-6 bg-indigo-500/5 rounded-full mb-6 border border-indigo-500/10">
                            <svg class="w-16 h-16 text-slate-700" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black text-white mb-2">Belum Ada Lamaran</h3>
                        <p class="text-slate-500 mb-10 max-w-xs mx-auto">Upload CV-mu sekarang dan biarkan keajaiban AI
                            bekerja untukmu!</p>
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center px-10 py-4 bg-indigo-600 text-white rounded-2xl font-black hover:bg-indigo-500 transition shadow-2xl shadow-indigo-500/20 transform hover:-translate-y-1">
                            Cari Lowongan Sekarang
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
