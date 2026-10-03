<x-layouts.app title="Beranda">

    <section class="bg-gradient-to-b from-emerald-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28 text-center">

            <div
                x-data="{ shown: false }"
                x-init="setTimeout(() => shown = true, 100)"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                class="transition-all duration-700 ease-out"
            >
                <h1 class="font-heading font-extrabold text-3xl sm:text-4xl md:text-5xl text-navy-900 leading-tight">
                    Kesehatan Lebih Mudah, <br class="hidden sm:block"> Setiap Hari.
                </h1>
            </div>

            <div
                x-data="{ shown: false }"
                x-init="setTimeout(() => shown = true, 250)"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                class="transition-all duration-700 ease-out"
            >
                <p class="mt-5 text-base sm:text-lg text-slate-600 max-w-2xl mx-auto">
                    Apotek Abidzar hadir untuk memudahkan Anda mendapatkan obat, vitamin,
                    dan konsultasi apoteker terpercaya — kapan saja, di mana saja.
                </p>
            </div>

            <div
                x-data="{ shown: false }"
                x-init="setTimeout(() => shown = true, 400)"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                class="transition-all duration-700 ease-out mt-8 flex flex-col sm:flex-row gap-3 justify-center"
            >
                <a href="{{ url('/produk') }}" class="px-6 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 hover:scale-105 transition shadow-sm">
                    Belanja Sekarang
                </a>
                <a href="{{ url('/konsultasi') }}" class="px-6 py-3 rounded-xl border border-emerald-600 text-emerald-700 font-semibold hover:bg-emerald-50 hover:scale-105 transition">
                    Konsultasi Apoteker
                </a>
            </div>

        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
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

</x-layouts.app>