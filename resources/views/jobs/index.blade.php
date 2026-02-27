@section('title', 'Halaman HR')
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ url('/') }}"
                    class="p-2 bg-slate-800 rounded-xl text-slate-400 hover:text-white transition-all border border-slate-700 hover:border-indigo-500 group"
                    title="Lihat Landing Page">
                    <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                    </svg>
                </a>

                <div>
                    <h2 class="font-black text-2xl text-white tracking-tight">Manajemen Lowongan</h2>
                    <p class="text-slate-500 text-[10px] uppercase tracking-[0.1em] mt-0.5">Control Center / Job
                        Listings</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('jobs.create') }}"
                    class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-2xl text-sm font-black transition-all shadow-lg shadow-indigo-500/20 flex items-center gap-2 transform active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                    </svg>
                    TAMBAH LOWONGAN
                </a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="p-3 bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white rounded-2xl border border-red-500/20 transition-all transform active:scale-95 group"
                        title="Keluar Akun">
                        <svg class="w-5 h-5 transition-transform group-hover:rotate-12" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-[#0B0F1A] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#161B2D] border border-slate-800 rounded-[2.5rem] overflow-hidden shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-800/50 bg-slate-900/30">
                                <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">
                                    Judul Lowongan</th>
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-center text-slate-500 uppercase tracking-[0.2em]">
                                    Kebutuhan Skill</th>
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-center text-slate-500 uppercase tracking-[0.2em]">
                                    Kandidat</th>
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-right text-slate-500 uppercase tracking-[0.2em]">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/50">
                            @forelse($jobs as $job)
                                <tr class="hover:bg-indigo-500/[0.02] transition-colors group">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="p-3 bg-slate-800 rounded-xl text-indigo-400 group-hover:bg-indigo-500 group-hover:text-white transition-all">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <span class="font-bold text-white text-lg">{{ $job->title }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex flex-wrap justify-center gap-1.5 max-w-[300px] mx-auto">
                                            @php
                                                $skills = is_array($job->required_skills)
                                                    ? $job->required_skills
                                                    : explode(',', $job->required_skills);
                                            @endphp
                                            @foreach (array_slice($skills, 0, 3) as $skill)
                                                <span
                                                    class="text-[10px] font-bold px-2.5 py-1 bg-slate-800 text-slate-400 rounded-lg border border-slate-700">
                                                    {{ trim($skill) }}
                                                </span>
                                            @endforeach
                                            @if (count($skills) > 3)
                                                <span
                                                    class="text-[10px] font-bold px-2.5 py-1 text-slate-600">+{{ count($skills) - 3 }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <div class="inline-flex flex-col">
                                            <span
                                                class="text-2xl font-black text-white leading-none">{{ $job->candidates_count }}</span>
                                            <span
                                                class="text-[9px] font-black text-indigo-400 uppercase tracking-tighter mt-1">Pelamar</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex justify-end items-center gap-3">
                                            <a href="{{ route('jobs.edit', $job->id) }}"
                                                class="p-2 text-slate-600 hover:text-indigo-400 transition-colors"
                                                title="Edit Lowongan">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('jobs.show', $job->id) }}"
                                                class="px-4 py-2 bg-indigo-500/10 text-indigo-400 hover:bg-indigo-500 hover:text-white rounded-xl text-xs font-black transition-all border border-indigo-500/20">
                                                RANKING AI
                                            </a>
                                            <form action="{{ route('jobs.destroy', $job->id) }}" method="POST"
                                                id="delete-form-{{ $job->id }}" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="button" onclick="confirmDelete('{{ $job->id }}')"
                                                    class="p-2 text-slate-500 hover:text-red-500 transition-all hover:bg-red-500/10 rounded-lg"
                                                    title="Hapus Lowongan">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center text-slate-600">
                                            <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <h3 class="text-white font-bold text-lg">Belum Ada Lowongan</h3>
                                            <p class="text-sm mt-1">Mulai buat lowongan kerja pertama Anda sekarang.
                                            </p>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // 1. Alert untuk Error (misal: gagal hapus karena ada pelamar)
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Ups!',
                text: "{{ session('error') }}",
                background: '#161B2D',
                color: '#ffffff',
                confirmButtonColor: '#ef4444'
            });
        @endif

        // 2. Alert untuk Sukses
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                background: '#161B2D',
                color: '#ffffff',
                confirmButtonColor: '#6366f1',
                timer: 2500
            });
        @endif

        // 3. Fungsi Konfirmasi Hapus
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin hapus?',
                text: "Data lowongan dan pelamar di dalamnya akan hilang permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6366f1',
                cancelButtonColor: '#1e293b',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                background: '#161B2D',
                color: '#ffffff',
                customClass: {
                    popup: 'rounded-[2rem] border border-slate-800 shadow-2xl',
                    confirmButton: 'rounded-xl font-bold px-6 py-3',
                    cancelButton: 'rounded-xl font-bold px-6 py-3'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
</x-app-layout>
