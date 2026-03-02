@section('title', 'Ranking AI: ' . $job->title)
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div class="flex items-center gap-3 md:gap-4">
                <a href="{{ route('jobs.index') }}"
                    class="p-2 bg-slate-800 rounded-xl text-slate-400 hover:text-white transition-all border border-slate-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <h2 class="font-black text-lg md:text-2xl text-white tracking-tight uppercase">
                    Detail Lowongan
                </h2>
            </div>

            @if ($isUrgent)
                <div
                    class="animate-pulse bg-red-500/10 border border-red-500/50 text-red-500 px-4 py-2 rounded-xl text-[9px] md:text-[10px] font-black tracking-[0.2em] inline-flex items-center">
                    @if ($daysLeft == 0)
                        ⚠️ DEADLINE HARI INI!
                    @else
                        ⚠️ URGENT: {{ $daysLeft }} HARI LAGI
                    @endif
                </div>
            @endif
        </div>
    </x-slot>

    <div class="py-6 md:py-12 bg-[#0B0F1A] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 md:space-y-8">

            {{-- Info Card --}}
            <div class="bg-[#161B2D] border border-slate-800 rounded-[1.5rem] md:rounded-[2.5rem] p-6 md:p-8 shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 md:p-8 select-none pointer-events-none">
                    <span class="text-slate-800 font-black text-4xl md:text-6xl opacity-20 uppercase">{{ substr($job->title, 0, 2) }}</span>
                </div>

                <div class="relative z-10">
                    <h3 class="text-xl md:text-3xl font-black text-white mb-3 md:mb-4 pr-12">{{ $job->title }}</h3>
                    <p class="text-slate-400 text-sm md:text-base leading-relaxed max-w-3xl mb-6">{{ $job->description }}</p>

                    <div class="flex flex-wrap gap-2">
                        @foreach ($job->required_skills as $skill)
                            <span
                                class="bg-indigo-500/5 text-indigo-400 px-3 md:px-4 py-1.5 rounded-lg md:rounded-xl text-[10px] md:text-xs font-bold border border-indigo-500/10 lowercase font-mono">
                                #{{ $skill }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Table Card --}}
            <div class="bg-[#161B2D] border border-slate-800 rounded-[1.5rem] md:rounded-[2.5rem] overflow-hidden shadow-2xl">
                <div class="p-6 md:p-8 border-b border-slate-800 bg-slate-900/30 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <h3 class="text-base md:text-lg font-black text-white flex items-center gap-3">
                        <span class="p-2 bg-indigo-500 rounded-lg shadow-lg shadow-indigo-500/50 text-white">
                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </span>
                        RANKING KANDIDAT BY AI
                    </h3>
                    <span class="text-[10px] md:text-xs font-bold text-slate-500 uppercase tracking-widest bg-slate-800/50 px-3 py-1 rounded-full">
                        Total: {{ $candidates->count() }} Pelamar
                    </span>
                </div>

                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left min-w-[800px] md:min-w-full">
                        <thead>
                            <tr class="text-slate-500 text-[10px] uppercase tracking-[0.2em]">
                                <th class="px-6 py-4">Rank</th>
                                <th class="px-6 py-4">Kandidat</th>
                                <th class="px-6 py-4">Status Seleksi</th>
                                <th class="px-6 py-4">AI Compatibility</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/50">
                            @forelse($candidates as $index => $candidate)
                                <tr class="group hover:bg-indigo-500/[0.02] transition-all">
                                    <td class="px-6 py-6">
                                        <div
                                            class="w-10 h-10 flex items-center justify-center rounded-xl md:rounded-2xl font-black text-sm
                                            {{ $index == 0
                                                ? 'bg-yellow-500/20 text-yellow-500 shadow-[0_0_15px_rgba(234,179,8,0.2)] border border-yellow-500/50'
                                                : ($index == 1
                                                    ? 'bg-slate-300/10 text-slate-300'
                                                    : ($index == 2
                                                        ? 'bg-orange-500/10 text-orange-500'
                                                        : 'bg-slate-800 text-slate-500')) }}">
                                            {{ $index + 1 }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex flex-col">
                                            <a href="{{ route('candidates.show', $candidate->id) }}"
                                                class="font-bold text-white hover:text-indigo-400 transition-colors">
                                                {{ $candidate->name }}
                                            </a>
                                            <span class="text-[10px] md:text-xs text-slate-500 font-mono mt-1">{{ $candidate->email }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <form action="{{ route('candidates.updateStatus', $candidate->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()"
                                                class="bg-[#0B0F1A] text-[10px] font-black uppercase tracking-widest rounded-xl border-slate-800 focus:ring-indigo-500 focus:border-indigo-500 py-1.5 px-3 transition-all
                                                {{ $candidate->status == 'interview' ? 'text-emerald-400' : ($candidate->status == 'rejected' ? 'text-rose-500' : 'text-amber-400') }}">
                                                <option value="pending" {{ $candidate->status == 'pending' ? 'selected' : '' }}>REVIEW AI</option>
                                                <option value="interview" {{ $candidate->status == 'interview' ? 'selected' : '' }}>INTERVIEW</option>
                                                <option value="rejected" {{ $candidate->status == 'rejected' ? 'selected' : '' }}>DITOLAK</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex items-center gap-3">
                                            <div class="flex-1 bg-slate-800 rounded-full h-1.5 md:h-2 min-w-[80px] md:max-w-[120px]">
                                                <div class="bg-indigo-500 h-full rounded-full shadow-[0_0_10px_rgba(99,102,241,0.5)] transition-all duration-1000"
                                                    style="width: {{ $candidate->score }}%"></div>
                                            </div>
                                            <span class="text-sm md:text-lg font-black text-indigo-400">{{ $candidate->score }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 text-right">
                                        <div class="flex justify-end items-center gap-2">
                                            <a href="{{ asset('storage/' . $candidate->cv_file) }}" target="_blank"
                                                class="p-2.5 bg-slate-800 hover:bg-white hover:text-black text-white rounded-xl transition-all border border-slate-700 shadow-sm" title="View CV">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                            </a>

                                            @php
                                                // TEMPLATE PESANMU TETAP DISINI
                                                $pesanCustom = "Selamat siang Mba/Mas " . $candidate->name . ",\n\n" .
                                                               "Kami dari tim Rekrutmen dengan senang hati memberitahu bahwa Anda telah dinyatakan lolos seleksi awal untuk posisi *" . $job->title . "*.\n\n" .
                                                               "Kami mengundang Anda untuk hadir dalam proses interview online:\n\n" .
                                                               "Hari/tanggal : [Isi Tanggal]\n" .
                                                               "Pukul : [Isi Jam]\n" .
                                                               "Metode : Google Meet / Zoom\n" .
                                                               "Link : [Tempel Link Di Sini]\n\n" .
                                                               "Silahkan balas pesan ini dengan menuliskan (Nama lengkap, serta keterangan hadir/tidak hadir).\n\n" .
                                                               "Salam,\n" .
                                                               "Tim Rekrutmen";

                                                $urlWA = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $candidate->phone) . '?text=' . urlencode($pesanCustom);
                                            @endphp

                                            <a href="{{ $urlWA }}" target="_blank"
                                                class="p-2.5 bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 hover:bg-emerald-500 hover:text-white rounded-xl transition-all shadow-sm" title="Chat WhatsApp">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-20 text-center">
                                        <div class="flex flex-col items-center opacity-50">
                                            <svg class="w-12 h-12 text-slate-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                            <p class="text-slate-500 font-bold uppercase tracking-widest text-xs">Belum ada pelamar terdeteksi.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <x-footer />
</x-app-layout>

<style>
    .custom-scrollbar::-webkit-scrollbar { height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #0B0F1A; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #334155; }
</style>