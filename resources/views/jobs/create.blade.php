<!DOCTYPE html>
<html>
<head>
    @vite('resources/css/app.css')
    <title>Buat Lowongan</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-xl shadow-lg w-[500px]">
    <h1 class="text-2xl font-bold mb-6 text-center">Buat Lowongan Kerja</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 text-sm rounded-lg">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif

    <form action="{{ route('jobs.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium">Judul Pekerjaan</label>
            <input type="text" name="title"
                   class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Deskripsi</label>
            <textarea name="description" rows="4"
                      class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500"></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">
                Required Skills (pisahkan dengan koma)
            </label>
            <input type="text" name="required_skills"
                   placeholder="Laravel, PostgreSQL, REST API"
                   class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500">
        </div>

        <button class="bg-blue-600 text-white w-full py-2 rounded hover:bg-blue-700">
            Simpan Lowongan
        </button>
    </form>

    <div class="mt-4 text-center">
        <a href="{{ route('jobs.index') }}" class="text-sm text-gray-600 hover:underline">
            ← Kembali
        </a>
    </div>
</div>

</body>
</html>