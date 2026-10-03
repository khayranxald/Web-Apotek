<x-layouts.app title="Pesanan Saya">

    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="font-heading font-bold text-2xl sm:text-3xl text-navy-900 mb-6">Pesanan Saya</h1>

        @if(session('success'))
            <div class="mb-6 px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if($orders->isEmpty())
            <div class="text-center py-20">
                <svg class="w-20 h-20 mx-auto text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                </svg>
                <p class="mt-4 text-slate-500">Anda belum memiliki pesanan.</p>
                <a href="{{ route('products.index') }}" class="mt-4 inline-block px-6 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 hover:scale-105 transition">
                    Mulai Belanja
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($orders as $order)
                    <a href="{{ route('orders.show', $order) }}" class="block p-5 rounded-2xl border border-emerald-100 hover:border-emerald-200 hover:shadow-md hover:-translate-y-0.5 transition">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <div>
                                <p class="font-semibold text-navy-900">{{ $order->order_number }}</p>
                                <p class="text-sm text-slate-500">{{ $order->created_at->translatedFormat('d F Y, H:i') }}</p>
                            </div>

                            <div class="flex items-center gap-3">
                                <span @class([
                                    'px-3 py-1 rounded-lg text-xs font-semibold',
                                    'bg-amber-100 text-amber-700' => $order->status === 'pending',
                                    'bg-blue-100 text-blue-700' => $order->status === 'confirmed',
                                    'bg-indigo-100 text-indigo-700' => $order->status === 'processing',
                                    'bg-purple-100 text-purple-700' => $order->status === 'shipped',
                                    'bg-emerald-100 text-emerald-700' => $order->status === 'completed',
                                    'bg-red-100 text-red-700' => $order->status === 'cancelled',
                                ])>
                                    {{ ucfirst($order->status) }}
                                </span>
                                <span class="font-bold text-navy-900">
                                    Rp{{ number_format($order->total, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @endif
    </section>

</x-layouts.app>