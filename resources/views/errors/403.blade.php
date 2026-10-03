<x-layouts.app title="Akses Ditolak">

    <section class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <div class="mx-auto w-20 h-20 rounded-full bg-red-50 flex items-center justify-center">
            <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
            </svg>
        </div>

        <h1 class="mt-6 font-heading font-bold text-2xl sm:text-3xl text-navy-900">
            Akses Ditolak
        </h1>
        <p class="mt-3 text-slate-600">
            Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.
            Jika Anda merasa ini adalah kesalahan, silakan hubungi administrator.
        </p>

        <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ url('/') }}" class="px-6 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition">
                Kembali ke Beranda
            </a>
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-6 py-3 rounded-xl border border-slate-300 text-slate-700 font-semibold hover:bg-slate-50 transition w-full">
                        Keluar Akun
                    </button>
                </form>
            @endauth
        </div>
    </section>

</x-layouts.app>