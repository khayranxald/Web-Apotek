<x-layouts.app title="Kontak">

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

        <div class="text-center mb-12">
            <h1 class="font-heading font-bold text-3xl sm:text-4xl text-navy-900">Hubungi Kami</h1>
            <p class="mt-3 text-slate-600 max-w-xl mx-auto">
                Ada pertanyaan atau butuh bantuan? Tim kami siap membantu Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 lg:gap-12">

            <div class="lg:col-span-2 space-y-6">

                <div class="rounded-2xl bg-gradient-to-br from-emerald-600 to-navy-900 text-white p-8">
                    <h2 class="font-heading font-semibold text-lg mb-6">Informasi Kontak</h2>

                    <div class="space-y-5">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 mt-0.5 text-emerald-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            <div>
                                <p class="text-sm font-medium">Alamat</p>
                                <p class="text-sm text-emerald-100 mt-0.5">Makassar, Sulawesi Selatan</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 mt-0.5 text-emerald-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                            <div>
                                <p class="text-sm font-medium">Telepon</p>
                                <p class="text-sm text-emerald-100 mt-0.5">+62 812-3456-7890</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 mt-0.5 text-emerald-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            <div>
                                <p class="text-sm font-medium">Email</p>
                                <p class="text-sm text-emerald-100 mt-0.5">info@apotekabidzar.com</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 mt-0.5 text-emerald-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="text-sm font-medium">Jam Operasional</p>
                                <p class="text-sm text-emerald-100 mt-0.5">Setiap Hari, 08.00 - 21.00 WITA</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-emerald-100 p-6">
                    <h3 class="font-semibold text-navy-900 mb-2">Konsultasi Cepat</h3>
                    <p class="text-sm text-slate-600 mb-4">Butuh bantuan apoteker secara langsung? Isi formulir di samping, tim kami akan segera menghubungi Anda.</p>
                    <span class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-600">
                        Gratis & tanpa antre
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                </div>

            </div>

            <div class="lg:col-span-3">
                <div class="rounded-2xl border border-emerald-100 p-6 sm:p-8">
                    <h2 class="font-heading font-semibold text-lg text-navy-900 mb-6">Kirim Pesan</h2>

                    @if(session('success'))
                        <div class="mb-4 px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 text-sm">
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

                    <form
                        x-data="{ submitting: false }"
                        x-on:submit="submitting = true"
                        method="POST"
                        action="{{ route('contact.store') }}"
                        class="space-y-4"
                    >
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
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
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Pesan</label>
                            <textarea
                                name="message"
                                rows="5"
                                required
                                placeholder="Tuliskan pertanyaan atau keluhan Anda..."
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                            >{{ old('message') }}</textarea>
                        </div>

                        <button
                            type="submit"
                            x-bind:disabled="submitting"
                            class="w-full sm:w-auto px-8 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition disabled:opacity-70 flex items-center justify-center gap-2"
                        >
                            <svg x-show="submitting" x-cloak class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            <span x-text="submitting ? 'Mengirim...' : 'Kirim Pesan'"></span>
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </section>

</x-layouts.app>