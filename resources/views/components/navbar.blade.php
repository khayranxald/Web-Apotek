<header x-data="{ mobileOpen: false }" class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b border-emerald-100">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <a href="{{ url('/') }}" class="flex items-center gap-2 font-heading font-bold text-xl text-emerald-700">
                <span>Apotek Abidzar</span>
            </a>

            <div class="hidden md:flex items-center gap-8 text-sm font-medium text-navy-800">
                <a href="{{ url('/') }}" class="hover:text-emerald-600 transition">Beranda</a>
                <a href="{{ url('/produk') }}" class="hover:text-emerald-600 transition">Produk</a>
                <a href="{{ url('/artikel') }}" class="hover:text-emerald-600 transition">Artikel Kesehatan</a>
                <a href="{{ url('/tentang-kami') }}" class="hover:text-emerald-600 transition">Tentang Kami</a>
                <a href="{{ url('/kontak') }}" class="hover:text-emerald-600 transition">Kontak</a>
            </div>

            <div class="hidden md:flex items-center gap-3">
                @auth
                    <a href="{{ route('cart.index') }}" aria-label="Lihat keranjang belanja" class="relative p-2 rounded-lg hover:bg-emerald-50 transition">
                        <svg class="w-6 h-6 text-navy-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 3h1.386c.51 0 .955.343 1.087.836l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.994-4.694 2.602-7.152.075-.302-.155-.598-.466-.598H5.106M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                        @if($cartItemCount > 0)
                            <span class="absolute -top-1 -right-1 w-5 h-5 flex items-center justify-center rounded-full bg-emerald-600 text-white text-xs font-bold">
                                {{ $cartItemCount }}
                            </span>
                        @endif
                    </a>

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" aria-label="Menu akun" aria-expanded="false" :aria-expanded="open.toString()" class="flex items-center gap-2 text-sm font-medium text-navy-800 hover:text-emerald-600 transition">
                            {{ auth()->user()->name }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" @click.outside="open = false" x-transition x-cloak class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-emerald-100 py-1 z-50">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-emerald-50">Dashboard</a>
                            <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-emerald-50">Pesanan Saya</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-slate-700 hover:bg-emerald-50">Keluar</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ url('/login') }}" class="px-4 py-2 text-sm font-medium text-emerald-700 hover:text-emerald-800 transition">
                        Masuk
                    </a>
                    <a href="{{ url('/register') }}" class="px-4 py-2 text-sm font-medium rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 transition">
                        Daftar
                    </a>
                @endauth
            </div>

            <button
                @click="mobileOpen = !mobileOpen"
                class="md:hidden p-2 rounded-lg text-navy-800 hover:bg-emerald-50 transition"
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

        <div
            x-show="mobileOpen"
            x-transition
            x-cloak
            class="md:hidden pb-4 flex flex-col gap-1 text-sm font-medium text-navy-800"
        >
            <a href="{{ url('/') }}" class="px-3 py-2 rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition">Beranda</a>
            <a href="{{ url('/produk') }}" class="px-3 py-2 rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition">Produk</a>
            <a href="{{ url('/artikel') }}" class="px-3 py-2 rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition">Artikel Kesehatan</a>
            <a href="{{ url('/tentang-kami') }}" class="px-3 py-2 rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition">Tentang Kami</a>
            <a href="{{ url('/kontak') }}" class="px-3 py-2 rounded-lg hover:bg-emerald-50 hover:text-emerald-600 transition">Kontak</a>
            <div class="flex gap-2 pt-2 px-3">
                <a href="{{ url('/login') }}" class="flex-1 text-center px-4 py-2 rounded-lg border border-emerald-600 text-emerald-700">Masuk</a>
                <a href="{{ url('/register') }}" class="flex-1 text-center px-4 py-2 rounded-lg bg-emerald-600 text-white">Daftar</a>
            </div>
        </div>
    </nav>
</header>