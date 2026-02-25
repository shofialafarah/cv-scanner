<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Daftar Lowongan Kerja</h2>
            <a href="{{ route('jobs.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">
                + Tambah Lowongan
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Judul Lowongan</th>
                            <th class="py-2">Kebutuhan Skill</th>
                            <th class="py-2 text-center">Jumlah Pelamar</th>
                            <th class="py-2 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jobs as $job)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4 font-semibold">{{ $job->title }}</td>
                                <td class="py-4 text-sm text-gray-600">
                                    {{ is_array($job->required_skills) ? implode(', ', $job->required_skills) : $job->required_skills }}
                                </td>
                                <td class="py-4 text-center">
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-bold">
                                        {{ $job->candidates_count }} Pelamar
                                    </span>
                                </td>
                                <td class="py-4 text-right">
                                    <a href="{{ route('jobs.show', $job->id) }}" class="text-indigo-600 hover:underline mr-3">Detail & Ranking</a>
                                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-10 text-gray-500">Belum ada lowongan yang dibuat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>