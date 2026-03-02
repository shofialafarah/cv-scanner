@section('title', 'Buat Lowongan Baru')
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 md:gap-4">
            <a href="{{ route('jobs.index') }}" class="p-2 bg-slate-800 rounded-xl text-slate-400 hover:text-white transition-all border border-slate-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="font-black text-xl md:text-2xl text-white tracking-tight">Buat Lowongan</h2>
        </div>
    </x-slot>

    <div class="py-6 md:py-12 bg-[#0B0F1A] min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Card Container --}}
            <div class="bg-[#161B2D] border border-slate-800 rounded-[1.5rem] md:rounded-[2.5rem] p-6 md:p-10 shadow-2xl">
                
                {{-- Alert Error --}}
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 text-xs md:text-sm rounded-2xl">
                        <div class="flex items-center gap-2 mb-2 font-bold uppercase tracking-widest">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            Periksa Kembali:
                        </div>
                        <ul class="list-disc ml-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('jobs.store') }}" method="POST" class="space-y-6 md:space-y-8">
                    @csrf

                    {{-- Nama Posisi --}}
                    <div class="space-y-2">
                        <label class="text-[10px] md:text-sm font-black text-slate-500 uppercase tracking-widest ml-1">Nama Posisi</label>
                        <input type="text" name="title" value="{{ old('title') }}" required placeholder="e.g. Senior Backend Developer"
                            class="w-full bg-slate-900 border border-slate-800 rounded-xl md:rounded-2xl py-3 md:py-4 px-5 md:px-6 text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-bold text-base md:text-lg placeholder:text-slate-700">
                    </div>

                    {{-- Keahlian & Deadline --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] md:text-sm font-black text-slate-500 uppercase tracking-widest ml-1">Keahlian (Pisah Koma)</label>
                            <input type="text" name="required_skills" value="{{ old('required_skills') }}" placeholder="Laravel, React, PostgreSQL" required
                                class="w-full bg-slate-900 border border-slate-800 rounded-xl md:rounded-2xl py-3 md:py-4 px-5 md:px-6 text-indigo-400 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-mono text-sm">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] md:text-sm font-black text-slate-500 uppercase tracking-widest ml-1">Tenggat Waktu</label>
                            <input type="date" name="deadline" value="{{ old('deadline') }}" required
                                class="w-full bg-slate-900 border border-slate-800 rounded-xl md:rounded-2xl py-3 md:py-4 px-5 md:px-6 text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-bold text-sm md:text-base color-scheme-dark">
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="space-y-2">
                        <label class="text-[10px] md:text-sm font-black text-slate-500 uppercase tracking-widest ml-1">Detail Deskripsi</label>
                        <textarea name="description" rows="5" required placeholder="Jelaskan kualifikasi dan tanggung jawab..."
                            class="w-full bg-slate-900 border border-slate-800 rounded-2xl md:rounded-[2rem] py-4 px-6 text-slate-300 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all text-sm md:text-base leading-relaxed">{{ old('description') }}</textarea>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" 
                        class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-black py-4 md:py-5 rounded-xl md:rounded-2xl transition-all shadow-lg shadow-indigo-500/20 transform active:scale-[0.98] tracking-[0.2em] text-xs md:text-sm">
                        BUAT LOWONGAN SEKARANG
                    </button>
                </form>
            </div>
        </div>
    </div>
    <x-footer />
</x-app-layout>

<style>
    /* Menyesuaikan icon kalender agar tetap putih di mode dark browser tertentu */
    .color-scheme-dark {
        color-scheme: dark;
    }
</style>