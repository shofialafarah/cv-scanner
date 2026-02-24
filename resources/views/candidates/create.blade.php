<!DOCTYPE html>
<html>
<head>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-lg w-96">
        <h1 class="text-2xl font-bold mb-6 text-center">Upload CV</h1>

        <form action="{{ route('candidates.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="file" name="cv" class="mb-4 w-full border p-2 rounded">

            <button class="bg-blue-600 text-white w-full py-2 rounded hover:bg-blue-700">
                Upload
            </button>
        </form>
    </div>

</body>
</html>