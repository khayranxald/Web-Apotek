@props(['product'])

<div
    x-data="{
        loading: false,
        added: false,
        rating: (({{ $product->id }} % 10) / 10 + 4.0).toFixed(1),
        reviewCount: (({{ $product->id }} * 37) % 950) + 50,
        addToCart() {
            if (this.loading) return;
            this.loading = true;

            fetch('{{ route('cart.store', $product) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content || '{{ csrf_token() }}',
                },
                body: JSON.stringify({ quantity: 1 }),
            })
            .then(response => {
                if (response.status === 401) {
                    window.location.href = '{{ route('login') }}';
                    throw new Error('Unauthorized');
                }
                return response.json();
            })
            .then(data => {
                this.loading = false;
                this.added = true;
                Alpine.store('cart').count = data.cartItemCount;
                setTimeout(() => this.added = false, 2000);
            })
            .catch(() => {
                this.loading = false;
            });
        }
    }"
    class="group relative rounded-2xl border border-emerald-100 overflow-hidden shadow-sm hover:shadow-md transition"
>
    <a href="{{ route('products.show', $product->slug) }}" class="block">
        <div class="aspect-square bg-emerald-50 overflow-hidden relative">
            @if($product->image)
                <div x-data="{ loaded: false }" class="w-full h-full">
                    <div x-show="!loaded" class="absolute inset-0 skeleton"></div>
                    <img
                        x-on:load="loaded = true"
                        x-show="loaded"
                        x-cloak
                        src="{{ Storage::url($product->image) }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                        loading="lazy"
                    >
                </div>
            @else
                <div class="w-full h-full flex items-center justify-center text-emerald-300">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
            @endif

            @if($product->discount_price)
                @php
                    $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100);
                @endphp
                <span class="absolute top-2 left-2 px-2 py-1 rounded-lg bg-red-500 text-white text-xs font-bold z-10">
                    Diskon {{ $discountPercent }}%
                </span>
            @endif

            @if($product->requires_prescription)
                <span class="absolute top-2 {{ $product->discount_price ? 'left-24' : 'left-2' }} px-2 py-1 rounded-lg bg-amber-100 text-amber-700 text-xs font-semibold z-10">
                    Perlu Resep
                </span>
            @endif
        </div>

        <div class="p-4 pb-2">
            <p class="text-xs text-emerald-600 font-medium">{{ $product->category->name }}</p>
            <h3 class="mt-1 font-heading font-semibold text-navy-900 line-clamp-2 group-hover:text-emerald-700 transition min-h-[2.5rem]">
                {{ $product->name }}
            </h3>

            <div class="mt-1 flex items-center gap-1">
                <svg class="w-3.5 h-3.5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
                <span class="text-xs font-medium text-slate-700" x-text="rating"></span>
                <span class="text-xs text-slate-400">(<span x-text="reviewCount"></span>)</span>
            </div>

            <div class="mt-2">
                @if($product->discount_price)
                    <div class="flex flex-col">
                        <span class="text-xs text-slate-400 line-through">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                        <span class="font-bold text-emerald-700 text-sm sm:text-base">Rp{{ number_format($product->discount_price, 0, ',', '.') }}</span>
                    </div>
                @else
                    <span class="font-bold text-navy-900 text-sm sm:text-base">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                @endif
            </div>

            @if($product->stock <= 5 && $product->stock > 0)
                <p class="mt-1 text-xs text-amber-600">Sisa {{ $product->stock }} stok</p>
            @elseif($product->stock == 0)
                <p class="mt-1 text-xs text-red-600">Stok habis</p>
            @endif
        </div>
    </a>

    <div class="px-4 pb-4">
        <button
            type="button"
            x-on:click.prevent="addToCart()"
            x-bind:disabled="loading || {{ $product->stock < 1 ? 'true' : 'false' }}"
            class="w-full px-4 py-2 rounded-xl text-sm font-semibold transition flex items-center justify-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed"
            :class="added ? 'bg-emerald-100 text-emerald-700' : 'bg-emerald-600 text-white hover:bg-emerald-700'"
        >
            <svg x-show="loading" x-cloak class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>
            <svg x-show="!loading && added" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
            <span x-show="!loading && !added">{{ $product->stock < 1 ? 'Stok Habis' : '+ Keranjang' }}</span>
            <span x-show="!loading && added" x-cloak>Ditambahkan</span>
        </button>
    </div>
</div>