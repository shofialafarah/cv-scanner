<!DOCTYPE html>
<html>

<head>
    @vite('resources/css/app.css')
    <title>{{ $job->title }}</title>
</head>

<body class="bg-gray-100 p-10">

    <h1 class="text-3xl font-bold mb-2">{{ $job->title }}</h1>
    <p class="text-gray-600 mb-4">{{ $job->description }}</p>

    <p class="mb-6">
        <strong>Skills:</strong>
        {{ implode(', ', $job->required_skills ?? []) }}
    </p>

    <a href="{{ route('candidates.create', ['job_post_id' => $job->id]) }}"
        class="bg-blue-600 text-white px-4 py-2 rounded">
        Apply Sekarang
    </a>

    <hr class="my-8">

    <h2 class="text-2xl font-semibold mb-4">Daftar Kandidat</h2>

    @forelse($candidates as $candidate)
        <div class="bg-white p-4 rounded shadow mb-4">
            <h3 class="font-bold">{{ $candidate->name }}</h3>
            <p>Email: {{ $candidate->email }}</p>
            <p>Score: <strong>{{ $candidate->score }}</strong></p>
        </div>
    @empty
        <p>Belum ada kandidat.</p>
    @endforelse

</body>

</html>
