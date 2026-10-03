@props(['product'])

<a href="{{ route('products.show', $product->slug) }}" class="group block rounded-2xl border border-emerald-100 overflow-hidden shadow-sm hover:shadow-md transition">
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
            <div class="w-full h-full flex items-center justify-center text-emerald-300" role="img" aria-label="Gambar produk tidak tersedia">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                </svg>
            </div>
        @endif

        @if($product->requires_prescription)
            <span class="absolute top-2 left-2 px-2 py-1 rounded-lg bg-amber-100 text-amber-700 text-xs font-semibold z-10">
                Perlu Resep
            </span>
        @endif
    </div>

    <div class="p-4">
        <p class="text-xs text-emerald-600 font-medium">{{ $product->category->name }}</p>
        <h3 class="mt-1 font-heading font-semibold text-navy-900 line-clamp-2 group-hover:text-emerald-700 transition">
            {{ $product->name }}
        </h3>

        <div class="mt-2 flex items-center gap-2">
            @if($product->discount_price)
                <span class="text-sm text-slate-400 line-through">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                <span class="font-bold text-emerald-700">Rp{{ number_format($product->discount_price, 0, ',', '.') }}</span>
            @else
                <span class="font-bold text-navy-900">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
            @endif
        </div>

        @if($product->stock <= 5 && $product->stock > 0)
            <p class="mt-1 text-xs text-amber-600">Sisa {{ $product->stock }} stok</p>
        @elseif($product->stock == 0)
            <p class="mt-1 text-xs text-red-600">Stok habis</p>
        @endif
    </div>
</a>