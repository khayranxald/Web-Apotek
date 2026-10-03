<x-layouts.app title="Checkout">

    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="font-heading font-bold text-2xl sm:text-3xl text-navy-900 mb-6">Checkout</h1>

        @if(session('error'))
            <div class="mb-4 px-4 py-3 rounded-xl bg-red-50 text-red-700 text-sm">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 px-4 py-3 rounded-xl bg-red-50 text-red-700 text-sm">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form
            x-data="{
                selectedCity: '{{ old('city', '') }}',
                shippingRates: {{ $cities->pluck('cost', 'city')->toJson() }},
                defaultCost: 20000,
                submitting: false,
                get shippingCost() {
                    const matched = Object.keys(this.shippingRates).find(
                        city => city.toLowerCase() === this.selectedCity.toLowerCase().trim()
                    );
                    return matched ? parseFloat(this.shippingRates[matched]) : this.defaultCost;
                },
                get total() {
                    return {{ $subtotal }} + this.shippingCost;
                }
            }"
            x-on:submit="submitting = true"
            method="POST"
            action="{{ route('checkout.store') }}"
        >
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-6">

                    <div class="p-5 rounded-2xl border border-emerald-100">
                        <h2 class="font-heading font-semibold text-lg text-navy-900 mb-4">Alamat Pengiriman</h2>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Penerima</label>
                                <input
                                    type="text"
                                    name="recipient_name"
                                    value="{{ old('recipient_name', $user->name) }}"
                                    required
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                >
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Nomor Telepon</label>
                                <input
                                    type="text"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    required
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                >
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Alamat Lengkap</label>
                                <textarea
                                    name="address"
                                    rows="3"
                                    required
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                >{{ old('address') }}</textarea>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Kota</label>
                                    <input
                                        type="text"
                                        name="city"
                                        list="city-list"
                                        x-model="selectedCity"
                                        value="{{ old('city') }}"
                                        required
                                        placeholder="Ketik atau pilih kota"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    >
                                    <datalist id="city-list">
                                        @foreach($cities as $cityOption)
                                            <option value="{{ $cityOption->city }}" data-cost="{{ $cityOption->cost }}"></option>
                                        @endforeach
                                    </datalist>
                                    <p class="mt-1 text-xs text-slate-400">Ongkir otomatis menyesuaikan kota yang dipilih.</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Kode Pos</label>
                                    <input
                                        type="text"
                                        name="postal_code"
                                        value="{{ old('postal_code') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    >
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Catatan Alamat (opsional)</label>
                                <input
                                    type="text"
                                    name="address_note"
                                    value="{{ old('address_note') }}"
                                    placeholder="Contoh: Rumah cat hijau, dekat masjid"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                >
                            </div>
                        </div>
                    </div>

                    <div class="p-5 rounded-2xl border border-emerald-100">
                        <h2 class="font-heading font-semibold text-lg text-navy-900 mb-4">Produk yang Dipesan</h2>
                        <div class="space-y-3">
                            @foreach($items as $item)
                                <div class="flex justify-between items-center text-sm">
                                    <div>
                                        <p class="font-medium text-navy-900">{{ $item->product->name }}</p>
                                        <p class="text-slate-500">{{ $item->quantity }} x Rp{{ number_format($item->product->final_price, 0, ',', '.') }}</p>
                                    </div>
                                    <p class="font-semibold text-navy-900">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="lg:col-span-1">
                    <div class="p-6 rounded-2xl bg-emerald-50 sticky top-24">
                        <h2 class="font-heading font-semibold text-lg text-navy-900 mb-4">Ringkasan Pembayaran</h2>

                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-slate-600">Subtotal</span>
                                <span class="text-navy-900">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-600">Ongkos Kirim</span>
                                <span class="text-navy-900" x-text="'Rp' + shippingCost.toLocaleString('id-ID')"></span>
                            </div>
                            <div class="border-t border-emerald-200 pt-2 mt-2 flex justify-between font-bold text-base">
                                <span class="text-navy-900">Total</span>
                                <span class="text-emerald-700" x-text="'Rp' + total.toLocaleString('id-ID')"></span>
                            </div>
                        </div>
                        <p class="mt-2 text-xs text-slate-400">* Ongkos kirim final akan dikonfirmasi ulang saat pesanan diproses.</p>

                        <button
                            type="submit"
                            x-bind:disabled="submitting"
                            class="mt-6 w-full px-6 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition disabled:opacity-70 flex items-center justify-center gap-2"
                        >
                            <svg x-show="submitting" x-cloak class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            <span x-text="submitting ? 'Memproses Pesanan...' : 'Buat Pesanan'"></span>
                        </button>

                        <p class="mt-3 text-xs text-slate-500 text-center">
                            Dengan melanjutkan, Anda menyetujui pesanan ini akan diproses oleh Apotek Abidzar.
                        </p>
                    </div>
                </div>

            </div>
        </form>
    </section>

</x-layouts.app>