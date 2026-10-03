<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Apotek Abidzar</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100">

    <div class="flex min-h-screen items-center justify-center">
        <div class="rounded-2xl bg-white p-10 text-center shadow-lg">
            
            <h1 class="mb-3 text-3xl font-bold text-emerald-600">
                Apotek Abidzar
            </h1>

            <p class="mb-6 text-gray-600">
                Selamat datang di sistem Apotek Abidzar.
            </p>

            {{-- Test Alpine.js --}}
            <div x-data="{ open: false }" class="p-10 text-center">
                <button
                    @click="open = !open"
                    class="rounded-lg bg-emerald-600 px-4 py-2 text-white transition hover:bg-emerald-700"
                >
                    Toggle Alpine Test
                </button>

                <p
                    x-show="open"
                    x-transition
                    class="mt-4 font-semibold text-teal-600"
                >
                    Alpine.js aktif ✅
                </p>
            </div>

        </div>
    </div>

</body>
</html>