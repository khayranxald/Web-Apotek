<x-layouts.app title="Halaman Tidak Ditemukan">

    <section class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <div class="mx-auto w-20 h-20 rounded-full bg-emerald-50 flex items-center justify-center">
            <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
            </svg>
        </div>

        <h1 class="mt-6 font-heading font-bold text-2xl sm:text-3xl text-navy-900">
            Halaman Tidak Ditemukan
        </h1>
        <p class="mt-3 text-slate-600">
            Maaf, halaman yang Anda cari tidak tersedia atau mungkin sudah dipindahkan.
            Coba periksa kembali alamat URL, atau kembali ke beranda.
        </p>

        <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ url('/') }}" class="px-6 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 hover:scale-105 transition">
                Kembali ke Beranda
            </a>
            <a href="{{ route('products.index') }}" class="px-6 py-3 rounded-xl border border-emerald-600 text-emerald-700 font-semibold hover:bg-emerald-50 transition">
                Lihat Produk
            </a>
        </div>
    </section>

</x-layouts.app>