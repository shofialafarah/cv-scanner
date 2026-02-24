<!DOCTYPE html>
<html>
<head>
    @vite('resources/css/app.css')
    <title>Upload CV | AI Scanner</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-lg w-96">
        <h1 class="text-2xl font-bold mb-2 text-center text-gray-800">Upload CV</h1>
        <p class="text-sm text-gray-500 mb-6 text-center">Format file harus PDF (Max: 2MB)</p>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 text-sm rounded-lg">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif

        <form action="{{ route('candidates.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
            @csrf

            <input type="file" name="cv" required
                   class="mb-4 w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500 outline-none">

            <button type="submit" id="submitBtn"
                    class="bg-blue-600 text-white w-full py-2 rounded hover:bg-blue-700 transition duration-200">
                Mulai Scan AI
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('candidates.index') }}" class="text-sm text-gray-600 hover:underline">← Kembali ke Daftar</a>
        </div>
    </div>

    <script>
        document.getElementById('uploadForm').onsubmit = function() {
            let btn = document.getElementById('submitBtn');
            btn.innerHTML = 'Sedang Menganalisis...'; // Efek loading
            btn.classList.add('opacity-50', 'cursor-not-allowed');
            btn.disabled = true;
        };
    </script>

</body>
</html>