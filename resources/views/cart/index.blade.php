<x-layouts.app title="Keranjang Saya">

    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="font-heading font-bold text-2xl sm:text-3xl text-navy-900 mb-6">Keranjang Saya</h1>

        @if(session('success'))
            <div class="mb-4 px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 text-sm flex items-center gap-2">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 px-4 py-3 rounded-xl bg-red-50 text-red-700 text-sm">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if($items->isEmpty())
            <div class="text-center py-20">
                <svg class="w-20 h-20 mx-auto text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 3h1.386c.51 0 .955.343 1.087.836l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.994-4.694 2.602-7.152.075-.302-.155-.598-.466-.598H5.106M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
                <p class="mt-4 text-slate-500">Keranjang Anda masih kosong.</p>
                <a href="{{ route('products.index') }}" class="mt-4 inline-block px-6 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 hover:scale-105 transition">
                    Mulai Belanja
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($items as $item)
                    <div class="flex items-center gap-4 p-4 rounded-2xl border border-emerald-100 hover:border-emerald-200 hover:shadow-sm transition">

                        <div class="w-20 h-20 rounded-xl bg-emerald-50 overflow-hidden shrink-0">
                            @if($item->product->image)
                                <img src="{{ Storage::url($item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                            @endif
                        </div>

                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-navy-900 truncate">{{ $item->product->name }}</h3>
                            <p class="text-sm text-emerald-600">Rp{{ number_format($item->product->final_price, 0, ',', '.') }}</p>

                            <form method="POST" action="{{ route('cart.update', $item) }}" class="mt-2 flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <label for="qty-{{ $item->id }}" class="text-xs text-slate-500">Qty:</label>
                                <input
                                    type="number"
                                    id="qty-{{ $item->id }}"
                                    name="quantity"
                                    value="{{ $item->quantity }}"
                                    min="1"
                                    max="{{ $item->product->stock }}"
                                    class="w-16 px-2 py-1 rounded-lg border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                >
                                <button type="submit" class="text-xs text-emerald-600 hover:text-emerald-700 hover:underline font-medium">Update</button>
                            </form>
                        </div>

                        <div class="text-right">
                            <p class="font-bold text-navy-900">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            <form method="POST" action="{{ route('cart.destroy', $item) }}" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-500 hover:text-red-600 hover:underline font-medium">Hapus</button>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>

            <div class="mt-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 p-6 rounded-2xl bg-emerald-50">
                <div>
                    <p class="text-sm text-slate-600">Subtotal</p>
                    <p class="text-2xl font-bold text-navy-900">Rp{{ number_format($subtotal, 0, ',', '.') }}</p>
                </div>
                <a href="{{ route('checkout.index') }}" class="px-8 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 hover:scale-105 transition text-center">
                    Lanjut ke Checkout
                </a>
            </div>
        @endif
    </section>

</x-layouts.app>