<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Analisis AI: {{ $candidate->name }}</h2>
            <a href="{{ route('jobs.show', $candidate->job_post_id) }}" class="text-sm font-bold text-indigo-600">&larr;
                Kembali ke Ranking</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-indigo-500">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-sm font-medium text-gray-500 uppercase">AI Match Score</span>
                    <span class="text-3xl font-bold text-indigo-600">{{ $candidate->score }}%</span>
                </div>

                <h3 class="text-lg font-bold mb-2">Ringkasan Analisis</h3>
                <p class="text-gray-700 leading-relaxed italic">
                    "{{ $candidate->ai_summary ?? 'AI tidak memberikan ringkasan.' }}"
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 shadow sm:rounded-lg">
                    <h3 class="font-bold mb-4 text-gray-800">Skills yang Ditemukan</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($candidate->skills as $skill)
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                                {{ $skill }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white p-6 shadow sm:rounded-lg">
                    <h3 class="font-bold mb-4 text-gray-800">Informasi Kontak</h3>
                    <ul class="space-y-3 text-sm">
                        <li><strong class="text-gray-500">Email:</strong> {{ $candidate->email }}</li>
                        <li><strong class="text-gray-500">Telepon:</strong> <a
                                href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $candidate->phone) }}"
                                target="_blank" class="text-green-600 hover:underline font-bold">
                                {{ str_replace(' ', '', $candidate->phone) }}
                            </a></li>
                        <li>
                            <a href="{{ asset('storage/' . $candidate->cv_file) }}" target="_blank"
                                class="text-indigo-600 font-bold hover:underline">
                                📂 Buka File CV Asli
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->role === 'hr')
        <div class="bg-white p-6 shadow sm:rounded-lg mt-6 border-2 border-dashed border-indigo-200">
            <h3 class="font-bold mb-4 text-gray-800 flex items-center">
                <span class="mr-2">⚖️</span> Tentukan Keputusan (Khusus HR)
            </h3>
            <div class="flex gap-4">
                <form action="{{ route('candidates.update', $candidate->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <input type="hidden" name="status" value="interview">
                    <button type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-green-700 transition">
                        Panggil Interview
                    </button>
                </form>

                <form action="{{ route('candidates.update', $candidate->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit"
                        class="bg-red-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-red-700 transition">
                        Tolak Lamaran
                    </button>
                </form>
            </div>
        </div>
    @endif
</x-app-layout>
