<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Triển khai Dự án</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6">Triển khai Dự án</h1>
    <form action="{{ url('http://fpoly-showrooms-workshop-main.com/admin/projects/deploy') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label for="project" class="block text-gray-700 text-sm font-bold mb-2">Tệp ZIP Dự án:</label>
            <input type="file" name="project" id="project" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
        </div>

        <div class="mb-4">
            <label for="data" class="block text-gray-700 text-sm font-bold mb-2">Tệp JSON Dữ liệu:</label>
            <input type="file" name="data" id="data" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Triển khai</button>
        </div>
    </form>

    @if (session('message'))
        <div class="mt-4 text-green-500">
            {{ session('message') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mt-4 text-red-500">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

</body>
</html>
