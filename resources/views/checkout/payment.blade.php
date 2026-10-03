<x-layouts.app title="Pembayaran">

    <section class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-10 text-center">

        <div class="mx-auto w-16 h-16 rounded-full bg-emerald-50 flex items-center justify-center mb-6">
            <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
            </svg>
        </div>

        <h1 class="font-heading font-bold text-2xl sm:text-3xl text-navy-900 mb-2">
            Pesanan Anda Berhasil Dibuat
        </h1>
        <p class="text-slate-600 mb-1">Nomor Pesanan: <span class="font-semibold text-navy-900">{{ $order->order_number }}</span></p>
        <p class="text-slate-600 mb-8">Total yang harus dibayar: <span class="font-bold text-emerald-700">Rp{{ number_format($order->total, 0, ',', '.') }}</span></p>

        <div x-data="{ loading: false }">
            <button
                type="button"
                x-on:click="loading = true; window.snap.pay('{{ $snapToken }}', {
                    onSuccess: function() { window.location = '{{ route('orders.show', $order) }}'; },
                    onPending: function() { window.location = '{{ route('orders.show', $order) }}'; },
                    onError: function() { loading = false; alert('Pembayaran gagal, silakan coba lagi.'); },
                    onClose: function() { loading = false; }
                })"
                x-bind:disabled="loading"
                class="px-8 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition disabled:opacity-70 inline-flex items-center gap-2"
            >
                <svg x-show="loading" x-cloak class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
                <span x-text="loading ? 'Membuka Pembayaran...' : 'Bayar Sekarang'"></span>
            </button>
        </div>

        <p class="mt-6 text-sm text-slate-400">
            Anda akan diarahkan ke halaman pembayaran aman dari Midtrans.
        </p>

        <a href="{{ route('orders.show', $order) }}" class="mt-4 inline-block text-sm text-slate-500 hover:text-emerald-600 hover:underline">
            Bayar nanti, lihat detail pesanan
        </a>

    </section>

    @if($isProduction)
        <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>
    @else
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>
    @endif

</x-layouts.app>