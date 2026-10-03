<footer class="bg-navy-900 text-white mt-auto" aria-label="Footer situs Apotek Abidzar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

            <div>
                <h3 class="font-heading font-bold text-lg text-emerald-400">Apotek Abidzar</h3>
                <p class="mt-3 text-sm text-slate-300">Kesehatan Lebih Mudah, Setiap Hari.</p>
            </div>

            <div>
                <h4 class="font-semibold text-sm mb-3 text-white">Navigasi</h4>
                <ul class="space-y-2 text-sm text-slate-300">
                    <li><a href="{{ url('/produk') }}" class="hover:text-emerald-400 transition">Produk</a></li>
                    <li><a href="{{ url('/artikel') }}" class="hover:text-emerald-400 transition">Artikel Kesehatan</a></li>
                    <li><a href="{{ url('/tentang-kami') }}" class="hover:text-emerald-400 transition">Tentang Kami</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold text-sm mb-3 text-white">Layanan</h4>
                <ul class="space-y-2 text-sm text-slate-300">
                    <li><a href="{{ url('/konsultasi') }}" class="hover:text-emerald-400 transition">Konsultasi Apoteker</a></li>
                    <li><a href="{{ url('/upload-resep') }}" class="hover:text-emerald-400 transition">Upload Resep</a></li>
                    <li><a href="{{ url('/pesanan') }}" class="hover:text-emerald-400 transition">Pesanan Saya</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold text-sm mb-3 text-white">Kontak</h4>
                <ul class="space-y-2 text-sm text-slate-300">
                    <li>Makassar, Sulawesi Selatan</li>
                    <li>info@apotekabidzar.com</li>
                    <li>+62 812-3456-7890</li>
                </ul>
            </div>
        </div>

        <div class="mt-10 pt-6 border-t border-slate-700 text-center text-xs text-slate-400">
            &copy; {{ date('Y') }} Apotek Abidzar. Seluruh hak cipta dilindungi.
        </div>
    </div>
</footer>