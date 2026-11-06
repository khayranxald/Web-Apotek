<x-layouts.app title="FAQ">

    <section class="bg-gradient-to-b from-emerald-50 to-white py-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-heading font-bold text-3xl sm:text-4xl text-navy-900">Pertanyaan yang Sering Diajukan</h1>
            <p class="mt-3 text-slate-600">Temukan jawaban cepat untuk pertanyaan umum seputar layanan kami.</p>
        </div>
    </section>

    <section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="space-y-3" x-data="{ open: null }">

            @php
                $faqs = [
                    [
                        'q' => 'Bagaimana cara memesan obat di Apotek Abidzar?',
                        'a' => 'Pilih produk yang Anda butuhkan di halaman Produk, tambahkan ke keranjang, lalu lanjutkan ke checkout. Isi alamat pengiriman, pilih metode pembayaran, dan pesanan Anda akan segera diproses.',
                    ],
                    [
                        'q' => 'Apakah semua obat bisa dibeli tanpa resep dokter?',
                        'a' => 'Tidak. Beberapa obat memerlukan resep dokter sesuai ketentuan kesehatan. Produk yang memerlukan resep akan diberi label "Perlu Resep" — Anda perlu mengunggah foto resep dokter terlebih dahulu sebelum dapat membeli produk tersebut.',
                    ],
                    [
                        'q' => 'Bagaimana cara mengunggah resep dokter?',
                        'a' => 'Login ke akun Anda, buka menu "Upload Resep" dari navbar atau dashboard, lalu unggah foto/scan resep dalam format JPG, PNG, atau PDF (maksimal 5MB). Apoteker kami akan meninjau resep Anda dan memberikan status Approved atau Rejected beserta catatan.',
                    ],
                    [
                        'q' => 'Berapa lama proses review resep oleh apoteker?',
                        'a' => 'Umumnya resep akan ditinjau dalam waktu 1x24 jam pada hari kerja. Anda akan menerima notifikasi email begitu status resep Anda berubah.',
                    ],
                    [
                        'q' => 'Berapa biaya ongkos kirim?',
                        'a' => 'Ongkos kirim dihitung otomatis berdasarkan kota tujuan Anda saat proses checkout. Semakin dekat dengan Makassar, umumnya semakin terjangkau biayanya.',
                    ],
                    [
                        'q' => 'Metode pembayaran apa saja yang tersedia?',
                        'a' => 'Kami mendukung berbagai metode pembayaran melalui Midtrans, termasuk transfer Virtual Account (BCA, BNI, BRI, Mandiri, dll), GoPay, QRIS, dan kartu kredit/debit.',
                    ],
                    [
                        'q' => 'Bagaimana cara melacak status pesanan saya?',
                        'a' => 'Buka menu "Pesanan Saya" setelah login untuk melihat riwayat dan status terkini dari setiap pesanan Anda, mulai dari Pending hingga Selesai.',
                    ],
                    [
                        'q' => 'Apakah data pribadi dan resep saya aman?',
                        'a' => 'Ya. Kami menerapkan sistem keamanan berlapis — file resep disimpan di penyimpanan privat yang hanya dapat diakses oleh Anda dan apoteker yang berwenang, tidak dapat diakses publik.',
                    ],
                    [
                        'q' => 'Bagaimana jika saya ingin membatalkan pesanan?',
                        'a' => 'Silakan hubungi tim kami melalui halaman Kontak secepat mungkin. Pembatalan hanya dapat dilakukan selama pesanan masih berstatus Pending atau belum diproses lebih lanjut.',
                    ],
                    [
                        'q' => 'Bagaimana cara menghubungi apoteker untuk konsultasi?',
                        'a' => 'Anda dapat mengisi formulir di halaman Kontak, atau menghubungi nomor telepon kami langsung. Konsultasi dasar seputar produk yang Anda beli bersifat gratis.',
                    ],
                ];
            @endphp

            @foreach($faqs as $index => $faq)
                <div class="border border-emerald-100 rounded-2xl overflow-hidden">
                    <button
                        type="button"
                        @click="open = open === {{ $index }} ? null : {{ $index }}"
                        class="w-full flex items-center justify-between gap-4 px-5 py-4 text-left hover:bg-emerald-50/50 transition"
                    >
                        <span class="font-medium text-navy-900 text-sm sm:text-base">{{ $faq['q'] }}</span>
                        <svg
                            class="w-5 h-5 text-emerald-600 shrink-0 transition-transform duration-200"
                            :class="open === {{ $index }} ? 'rotate-180' : ''"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div
                        x-show="open === {{ $index }}"
                        x-collapse
                        x-cloak
                    >
                        <p class="px-5 pb-4 text-sm text-slate-600 leading-relaxed">{{ $faq['a'] }}</p>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="mt-10 text-center p-8 rounded-2xl bg-emerald-50">
            <p class="font-semibold text-navy-900">Masih punya pertanyaan lain?</p>
            <p class="mt-1 text-sm text-slate-600">Tim kami siap membantu Anda kapan saja.</p>
            <a href="{{ route('contact') }}" class="mt-4 inline-block px-6 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition">
                Hubungi Kami
            </a>
        </div>
    </section>

</x-layouts.app>