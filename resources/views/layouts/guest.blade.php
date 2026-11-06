@props(['reverse' => false])
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Apotek Abidzar' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-white text-navy-900 antialiased">

    <div class="min-h-screen flex flex-col {{ $reverse ? 'md:flex-row-reverse' : 'md:flex-row' }}">

        {{-- Panel Branding --}}
        <div class="hidden md:flex md:w-1/2 relative overflow-hidden bg-gradient-to-br from-emerald-600 via-emerald-700 to-navy-900 text-white p-12 flex-col justify-between">

            <div class="absolute -top-20 -left-20 w-72 h-72 rounded-full bg-emerald-400/20 blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 rounded-full bg-teal-400/20 blur-3xl"></div>

            <div class="relative">
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Apotek Abidzar" class="w-8 h-8 object-contain brightness-0 invert">
                    <span class="font-heading font-bold text-2xl text-white">Apotek Abidzar</span>
                </a>
            </div>

            <div class="relative">
                <svg class="w-10 h-10 text-emerald-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-sm text-emerald-200 mb-2">Kesehatan lebih mudah,</p>
                <h2 class="font-heading font-bold text-2xl sm:text-3xl leading-snug">
                    Dapatkan akses ke obat, vitamin, dan konsultasi apoteker kapan saja.
                </h2>
            </div>

        </div>

            {{-- Form Side --}}
            <div class="flex-1 flex items-center justify-center p-6 sm:p-10 bg-emerald-50/30 md:bg-transparent">
                <div class="w-full max-w-md">

                    <div class="text-center mb-8 md:hidden">
                        <a href="{{ url('/') }}" class="inline-flex items-center gap-2">
                            <img src="{{ asset('images/logo.png') }}" alt="Apotek Abidzar" class="w-8 h-8 object-contain">
                            <span class="font-heading font-bold text-2xl text-emerald-700">Apotek Abidzar</span>
                        </a>
                        <p class="mt-1 text-sm text-slate-500">Kesehatan Lebih Mudah, Setiap Hari.</p>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg shadow-emerald-900/5 border border-emerald-100 p-6 sm:p-8 md:shadow-none md:border-0 md:p-0 md:bg-transparent md:rounded-none">
                        {{ $slot }}
                    </div>

                    <div class="text-center mt-6">
                        <a href="{{ url('/') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-emerald-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali ke Beranda
                        </a>
                    </div>

                </div>
            </div>

    </div>

</body>
</html>