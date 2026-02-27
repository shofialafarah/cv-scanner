@section('title', 'Edit Lowongan')
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('jobs.index') }}"
                class="p-2 bg-slate-800 rounded-xl text-slate-400 hover:text-white transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="font-black text-2xl text-white tracking-tight">Edit Lowongan</h2>
        </div>
    </x-slot>

    <div class="py-12 bg-[#0B0F1A] min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#161B2D] border border-slate-800 rounded-[2.5rem] p-10 shadow-2xl">
                <form action="{{ route('jobs.update', $job->id) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PATCH')

                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 text-sm rounded-2xl">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <div class="space-y-2">
                        <label class="text-sm font-black text-slate-500 uppercase tracking-widest ml-1">Nama Posisi /
                            Jabatan</label>
                        <input type="text" name="title" value="{{ old('title', $job->title) }}" required
                            class="w-full bg-slate-900 border border-slate-800 rounded-2xl py-4 px-6 text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-bold text-lg">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-black text-slate-500 uppercase tracking-widest ml-1">Keahlian
                                (Pisah Koma)</label>
                            <input type="text" name="required_skills"
                                value="{{ old('required_skills', is_array($job->required_skills) ? implode(', ', $job->required_skills) : $job->required_skills) }}"
                                placeholder="Contoh: Laravel, PHP, SQL" required
                                class="w-full bg-slate-900 border border-slate-800 rounded-2xl py-4 px-6 text-indigo-400 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-mono text-sm">
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-black text-slate-500 uppercase tracking-widest ml-1">Tenggat
                                Waktu</label>
                            <input type="date" name="deadline"
                                value="{{ old('deadline', $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('Y-m-d') : '') }}"
                                required
                                class="w-full bg-slate-900 border border-slate-800 rounded-2xl py-4 px-6 text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-bold">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-black text-slate-500 uppercase tracking-widest ml-1">Deskripsi
                            Pekerjaan</label>
                        <textarea name="description" rows="6" required
                            class="w-full bg-slate-900 border border-slate-800 rounded-[2rem] py-4 px-6 text-slate-300 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">{{ old('description', $job->description) }}</textarea>
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button type="submit"
                            class="flex-1 bg-indigo-600 hover:bg-indigo-500 text-white font-black py-4 rounded-2xl transition-all shadow-lg shadow-indigo-500/20 transform active:scale-[0.98]">
                            SIMPAN PERUBAHAN
                        </button>
                        <a href="{{ route('jobs.index') }}"
                            class="px-8 py-4 bg-slate-800 text-slate-400 font-black rounded-2xl hover:bg-slate-700 transition-all">
                            BATAL
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
