<x-layouts.app :title="$product->name">

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <nav class="text-sm text-slate-500 mb-6">
            <a href="{{ route('products.index') }}" class="hover:text-emerald-600">Produk</a>
            <span class="mx-2">/</span>
            <span class="text-navy-900">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            <div class="rounded-2xl bg-emerald-50 aspect-square overflow-hidden relative">
                @if($product->image)
                    <img
                        src="{{ Storage::url($product->image) }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover"
                    >
                @else
                    <div class="w-full h-full flex items-center justify-center text-emerald-300">
                        <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"
                            />
                        </svg>
                    </div>
                @endif

                @if($product->requires_prescription)
                    <span class="absolute top-3 left-3 px-3 py-1 rounded-lg bg-amber-100 text-amber-700 text-xs font-semibold">
                        Perlu Resep Dokter
                    </span>
                @endif
            </div>

            <div>
                <p class="text-sm text-emerald-600 font-medium">
                    {{ $product->category->name }}
                </p>

                <h1 class="mt-1 font-heading font-bold text-2xl sm:text-3xl text-navy-900">
                    {{ $product->name }}
                </h1>

                @if($product->manufacturer)
                    <p class="mt-1 text-sm text-slate-500">
                        oleh {{ $product->manufacturer }}
                    </p>
                @endif

                <div class="mt-4 flex items-center gap-3">
                    @if($product->discount_price)
                        <span class="text-lg text-slate-400 line-through">
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </span>

                        <span class="text-2xl font-bold text-emerald-700">
                            Rp{{ number_format($product->discount_price, 0, ',', '.') }}
                        </span>
                    @else
                        <span class="text-2xl font-bold text-navy-900">
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </span>
                    @endif
                </div>

                <div class="mt-2">
                    @if($product->stock > 5)
                        <span class="text-sm text-emerald-600">
                            Stok tersedia ({{ $product->stock }})
                        </span>
                    @elseif($product->stock > 0)
                        <span class="text-sm text-amber-600">
                            Sisa {{ $product->stock }} stok — segera pesan
                        </span>
                    @else
                        <span class="text-sm text-red-600 font-semibold">
                            Stok habis
                        </span>
                    @endif
                </div>

                <div class="mt-6 prose prose-sm max-w-none text-slate-600">
                    <p>
                        {{ $product->description ?? 'Deskripsi produk belum tersedia.' }}
                    </p>
                </div>

                @auth
                    <form
                        method="POST"
                        action="{{ route('cart.store', $product) }}"
                        class="mt-8 flex flex-col sm:flex-row gap-3"
                    >
                        @csrf

                        <input
                            type="hidden"
                            name="quantity"
                            value="1"
                        >

                        <button
                            type="submit"
                            @disabled($product->stock < 1)
                            class="flex-1 px-6 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition disabled:opacity-60 disabled:cursor-not-allowed disabled:hover:bg-emerald-600"
                        >
                            {{ $product->stock < 1 ? 'Stok Habis' : 'Tambah ke Keranjang' }}
                        </button>
                    </form>
                @else
                    <div class="mt-8">
                        <a
                            href="{{ route('login') }}"
                            class="block text-center px-6 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition"
                        >
                            Masuk untuk Membeli
                        </a>
                    </div>
                @endauth
            </div>
        </div>

        @if($relatedProducts->isNotEmpty())
            <div class="mt-16">
                <h2 class="font-heading font-semibold text-xl text-navy-900 mb-4">
                    Produk Terkait
                </h2>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-6">
                    @foreach($relatedProducts as $related)
                        <x-product-card :product="$related" />
                    @endforeach
                </div>
            </div>
        @endif

    </section>

</x-layouts.app>