<!DOCTYPE html>
<html>

<head>
    @vite('resources/css/app.css')
    <title>Daftar Lowongan</title>
</head>

<body class="bg-gray-100 p-10">

    <h1 class="text-3xl font-bold mb-6">Daftar Lowongan</h1>

    <a href="{{ route('jobs.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">
        + Buat Lowongan
    </a>

    <div class="mt-6 bg-white p-6 rounded-xl shadow">
        @foreach ($jobs as $job)
            <div class="border-b py-4">
                <h2 class="text-lg font-semibold">
                    <a href="{{ route('jobs.show', $job->id) }}" class="text-blue-600">
                        {{ $job->title }}
                    </a>
                </h2>
                <p class="text-sm text-gray-600">{{ $job->description }}</p>

                <p class="text-sm mt-2">
                    <strong>Skills:</strong>
                    {{ implode(', ', $job->required_skills ?? []) }}
                </p>
            </div>
        @endforeach
    </div>

</body>

</html>
