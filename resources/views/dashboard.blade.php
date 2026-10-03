<x-layouts.app title="Dashboard">

    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="mb-8">
            <h1 class="font-heading font-bold text-2xl sm:text-3xl text-navy-900">
                Halo, {{ $user->name }} 👋
            </h1>
            <p class="mt-1 text-slate-600">Selamat datang kembali di Apotek Abidzar.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
            <div class="p-5 rounded-2xl border border-emerald-100">
                <p class="text-sm text-slate-500">Total Pesanan</p>
                <p class="mt-1 font-heading font-bold text-2xl text-navy-900">{{ $stats['total_orders'] }}</p>
            </div>

            <div class="p-5 rounded-2xl border border-emerald-100">
                <p class="text-sm text-slate-500">Pesanan Pending</p>
                <p class="mt-1 font-heading font-bold text-2xl text-amber-600">{{ $stats['pending_orders'] }}</p>
            </div>

            <div class="p-5 rounded-2xl border border-emerald-100">
                <p class="text-sm text-slate-500">Resep Menunggu Review</p>
                <p class="mt-1 font-heading font-bold text-2xl text-amber-600">{{ $stats['pending_prescriptions'] }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
            <a href="{{ route('orders.index') }}" class="flex items-center justify-between p-5 rounded-2xl bg-emerald-50 hover:bg-emerald-100 transition group">
                <div>
                    <p class="font-semibold text-navy-900">Lihat Pesanan Saya</p>
                    <p class="text-sm text-slate-600">Cek status dan riwayat pesanan</p>
                </div>
                <svg class="w-5 h-5 text-emerald-600 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            <a href="{{ route('prescriptions.index') }}" class="flex items-center justify-between p-5 rounded-2xl bg-emerald-50 hover:bg-emerald-100 transition group">
                <div>
                    <p class="font-semibold text-navy-900">Lihat Resep Saya</p>
                    <p class="text-sm text-slate-600">Cek status review resep Anda</p>
                </div>
                <svg class="w-5 h-5 text-emerald-600 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        @if($latestOrder)
            <div class="p-5 rounded-2xl border border-emerald-100">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="font-semibold text-navy-900">Pesanan Terakhir</h2>
                    <a href="{{ route('orders.show', $latestOrder) }}" class="text-sm text-emerald-600 hover:underline">Lihat Detail</a>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <div>
                        <p class="font-medium text-navy-900">{{ $latestOrder->order_number }}</p>
                        <p class="text-slate-500">{{ $latestOrder->created_at->translatedFormat('d F Y') }}</p>
                    </div>
                    <span @class([
                        'px-3 py-1 rounded-lg text-xs font-semibold',
                        'bg-amber-100 text-amber-700' => $latestOrder->status === 'pending',
                        'bg-blue-100 text-blue-700' => $latestOrder->status === 'confirmed',
                        'bg-indigo-100 text-indigo-700' => $latestOrder->status === 'processing',
                        'bg-purple-100 text-purple-700' => $latestOrder->status === 'shipped',
                        'bg-emerald-100 text-emerald-700' => $latestOrder->status === 'completed',
                        'bg-red-100 text-red-700' => $latestOrder->status === 'cancelled',
                    ])>
                        {{ ucfirst($latestOrder->status) }}
                    </span>
                </div>
            </div>
        @else
            <div class="p-8 rounded-2xl border border-dashed border-emerald-200 text-center">
                <p class="text-slate-500">Anda belum memiliki pesanan.</p>
                <a href="{{ route('products.index') }}" class="mt-3 inline-block px-5 py-2.5 rounded-xl bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 transition">
                    Mulai Belanja
                </a>
            </div>
        @endif

    </section>

</x-layouts.app>