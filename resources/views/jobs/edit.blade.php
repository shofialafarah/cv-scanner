@section('title', 'Edit Lowongan')
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 md:gap-4">
            <a href="{{ route('jobs.index') }}"
                class="p-2 bg-slate-800 rounded-xl text-slate-400 hover:text-white transition-all border border-slate-700 hover:border-indigo-500 shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="font-black text-xl md:text-2xl text-white tracking-tight">Edit Lowongan</h2>
        </div>
    </x-slot>

    <div class="py-6 md:py-12 bg-[#0B0F1A] min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Card Container --}}
            <div class="bg-[#161B2D] border border-slate-800 rounded-[1.5rem] md:rounded-[2.5rem] p-6 md:p-10 shadow-2xl">
                
                <form action="{{ route('jobs.update', $job->id) }}" method="POST" class="space-y-6 md:space-y-8">
                    @csrf
                    @method('PATCH')

                    {{-- Alert Error --}}
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 text-xs md:text-sm rounded-2xl">
                            <ul class="list-disc ml-5 space-y-1 font-medium">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Nama Posisi --}}
                    <div class="space-y-2">
                        <label class="text-[10px] md:text-sm font-black text-slate-500 uppercase tracking-widest ml-1">Nama Posisi / Jabatan</label>
                        <input type="text" name="title" value="{{ old('title', $job->title) }}" required
                            class="w-full bg-slate-900 border border-slate-800 rounded-xl md:rounded-2xl py-3.5 md:py-4 px-5 md:px-6 text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-bold text-base md:text-lg">
                    </div>

                    {{-- Keahlian & Deadline Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] md:text-sm font-black text-slate-500 uppercase tracking-widest ml-1">Keahlian (Pisah Koma)</label>
                            <input type="text" name="required_skills"
                                value="{{ old('required_skills', is_array($job->required_skills) ? implode(', ', $job->required_skills) : $job->required_skills) }}"
                                placeholder="Contoh: Laravel, PHP, SQL" required
                                class="w-full bg-slate-900 border border-slate-800 rounded-xl md:rounded-2xl py-3.5 md:py-4 px-5 md:px-6 text-indigo-400 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-mono text-sm">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] md:text-sm font-black text-slate-500 uppercase tracking-widest ml-1">Tenggat Waktu</label>
                            <input type="date" name="deadline"
                                value="{{ old('deadline', $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('Y-m-d') : '') }}"
                                required
                                class="w-full bg-slate-900 border border-slate-800 rounded-xl md:rounded-2xl py-3.5 md:py-4 px-5 md:px-6 text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-bold color-scheme-dark">
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="space-y-2">
                        <label class="text-[10px] md:text-sm font-black text-slate-500 uppercase tracking-widest ml-1">Deskripsi Pekerjaan</label>
                        <textarea name="description" rows="6" required
                            class="w-full bg-slate-900 border border-slate-800 rounded-[1.5rem] md:rounded-[2rem] py-4 px-6 text-slate-300 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all text-sm md:text-base leading-relaxed">{{ old('description', $job->description) }}</textarea>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex flex-col-reverse md:flex-row gap-3 md:gap-4 pt-4">
                        <a href="{{ route('jobs.index') }}"
                            class="w-full md:w-auto px-8 py-4 bg-slate-800 text-slate-400 font-black rounded-xl md:rounded-2xl hover:bg-slate-700 transition-all text-center text-xs md:text-sm tracking-widest uppercase">
                            BATAL
                        </a>
                        <button type="submit"
                            class="flex-1 bg-indigo-600 hover:bg-indigo-500 text-white font-black py-4 rounded-xl md:rounded-2xl transition-all shadow-lg shadow-indigo-500/20 transform active:scale-[0.98] text-xs md:text-sm tracking-widest uppercase">
                            SIMPAN PERUBAHAN
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-footer />
</x-app-layout>

<style>
    .color-scheme-dark {
        color-scheme: dark;
    }
</style>