<div x-init="$store.scroll.init()">
    <x-top-bar />

<header x-data="{ mobileOpen: false }" class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b border-emerald-100">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 gap-4">

            <a href="{{ url('/') }}" class="flex items-center gap-2 font-heading font-bold text-xl text-emerald-700 shrink-0">
                <img src="{{ asset('images/logo.png') }}" alt="Apotek Abidzar" class="w-9 h-9 object-contain">
                <span>Apotek Abidzar</span>
            </a>

            <div class="hidden lg:flex items-center gap-6 text-sm font-medium text-navy-800 shrink-0">
                <a href="{{ url('/') }}" class="hover:text-emerald-600 transition">Beranda</a>
                <a href="{{ route('products.index') }}" class="hover:text-emerald-600 transition">Produk</a>
                <a href="{{ route('articles.index') }}" class="hover:text-emerald-600 transition">Artikel</a>
                <a href="{{ route('about') }}" class="hover:text-emerald-600 transition">Tentang</a>
                <a href="{{ route('faq') }}" class="hover:text-emerald-600 transition">FAQ</a>
                <a href="{{ route('contact') }}" class="hover:text-emerald-600 transition">Kontak</a>
            </div>

            <form method="GET" action="{{ route('products.index') }}" class="hidden md:flex flex-1 max-w-md">
                <div class="relative w-full">
                    <input
                        type="text"
                        name="search"
                        placeholder="Cari obat, vitamin, atau kebutuhan kesehatan..."
                        class="w-full pl-4 pr-10 py-2.5 rounded-full border border-emerald-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-emerald-50/50"
                    >
                    <button type="submit" aria-label="Cari" class="absolute right-1 top-1/2 -translate-y-1/2 p-1.5 rounded-full hover:bg-emerald-100 transition">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </button>
                </div>
            </form>

            <div class="flex items-center gap-1 sm:gap-3 shrink-0">
                @auth
                    <a href="{{ route('cart.index') }}" aria-label="Lihat keranjang belanja" class="relative p-2 rounded-lg hover:bg-emerald-50 transition">
                        <svg class="w-6 h-6 text-navy-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 3h1.386c.51 0 .955.343 1.087.836l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.994-4.694 2.602-7.152.075-.302-.155-.598-.466-.598H5.106M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                        <span
                            x-show="$store.cart.count > 0"
                            x-text="$store.cart.count"
                            x-cloak
                            class="absolute -top-1 -right-1 w-5 h-5 flex items-center justify-center rounded-full bg-emerald-600 text-white text-xs font-bold"
                        ></span>
                    </a>

                    <div class="relative hidden sm:block" x-data="{ open: false }">
                        <button @click="open = !open" aria-label="Menu akun" :aria-expanded="open.toString()" class="flex items-center gap-2 p-2 rounded-lg hover:bg-emerald-50 transition">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-semibold text-sm">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <svg class="w-4 h-4 text-navy-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" @click.outside="open = false" x-transition x-cloak class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-emerald-100 py-1 z-50">
                            <div class="px-4 py-2 border-b border-slate-100">
                                <p class="text-sm font-medium text-navy-900 truncate">{{ auth()->user()->name }}</p>
                            </div>
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-emerald-50">Dashboard</a>
                            <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-emerald-50">Pesanan Saya</a>
                            <a href="{{ route('prescriptions.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-emerald-50">Resep Saya</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-slate-700 hover:bg-emerald-50">Keluar</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ url('/login') }}" class="hidden sm:inline-block px-4 py-2 text-sm font-medium text-emerald-700 hover:text-emerald-800 transition">
                        Masuk
                    </a>
                    <a href="{{ url('/register') }}" class="px-4 py-2 text-sm font-medium rounded-full bg-emerald-600 text-white hover:bg-emerald-700 transition">
                        Daftar
                    </a>
                @endauth

                <button
                    @click="mobileOpen = !mobileOpen"
                    class="lg:hidden p-2 rounded-lg text-navy-800 hover:bg-emerald-50 transition"
                    aria-label="Toggle menu"
                >
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="md:hidden pb-3">
            <form method="GET" action="{{ route('products.index') }}">
                <div class="relative w-full">
                    <input
                        type="text"
                        name="search"
                        placeholder="Cari obat, vitamin..."
                        class="w-full pl-4 pr-10 py-2.5 rounded-full border border-emerald-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-emerald-50/50"
                    >
                    <button type="submit" aria-label="Cari" class="absolute right-1 top-1/2 -translate-y-1/2 p-1.5 rounded-full hover:bg-emerald-100 transition">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <div
            x-show="mobileOpen"
            x-transition
            x-cloak
            class="lg:hidden pb-4 flex flex-col gap-1 text-sm font-medium text-navy-800"
        >
            <a href="{{ url('/') }}" class="px-3 py-2 rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition">Beranda</a>
            <a href="{{ route('products.index') }}" class="px-3 py-2 rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition">Produk</a>
            <a href="{{ route('articles.index') }}" class="px-3 py-2 rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition">Artikel Kesehatan</a>
            <a href="{{ route('about') }}" class="px-3 py-2 rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition">Tentang Kami</a>
            <a href="{{ route('faq') }}" class="px-3 py-2 rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition">FAQ</a>
            <a href="{{ route('contact') }}" class="px-3 py-2 rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition">Kontak</a>

            @auth
                <div class="border-t border-slate-100 mt-2 pt-2">
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition">Dashboard</a>
                    <a href="{{ route('orders.index') }}" class="block px-3 py-2 rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition">Pesanan Saya</a>
                    <a href="{{ route('prescriptions.index') }}" class="block px-3 py-2 rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition">Resep Saya</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition">Keluar</button>
                    </form>
                </div>
            @else
                <div class="flex gap-2 pt-2 px-3">
                    <a href="{{ url('/login') }}" class="flex-1 text-center px-4 py-2 rounded-lg border border-emerald-600 text-emerald-700">Masuk</a>
                    <a href="{{ url('/register') }}" class="flex-1 text-center px-4 py-2 rounded-lg bg-emerald-600 text-white">Daftar</a>
                </div>
            @endauth
        </div>
    </nav>
</header>
</div>