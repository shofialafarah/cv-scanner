@section('title', 'Ranking AI: ' . $job->title)
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('jobs.index') }}"
                    class="p-2 bg-slate-800 rounded-xl text-slate-400 hover:text-white transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <h2 class="font-black text-2xl text-white tracking-tight uppercase">
                    Detail Lowongan
                </h2>
            </div>

            @if ($isUrgent)
                <div
                    class="animate-pulse bg-red-500/10 border border-red-500/50 text-red-500 px-4 py-2 rounded-xl text-[10px] font-black tracking-[0.2em]">
                    @if ($daysLeft == 0)
                        ⚠️ DEADLINE HARI INI!
                    @else
                        ⚠️ URGENT: {{ $daysLeft }} HARI LAGI
                    @endif
                </div>
            @endif
        </div>
    </x-slot>

    <div class="py-12 bg-[#0B0F1A]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="bg-[#161B2D] border border-slate-800 rounded-[2.5rem] p-8 shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 p-8">
                    <span
                        class="text-slate-800 font-black text-6xl opacity-20 uppercase">{{ substr($job->title, 0, 2) }}</span>
                </div>

                <div class="relative z-10">
                    <h3 class="text-3xl font-black text-white mb-4">{{ $job->title }}</h3>
                    <p class="text-slate-400 leading-relaxed max-w-3xl mb-6">{{ $job->description }}</p>

                    <div class="flex flex-wrap gap-2">
                        @foreach ($job->required_skills as $skill)
                            <span
                                class="bg-indigo-500/5 text-indigo-400 px-4 py-1.5 rounded-xl text-xs font-bold border border-indigo-500/10 lowercase font-mono">
                                #{{ $skill }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="bg-[#161B2D] border border-slate-800 rounded-[2.5rem] overflow-hidden shadow-2xl">
                <div class="p-8 border-b border-slate-800 bg-slate-900/30 flex justify-between items-center">
                    <h3 class="text-lg font-black text-white flex items-center gap-3">
                        <span class="p-2 bg-indigo-500 rounded-lg shadow-lg shadow-indigo-500/50 text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </span>
                        RANKING KANDIDAT BY AI
                    </h3>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Total:
                        {{ $candidates->count() }} Pelamar</span>
                </div>

                <div class="p-4 overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-slate-500 text-[10px] uppercase tracking-[0.2em]">
                                <th class="px-6 pb-4">Rank</th>
                                <th class="px-6 pb-4">Kandidat</th>
                                <th class="px-6 pb-4">AI Score Compatibility</th>
                                <th class="px-6 pb-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/50">
                            @forelse($candidates as $index => $candidate)
                                <tr class="group hover:bg-indigo-500/[0.02] transition-all">
                                    <td class="px-6 py-6">
                                        <div
                                            class="w-10 h-10 flex items-center justify-center rounded-2xl font-black text-sm
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
                                        <a href="{{ route('candidates.show', $candidate->id) }}"
                                            class="font-bold text-white hover:text-indigo-400 block transition-colors">
                                            {{ $candidate->name }}
                                        </a>
                                        <span class="text-xs text-slate-500 font-mono">{{ $candidate->email }}</span>
                                    </td>
                                    {{-- Ganti bagian kolom status di dalam loop @forelse --}}
                                    <td class="px-6 py-6">
                                        <form action="{{ route('candidates.updateStatus', $candidate->id) }}"
                                            method="POST" id="status-form-{{ $candidate->id }}">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()"
                                                class="bg-[#0B0F1A] text-[10px] font-black uppercase tracking-widest rounded-xl border-slate-800 focus:ring-indigo-500 focus:border-indigo-500 transition-all
            {{ $candidate->status == 'interview' ? 'text-emerald-400' : ($candidate->status == 'rejected' ? 'text-rose-500' : 'text-amber-400') }}">
                                                <option value="pending"
                                                    {{ $candidate->status == 'pending' ? 'selected' : '' }}>REVIEW AI
                                                </option>
                                                <option value="interview"
                                                    {{ $candidate->status == 'interview' ? 'selected' : '' }}>INTERVIEW
                                                </option>
                                                <option value="rejected"
                                                    {{ $candidate->status == 'rejected' ? 'selected' : '' }}>DITOLAK
                                                </option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="flex-1 bg-slate-800 rounded-full h-2 max-w-[150px]">
                                                <div class="bg-indigo-500 h-2 rounded-full shadow-[0_0_10px_rgba(99,102,241,0.5)] transition-all duration-1000"
                                                    style="width: {{ $candidate->score }}%"></div>
                                            </div>
                                            <span
                                                class="text-lg font-black text-indigo-400 leading-none">{{ $candidate->score }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 text-right flex justify-end gap-2">
                                        <a href="{{ asset('storage/' . $candidate->cv_file) }}" target="_blank"
                                            class="inline-flex items-center gap-2 bg-slate-800 hover:bg-white hover:text-black text-white px-4 py-2.5 rounded-xl text-[10px] font-black transition-all border border-slate-700 uppercase tracking-widest">
                                            View CV
                                        </a>

                                        @php
                                            // Template Pesan ala Bahankoe
                                            $pesanCustom =
                                                'Selamat siang Mba/Mas ' .
                                                $candidate->name .
                                                ",\n\n" .
                                                'Kami dari tim Rekrutmen dengan senang hati memberitahu bahwa Anda telah dinyatakan lolos seleksi awal untuk posisi *' .
                                                $job->title .
                                                "*.\n\n" .
                                                "Kami mengundang Anda untuk hadir dalam proses interview online:\n\n" .
                                                "Hari/tanggal : [Isi Tanggal]\n" .
                                                "Pukul : [Isi Jam]\n" .
                                                "Metode : Google Meet / Zoom\n" .
                                                "Link : [Tempel Link Di Sini]\n\n" .
                                                "Silahkan balas pesan ini dengan menuliskan (Nama lengkap, serta keterangan hadir/tidak hadir).\n\n" .
                                                "Salam,\n" .
                                                'Tim Rekrutmen';

                                            $urlWA =
                                                'https://wa.me/' .
                                                preg_replace('/[^0-9]/', '', $candidate->phone) .
                                                '?text=' .
                                                urlencode($pesanCustom);
                                        @endphp

                                        <a href="{{ $urlWA }}" target="_blank"
                                            class="inline-flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 hover:bg-emerald-500 hover:text-white px-4 py-2.5 rounded-xl text-[10px] font-black transition-all uppercase tracking-widest">
                                            Chat WA
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-20 text-center">
                                        <p class="text-slate-500 font-bold uppercase tracking-widest text-xs">Belum ada
                                            pelamar terdeteksi.</p>
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
