<x-layouts.app :title="'Pesanan ' . $order->order_number">

    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <a href="{{ route('orders.index') }}" class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-emerald-600 transition mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Pesanan Saya
        </a>

        @if(session('success'))
            <div class="mb-6 px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
            <div>
                <h1 class="font-heading font-bold text-xl sm:text-2xl text-navy-900">{{ $order->order_number }}</h1>
                <p class="text-sm text-slate-500">{{ $order->created_at->translatedFormat('d F Y, H:i') }}</p>
            </div>
            <span @class([
                'px-4 py-2 rounded-xl text-sm font-semibold w-fit',
                'bg-amber-100 text-amber-700' => $order->status === 'pending',
                'bg-blue-100 text-blue-700' => $order->status === 'confirmed',
                'bg-indigo-100 text-indigo-700' => $order->status === 'processing',
                'bg-purple-100 text-purple-700' => $order->status === 'shipped',
                'bg-green-100 text-green-700' => $order->status === 'completed',
                'bg-red-100 text-red-700' => $order->status === 'cancelled',
            ])>
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="p-5 rounded-2xl border border-emerald-100 hover:border-emerald-200 transition">
                <h2 class="font-semibold text-navy-900 mb-2">Alamat Pengiriman</h2>
                <p class="text-sm text-slate-600">{{ $order->recipient_name }}</p>
                <p class="text-sm text-slate-600">{{ $order->phone }}</p>
                <p class="text-sm text-slate-600 mt-1">{{ $order->address }}, {{ $order->city }} {{ $order->postal_code }}</p>
                @if($order->address_note)
                    <p class="text-sm text-slate-500 mt-1 italic">{{ $order->address_note }}</p>
                @endif
            </div>

            <div class="p-5 rounded-2xl border border-emerald-100 hover:border-emerald-200 transition">
                <h2 class="font-semibold text-navy-900 mb-2">Status Pembayaran</h2>
                <p @class([
                    'text-sm font-medium',
                    'text-amber-600' => in_array($order->payment_status, ['unpaid', 'pending']),
                    'text-emerald-600' => $order->payment_status === 'paid',
                    'text-red-600' => in_array($order->payment_status, ['failed', 'refunded']),
                ])>
                    {{ ucfirst($order->payment_status) }}
                </p>
                <p class="text-xs text-slate-400 mt-2">
                    * Integrasi pembayaran akan aktif di Minggu 8.
                </p>
            </div>
        </div>

        <div class="p-5 rounded-2xl border border-emerald-100 hover:border-emerald-200 transition">
            <h2 class="font-semibold text-navy-900 mb-4">Produk Dipesan</h2>
            <div class="space-y-3">
                @foreach($order->items as $item)
                    <div class="flex justify-between items-center text-sm border-b border-slate-100 pb-3 last:border-0 last:pb-0">
                        <div>
                            <p class="font-medium text-navy-900">{{ $item->product_name }}</p>
                            <p class="text-slate-500">{{ $item->quantity }} x Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                        <p class="font-semibold text-navy-900">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 pt-4 border-t border-slate-100 space-y-1 text-sm">
                <div class="flex justify-between">
                    <span class="text-slate-600">Subtotal</span>
                    <span class="text-navy-900">Rp{{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                @if($order->discount > 0)
                    <div class="flex justify-between">
                        <span class="text-slate-600">Diskon</span>
                        <span class="text-red-600">-Rp{{ number_format($order->discount, 0, ',', '.') }}</span>
                    </div>
                @endif
                <div class="flex justify-between">
                    <span class="text-slate-600">Ongkos Kirim</span>
                    <span class="text-navy-900">Rp{{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between font-bold text-base pt-2 border-t border-slate-100 mt-2">
                    <span class="text-navy-900">Total</span>
                    <span class="text-emerald-700">Rp{{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

    </section>

</x-layouts.app>