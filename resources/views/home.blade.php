<x-layouts.app title="Beranda">

<section
    x-data="{
        slides: [
            {
                badge: 'Apotek Online Terpercaya',
                title: 'Kesehatan Anda, Lebih Mudah Setiap Hari.',
                text: 'Temukan obat, vitamin, dan kebutuhan kesehatan terpercaya dengan layanan apotek yang cepat dan aman.',
                image: '{{ asset('images/hero-1.png') }}',
            },
            {
                badge: 'Layanan Resep Digital',
                title: 'Upload Resep, Dapatkan Obat Tanpa Antre.',
                text: 'Cukup foto resep dokter Anda, apoteker kami akan segera memprosesnya untuk Anda.',
                image: '{{ asset('images/hero-2.png') }}',
            },
            {
                badge: 'Konsultasi Gratis',
                title: 'Tanya Apoteker Kapan Saja Anda Butuh.',
                text: 'Dapatkan saran kesehatan terpercaya dari apoteker profesional kami, tanpa biaya tambahan.',
                image: '{{ asset('images/hero-3.png') }}',
            },
        ],
        active: 0,
        init() {
            setInterval(() => {
                this.active = (this.active + 1) % this.slides.length;
            }, 5000);
        }
    }"
    class="relative overflow-hidden"
