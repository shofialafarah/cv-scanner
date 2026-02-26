<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 uppercase tracking-widest">
                Detail Lowongan: {{ $job->title }}
            </h2>
            <a href="{{ route('jobs.index') }}" class="text-gray-600 hover:text-gray-900 text-sm font-bold">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-bold mb-2">Deskripsi & Skill</h3>
                <p class="text-gray-600 mb-4">{{ $job->description }}</p>
                <div class="flex flex-wrap gap-2">
                    @foreach ($job->required_skills as $skill)
                        <span
                            class="bg-gray-100 text-gray-700 px-3 py-1 rounded text-xs border">{{ $skill }}</span>
                    @endforeach
                </div>
            </div>

            <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-bold">Ranking Kandidat (Berdasarkan AI Score)</h3>
                </div>

                <div class="p-6">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-gray-400 text-sm uppercase">
                                <th class="pb-4">Peringkat</th>
                                <th class="pb-4">Nama Kandidat</th>
                                <th class="pb-4">Kesesuaian (Score)</th>
                                <th class="pb-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($candidates as $index => $candidate)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-4">
                                        <span
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-full {{ $index == 0 ? 'bg-yellow-100 text-yellow-700 font-bold' : 'bg-gray-100 text-gray-600' }}">
                                            {{ $index + 1 }}
                                        </span>
                                    </td>
                                    <td class="py-4">
                                        <a href="{{ route('candidates.show', $candidate->id) }}"
                                            class="font-bold text-indigo-600 hover:underline">
                                            {{ $candidate->name }}
                                        </a>
                                        <div class="text-xs text-gray-500">{{ $candidate->email }}</div>
                                    </td>
                                    <td class="py-4 w-1/3">
                                        <div class="flex items-center">
                                            <div class="flex-1 bg-gray-200 rounded-full h-2 mr-3">
                                                <div class="bg-indigo-600 h-2 rounded-full"
                                                    style="width: {{ $candidate->score }}%"></div>
                                            </div>
                                            <span
                                                class="text-sm font-semibold text-indigo-700">{{ $candidate->score }}%</span>
                                        </div>
                                    </td>
                                    <td class="py-4 text-right">
                                        <a href="{{ asset('storage/' . $candidate->cv_file) }}" target="_blank"
                                            class="bg-gray-800 text-white px-4 py-2 rounded text-xs hover:bg-black transition">
                                            Lihat CV (PDF)
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-10 text-center text-gray-400">Belum ada kandidat yang
                                        melamar untuk posisi ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
