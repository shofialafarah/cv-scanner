<!DOCTYPE html>
<html>

<head>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 p-10">

    <h1 class="text-3xl font-bold mb-6">Daftar Candidate</h1>

    <a href="{{ route('candidates.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">
        Upload CV Baru
    </a>

    <div class="mt-6 bg-white p-6 rounded-xl shadow">
        @foreach ($candidates as $candidate)
            <div class="border-b py-3">
                <p><strong>Nama:</strong> {{ $candidate->name }}</p>
                <p><strong>Email:</strong> {{ $candidate->email }}</p>
                <p><strong>Phone:</strong> {{ $candidate->phone }}</p>
                <p><strong>Score:</strong> {{ $candidate->score }}</p>
                <p><strong>Skills:</strong>
                    {{ implode(', ', $candidate->skills ?? []) }}
                </p>
                <p><strong>Summary:</strong> {{ $candidate->ai_summary }}</p>
            </div>
        @endforeach
    </div>

</body>

</html>
