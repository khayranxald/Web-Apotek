<x-layouts.app title="Produk">

    <section class="bg-emerald-50/50 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-heading font-bold text-2xl sm:text-3xl text-navy-900">
                Semua Produk
            </h1>

            <p class="mt-2 text-slate-600">
                Temukan obat, vitamin, dan kebutuhan kesehatan Anda.
            </p>

            <form
            x-data="{ loading: false }"
            x-on:submit="loading = true"
            method="GET"
            action="{{ route('products.index') }}"
            class="mt-6 flex flex-col sm:flex-row gap-3"
        >
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari produk..."
                class="flex-1 px-4 py-3 rounded-xl border border-emerald-200 focus:outline-none focus:ring-2 focus:ring-emerald-500"
            >
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <button
                type="submit"
                x-bind:disabled="loading"
                class="px-6 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition disabled:opacity-70 flex items-center justify-center gap-2 min-w-[100px]"
            >
                <svg x-show="loading" x-cloak class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
                <span x-text="loading ? 'Mencari...' : 'Cari'"></span>
            </button>
        </form>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col lg:flex-row gap-8">

            <x-category-filter :categories="$categories" />

            <div class="flex-1">
                @if($products->isEmpty())
                    <div class="text-center py-20 text-slate-500">
                        Tidak ada produk yang ditemukan.
                    </div>
                @else
                    <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
                        @foreach($products as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>

                    <div class="mt-10">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>

        </div>
    </section>

</x-layouts.app>