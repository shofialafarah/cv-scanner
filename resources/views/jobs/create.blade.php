@section('title', 'Buat Lowongan Baru')
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('jobs.index') }}" class="p-2 bg-slate-800 rounded-xl text-slate-400 hover:text-white transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="font-black text-2xl text-white tracking-tight">Buat Lowongan</h2>
        </div>
    </x-slot>

    <div class="py-12 bg-[#0B0F1A] min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#161B2D] border border-slate-800 rounded-[2.5rem] p-10 shadow-2xl">
                
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 text-sm rounded-2xl">
                        <ul class="list-disc ml-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('jobs.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <div class="space-y-2">
                        <label class="text-sm font-black text-slate-500 uppercase tracking-widest ml-1">Nama Posisi</label>
                        <input type="text" name="title" value="{{ old('title') }}" required placeholder="e.g. Senior Backend Developer"
                            class="w-full bg-slate-900 border border-slate-800 rounded-2xl py-4 px-6 text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-bold text-lg placeholder:text-slate-700">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-black text-slate-500 uppercase tracking-widest ml-1">Keahlian (Pisah Koma)</label>
                            <input type="text" name="required_skills" value="{{ old('required_skills') }}" placeholder="Laravel, React, PostgreSQL" required
                                class="w-full bg-slate-900 border border-slate-800 rounded-2xl py-4 px-6 text-indigo-400 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-mono text-sm">
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-black text-slate-500 uppercase tracking-widest ml-1">Tenggat Waktu</label>
                            <input type="date" name="deadline" value="{{ old('deadline') }}" required
                                class="w-full bg-slate-900 border border-slate-800 rounded-2xl py-4 px-6 text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-bold">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-black text-slate-500 uppercase tracking-widest ml-1">Detail Deskripsi</label>
                        <textarea name="description" rows="5" required placeholder="Jelaskan kualifikasi dan tanggung jawab..."
                            class="w-full bg-slate-900 border border-slate-800 rounded-[2rem] py-4 px-6 text-slate-300 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">{{ old('description') }}</textarea>
                    </div>

                    <button type="submit" 
                        class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-black py-5 rounded-2xl transition-all shadow-lg shadow-indigo-500/20 transform active:scale-[0.98] tracking-widest">
                        BUAT LOWONGAN
                    </button>
                </form>
            </div>
        </div>
    </div>
    @if ($errors->any())
    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 text-sm rounded-2xl">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
</x-app-layout>