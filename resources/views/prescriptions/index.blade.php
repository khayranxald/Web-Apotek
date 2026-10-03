<x-layouts.app title="Resep Saya">

    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="font-heading font-bold text-2xl sm:text-3xl text-navy-900">Resep Saya</h1>
            <a href="{{ route('prescriptions.create') }}" class="px-5 py-2.5 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition text-sm">
                + Upload Resep
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if($prescriptions->isEmpty())
            <div class="text-center py-20">
                <svg class="w-20 h-20 mx-auto text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                <p class="mt-4 text-slate-500">Anda belum pernah mengunggah resep.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($prescriptions as $prescription)
                    <div class="p-5 rounded-2xl border border-emerald-100 hover:border-emerald-200 hover:shadow-sm transition">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <div>
                                <p class="font-semibold text-navy-900 truncate max-w-xs" title="{{ $prescription->original_filename }}">{{ \Illuminate\Support\Str::limit($prescription->original_filename, 40) }}</p>
                                <p class="text-sm text-slate-500">Diunggah {{ $prescription->created_at->translatedFormat('d F Y, H:i') }}</p>
                            </div>

                            <div class="flex items-center gap-3">
                                <span @class([
                                    'px-3 py-1 rounded-lg text-xs font-semibold',
                                    'bg-amber-100 text-amber-700' => $prescription->status === 'pending',
                                    'bg-blue-100 text-blue-700' => $prescription->status === 'reviewing',
                                    'bg-emerald-100 text-emerald-700' => $prescription->status === 'approved',
                                    'bg-red-100 text-red-700' => $prescription->status === 'rejected',
                                    'bg-slate-100 text-slate-700' => $prescription->status === 'expired',
                                ])>
                                    {{ ucfirst($prescription->status) }}
                                </span>

                                <a href="{{ route('prescriptions.download', $prescription) }}" class="text-sm text-emerald-600 hover:underline">
                                    Unduh
                                </a>
                            </div>
                        </div>

                        @if($prescription->pharmacist_note)
                            <div class="mt-3 p-3 rounded-lg bg-slate-50 text-sm text-slate-600">
                                <span class="font-medium text-navy-900">Catatan Apoteker:</span> {{ $prescription->pharmacist_note }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $prescriptions->links() }}
            </div>
        @endif
    </section>

</x-layouts.app>