>
    <template x-for="(slide, index) in slides" :key="'bg-' + index">
        <div
            x-show="active === index"
            x-transition:enter="transition ease-in-out duration-1000"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-1000"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0"
        >
            <img :src="slide.image" class="w-full h-full object-cover" alt="">
            <div class="absolute inset-0 bg-gradient-to-b from-navy-900/70 via-navy-900/60 to-navy-900/80"></div>
        </div>
    </template>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 md:pt-20 pb-16 md:pb-24 text-center">

            <div class="relative min-h-[220px] sm:min-h-[200px] md:min-h-[240px] flex items-center justify-center">
                <template x-for="(slide, index) in slides" :key="index">
                    <div
                        x-show="active === index"
                        x-transition:enter="transition ease-out duration-700"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute inset-0 flex flex-col items-center justify-center"
                    >
                        <span class="inline-block px-4 py-1.5 rounded-full bg-white/15 backdrop-blur text-white text-xs font-semibold mb-4 border border-white/20" x-text="slide.badge"></span>

                        <h1 class="font-heading font-extrabold text-3xl sm:text-4xl md:text-5xl text-white leading-tight max-w-3xl" x-text="slide.title"></h1>

                        <p class="mt-5 text-base sm:text-lg text-slate-100 max-w-2xl" x-text="slide.text"></p>
                    </div>
                </template>
            </div>

            <div class="mt-10 flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ url('/produk') }}" class="px-6 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 hover:scale-105 transition shadow-sm">
                    Belanja Sekarang
                </a>
                <a href="{{ route('contact') }}" class="px-6 py-3 rounded-xl border border-emerald-600 text-emerald-700 font-semibold hover:bg-emerald-50 hover:scale-105 transition">
                    Konsultasi Apoteker
                </a>
            </div>

            <div class="mt-10 flex justify-center gap-2 relative z-10">
                <template x-for="(slide, index) in slides" :key="index">
                    <button
                        @click="active = index"
                        :class="active === index ? 'w-6 bg-white' : 'w-1.5 bg-white/40'"
                        class="h-1.5 rounded-full transition-all duration-300"
                        :aria-label="'Slide ' + (index + 1)"
                    ></button>
                </template>
            </div>

        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 md:-mt-14 relative z-10">
        <div class="bg-white rounded-2xl shadow-lg shadow-emerald-900/5 border border-emerald-100 p-4 sm:p-6">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">

                <a href="{{ route('products.index') }}" class="group flex items-center gap-3 p-4 rounded-xl hover:bg-emerald-50 transition">
                    <div class="w-11 h-11 shrink-0 rounded-xl bg-emerald-50 group-hover:bg-emerald-100 flex items-center justify-center transition">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="font-semibold text-navy-900 text-sm">Cari Obat</p>
                        <p class="text-xs text-slate-500 truncate">Temukan obat yang Anda butuhkan</p>
                    </div>
                </a>

                <a href="{{ route('contact') }}" class="group flex items-center gap-3 p-4 rounded-xl hover:bg-emerald-50 transition">
                    <div class="w-11 h-11 shrink-0 rounded-xl bg-emerald-50 group-hover:bg-emerald-100 flex items-center justify-center transition">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="font-semibold text-navy-900 text-sm">Konsultasi Apoteker</p>
                        <p class="text-xs text-slate-500 truncate">Tanyakan langsung pada ahlinya</p>
                    </div>
                </a>

                <a href="{{ route('products.index') }}" class="group flex items-center gap-3 p-4 rounded-xl hover:bg-emerald-50 transition">
                    <div class="w-11 h-11 shrink-0 rounded-xl bg-emerald-50 group-hover:bg-emerald-100 flex items-center justify-center transition">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="font-semibold text-navy-900 text-sm">Antar ke Rumah</p>
                        <p class="text-xs text-slate-500 truncate">Pesanan sampai dengan aman</p>
                    </div>
                </a>

                <a href="{{ route('prescriptions.create') }}" class="group flex items-center gap-3 p-4 rounded-xl hover:bg-emerald-50 transition">
                    <div class="w-11 h-11 shrink-0 rounded-xl bg-emerald-50 group-hover:bg-emerald-100 flex items-center justify-center transition">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="font-semibold text-navy-900 text-sm">Resep Digital</p>
                        <p class="text-xs text-slate-500 truncate">Upload resep, dapatkan obat</p>
                    </div>
                </a>

            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

        <div class="flex items-center justify-between mb-8">
            <div>
                <span class="inline-block px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-semibold mb-2">Kategori Populer</span>
                <h2 class="font-heading font-bold text-2xl sm:text-3xl text-navy-900">Belanja Berdasarkan Kebutuhan</h2>
            </div>
            <a href="{{ route('products.index') }}" class="hidden sm:inline-flex items-center gap-1 text-sm font-semibold text-emerald-600 hover:text-emerald-700">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            @php
                $categoryIcons = [
                    'Obat' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />',
                    'Vitamin & Suplemen' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />',
                    'Alat Kesehatan' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />',
                    'Ibu & Anak' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 9.75c0 1.03-.84 1.875-1.875 1.875S6 10.78 6 9.75 6.84 7.875 7.875 7.875 9.75 8.72 9.75 9.75zm0 0h4.5m-4.5 0a4.5 4.5 0 119 0m-9 0a4.5 4.5 0 109 0m-9 0H3m13.5 0h4.5m-4.5 0a4.5 4.5 0 10-9 0m9 0H21" />',
                    'Personal Care' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />',
                    'P3K' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />',
                ];
                $defaultIcon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />';
            @endphp

            @foreach($categories as $category)
                <a
                    href="{{ route('products.index', ['category' => $category->slug]) }}"
                    class="group flex flex-col items-center text-center p-4 rounded-2xl border border-emerald-100 hover:border-emerald-300 hover:shadow-md transition"
                >
                    <div class="w-16 h-16 rounded-2xl overflow-hidden bg-emerald-50 group-hover:bg-emerald-100 flex items-center justify-center transition">
                        @if($category->image)
                            <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $categoryIcons[$category->name] ?? $defaultIcon !!}
                            </svg>
                        @endif
                    </div>
                    <p class="mt-3 font-semibold text-sm text-navy-900 group-hover:text-emerald-700 transition">{{ $category->name }}</p>
                </a>
            @endforeach
        </div>

    </section>
    
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 py-16">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            
            <div
                x-data="{ shown: false }"
                x-intersect="shown = true"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                class="transition-all duration-700 ease-out rounded-2xl border border-emerald-100 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1"
            >
                <h3 class="font-heading font-semibold text-lg text-navy-900">Produk Lengkap</h3>
                <p class="mt-2 text-sm text-slate-600">Obat, vitamin, alat kesehatan, hingga kebutuhan ibu & anak.</p>
            </div>

            <div
                x-data="{ shown: false }"
                x-intersect="setTimeout(() => shown = true, 150)"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                class="transition-all duration-700 ease-out rounded-2xl border border-emerald-100 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1"
            >
                <h3 class="font-heading font-semibold text-lg text-navy-900">Resep Aman</h3>
                <p class="mt-2 text-sm text-slate-600">Upload resep dan direview langsung oleh apoteker profesional.</p>
            </div>

            <div
                x-data="{ shown: false }"
                x-intersect="setTimeout(() => shown = true, 300)"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                class="transition-all duration-700 ease-out rounded-2xl border border-emerald-100 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1"
            >
                <h3 class="font-heading font-semibold text-lg text-navy-900">Cepat & Terpercaya</h3>
                <p class="mt-2 text-sm text-slate-600">Proses pemesanan cepat dengan pelacakan status yang jelas.</p>
            </div>

        </div>
    </section>

      <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="rounded-3xl bg-gradient-to-br from-emerald-50 to-white border border-emerald-100 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 items-center">

                <div class="relative aspect-[4/3] md:aspect-auto md:h-full bg-emerald-100">
                    @php
                        $pharmacistPhoto = asset('images/pharmacist-consultation.jpeg');
                    @endphp
                    <img
                        src="{{ $pharmacistPhoto }}"
                        alt="Konsultasi dengan Apoteker"
                        class="w-full h-full object-cover"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                    >
                    <div class="hidden absolute inset-0 items-center justify-center bg-gradient-to-br from-emerald-200 to-emerald-100">
                        <svg class="w-24 h-24 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>

                <div class="p-8 sm:p-12">
                    <span class="inline-block px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-semibold mb-4">
                        Konsultasi Apoteker
                    </span>
                    <h2 class="font-heading font-bold text-2xl sm:text-3xl text-navy-900 leading-tight">
                        Butuh Bantuan Memilih Produk?
                    </h2>
                    <p class="mt-4 text-slate-600">
                        Konsultasikan kebutuhan kesehatan Anda dengan apoteker kami. Gratis & tanpa antre.
                    </p>

                    <a href="{{ route('contact') }}" class="mt-6 inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 hover:scale-105 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                        </svg>
                        Chat dengan Apoteker
                    </a>

                    <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-xs text-slate-600">Konsultasi gratis</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-xs text-slate-600">Respon cepat</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-xs text-slate-600">Apoteker berpengalaman</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-navy-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div
                x-data="{ shown: false }"
                x-intersect="shown = true"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                class="transition-all duration-700 ease-out text-center mb-12"
            >
                <h2 class="font-heading font-bold text-2xl sm:text-3xl text-white">
                    Dipercaya untuk Kesehatan Anda
                </h2>
                <p class="mt-3 text-slate-300 max-w-xl mx-auto">
                    Apotek Abidzar berkomitmen memberikan layanan yang aman, cepat, dan profesional.
                </p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">

                <div
                    x-data="{ shown: false }"
                    x-intersect="shown = true"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                    class="transition-all duration-700 ease-out text-center"
                >
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-emerald-500/10 flex items-center justify-center">
                        <svg class="w-7 h-7 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                    </div>
                    <p class="mt-3 font-heading font-bold text-white text-lg">Apoteker Bersertifikat</p>
                    <p class="mt-1 text-sm text-slate-400">Setiap resep direview oleh apoteker profesional</p>
                </div>

                <div
                    x-data="{ shown: false }"
                    x-intersect="setTimeout(() => shown = true, 100)"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                    class="transition-all duration-700 ease-out text-center"
                >
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-emerald-500/10 flex items-center justify-center">
                        <svg class="w-7 h-7 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </div>
                    <p class="mt-3 font-heading font-bold text-white text-lg">Data Aman</p>
                    <p class="mt-1 text-sm text-slate-400">Resep dan data pribadi Anda terlindungi</p>
                </div>

                <div
                    x-data="{ shown: false }"
                    x-intersect="setTimeout(() => shown = true, 200)"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                    class="transition-all duration-700 ease-out text-center"
                >
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-emerald-500/10 flex items-center justify-center">
                        <svg class="w-7 h-7 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                        </svg>
                    </div>
                    <p class="mt-3 font-heading font-bold text-white text-lg">Pengiriman Cepat</p>
                    <p class="mt-1 text-sm text-slate-400">Pesanan diproses dan dikirim dengan sigap</p>
                </div>

                <div
                    x-data="{ shown: false }"
                    x-intersect="setTimeout(() => shown = true, 300)"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                    class="transition-all duration-700 ease-out text-center"
                >
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-emerald-500/10 flex items-center justify-center">
                        <svg class="w-7 h-7 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                        </svg>
                    </div>
                    <p class="mt-3 font-heading font-bold text-white text-lg">Konsultasi 24/7</p>
                    <p class="mt-1 text-sm text-slate-400">Tanya apoteker kapan saja Anda butuh</p>
                </div>

            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

            <div class="lg:col-span-3 p-8 rounded-2xl border border-emerald-100">
                <h2 class="font-heading font-bold text-2xl sm:text-3xl text-navy-900">
                    Mengapa Memilih Apotek Abidzar?
                </h2>
                <p class="mt-3 text-slate-600 max-w-lg">
                    Kami berkomitmen memberikan layanan terbaik dalam setiap langkah kesehatan Anda.
                </p>

                <div class="mt-8 grid grid-cols-2 gap-6">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 shrink-0 rounded-xl bg-emerald-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-navy-900 text-sm">Produk Terjamin</p>
                            <p class="text-xs text-slate-500 mt-0.5">Keaslian produk terjamin</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 shrink-0 rounded-xl bg-emerald-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-navy-900 text-sm">Diproses oleh Apoteker</p>
                            <p class="text-xs text-slate-500 mt-0.5">Setiap pesanan direview profesional</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 shrink-0 rounded-xl bg-emerald-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-navy-900 text-sm">Pengiriman Cepat</p>
                            <p class="text-xs text-slate-500 mt-0.5">Pesanan sampai tepat waktu</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 shrink-0 rounded-xl bg-emerald-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-navy-900 text-sm">Pembayaran Aman</p>
                            <p class="text-xs text-slate-500 mt-0.5">Transaksi terenkripsi & terpercaya</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 relative rounded-2xl overflow-hidden bg-gradient-to-br from-emerald-600 to-navy-900 text-white p-8 flex flex-col justify-center">
                <div class="absolute -top-10 -right-10 w-40 h-40 rounded-full bg-emerald-400/20 blur-2xl"></div>

                <span class="relative inline-block px-3 py-1 rounded-full bg-white/10 text-white text-xs font-semibold mb-4 w-fit">
                    Bergabung Sekarang
                </span>
                <h3 class="relative font-heading font-bold text-xl sm:text-2xl leading-snug">
                    Lebih Sehat, Lebih Mudah Bersama Kami.
                </h3>
                <p class="relative mt-3 text-sm text-emerald-100">
                    Daftar sekarang dan nikmati kemudahan berbelanja kebutuhan kesehatan Anda kapan saja.
                </p>

                @guest
                    <a href="{{ route('register') }}" class="relative mt-6 inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-white text-emerald-700 font-semibold hover:bg-emerald-50 transition w-fit">
                        Daftar Sekarang
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                @else
                    <a href="{{ route('products.index') }}" class="relative mt-6 inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-white text-emerald-700 font-semibold hover:bg-emerald-50 transition w-fit">
                        Mulai Belanja
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                @endguest
            </div>

        </div>
    </section>

</x-layouts.app>