@section('title', 'Eksplor Loker')
<x-app-layout>
    <div class="py-12 bg-[#0B0F1A]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <div class="flex justify-between items-end mb-6">
                    <div>
                        <h2 class="text-4xl font-black text-white tracking-tight">Eksplor Lowongan</h2>
                        <p class="text-slate-500 text-sm mt-2">Temukan peluang karir yang sesuai dengan keahlianmu.</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 p-1.5 bg-[#161B2D] border border-slate-800 rounded-2xl w-fit">
                    <a href="{{ route('candidates.index') }}"
                        class="px-6 py-2.5 rounded-xl text-xs font-black text-slate-500 hover:text-slate-300 transition-all">
                        LAMARAN SAYA
                    </a>
                    <a href="{{ route('candidates.available') }}"
                        class="px-6 py-2.5 rounded-xl text-xs font-black bg-indigo-600 text-white shadow-lg shadow-indigo-500/20 transition-all">
                        CARI LOWONGAN
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($jobs as $job)
                    <div
                        class="bg-[#161B2D] rounded-[2.5rem] border border-slate-800 p-8 hover:border-indigo-500/50 transition-all group relative overflow-hidden">
                        <div class="relative z-10">
                            <div class="flex justify-between items-start mb-4">
                                <div
                                    class="p-3 bg-indigo-500/10 rounded-2xl text-indigo-400 border border-indigo-500/20">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span
                                    class="text-[10px] font-black text-slate-500 uppercase tracking-widest bg-slate-900/50 px-3 py-1 rounded-full border border-slate-800">
                                    Sampai {{ \Carbon\Carbon::parse($job->deadline)->format('d M') }}
                                </span>
                            </div>

                            <h3
                                class="text-2xl font-bold text-white mb-2 group-hover:text-indigo-400 transition-colors">
                                {{ $job->title }}</h3>
                            <p class="text-slate-500 text-sm line-clamp-2 mb-6">{{ $job->description }}</p>

                            <div class="flex items-center justify-between mt-auto pt-6 border-t border-slate-800/50">
                                {{-- BAGIAN KIRI: SKILLS --}}
                                <div class="flex flex-wrap gap-1.5">
                                    @php $skills = is_array($job->required_skills) ? $job->required_skills : explode(',', $job->required_skills); @endphp
                                    @foreach (array_slice($skills, 0, 2) as $skill)
                                        <span
                                            class="text-[9px] font-bold px-2 py-1 bg-slate-800 text-slate-400 rounded-lg border border-slate-700">{{ trim($skill) }}</span>
                                    @endforeach
                                </div>

                                {{-- BAGIAN KANAN: CEK STATUS LAMARAN --}}
                                @php
                                    $sudahMelamar = $job->candidates->where('user_id', auth()->id())->first();
                                @endphp

                                @if ($sudahMelamar)
                                    <div class="flex flex-col items-end">
                                        <span
                                            class="text-[10px] font-black text-emerald-400 uppercase tracking-widest mb-1 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Sudah Dilamar
                                        </span>
                                        <a href="{{ route('candidates.index') }}"
                                            class="text-[11px] font-bold text-slate-400 hover:text-indigo-400 transition-colors underline decoration-slate-700 underline-offset-4">
                                            Lihat Riwayat
                                        </a>
                                    </div>
                                @else
                                    <a href="{{ route('candidates.create', ['job_post_id' => $job->id]) }}"
                                        class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-black text-xs hover:bg-indigo-500 transition-all transform active:scale-95 shadow-lg shadow-indigo-500/20">
                                        LAMAR SEKARANG
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Tampilan jika lowongan kosong --}}
                @endforelse
            </div>
        </div>
    </div>
    <x-footer />
</x-app-layout>
