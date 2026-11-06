<footer class="bg-navy-900 text-white mt-auto" aria-label="Footer situs Apotek Abidzar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

            <div>
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Apotek Abidzar" class="w-7 h-7 object-contain brightness-0 invert">
                    <h3 class="font-heading font-bold text-lg text-emerald-400">Apotek Abidzar</h3>
                </div>
                <p class="mt-3 text-sm text-slate-300">Kesehatan Lebih Mudah, Setiap Hari.</p>
            </div>

            <div>
                <h4 class="font-semibold text-sm mb-3 text-white">Navigasi</h4>
                <ul class="space-y-2 text-sm text-slate-300">
                    <li><a href="{{ route('products.index') }}" class="hover:text-emerald-400 transition">Produk</a></li>
                    <li><a href="{{ route('articles.index') }}" class="hover:text-emerald-400 transition">Artikel Kesehatan</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-emerald-400 transition">Tentang Kami</a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-emerald-400 transition">FAQ</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold text-sm mb-3 text-white">Layanan</h4>
                <ul class="space-y-2 text-sm text-slate-300">
                    <li><a href="{{ route('contact') }}" class="hover:text-emerald-400 transition">Konsultasi Apoteker</a></li>
                    @auth
                        <li><a href="{{ route('prescriptions.create') }}" class="hover:text-emerald-400 transition">Upload Resep</a></li>
                        <li><a href="{{ route('orders.index') }}" class="hover:text-emerald-400 transition">Pesanan Saya</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="hover:text-emerald-400 transition">Upload Resep</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-emerald-400 transition">Pesanan Saya</a></li>
                    @endauth
                </ul>
            </div>

            <div>
                <h4 class="font-semibold text-sm mb-3 text-white">Kontak</h4>
                <ul class="space-y-2 text-sm text-slate-300">
                    <li>Makassar, Sulawesi Selatan</li>
                    <li>info@apotekabidzar.com</li>
                    <li>+62 812-3456-7890</li>
                </ul>
                <a href="{{ route('contact') }}" class="mt-3 inline-block text-sm text-emerald-400 hover:underline">
                    Hubungi Kami →
                </a>
            </div>
        </div>

<div class="mt-10 rounded-2xl overflow-hidden border border-slate-700">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31787.76!2d119.4221!3d-5.1477!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNcKwOCc0MS43IlMgMTE5wrAyNScxOS42IkU!5e0!3m2!1sid!2sid!4v1234567890"
                width="100%"
                height="250"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Lokasi Apotek Abidzar"
                class="grayscale-[30%] opacity-90"
            ></iframe>
        </div>

        <div class="mt-6 pt-6 border-t border-slate-700 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
            <p class="text-xs text-slate-400">
                &copy; {{ date('Y') }} Apotek Abidzar. Seluruh hak cipta dilindungi.
            </p>
            <p class="text-xs text-slate-500">
                Aman · Cepat · Terpercaya
            </p>
        </div>
    </div>
</footer>