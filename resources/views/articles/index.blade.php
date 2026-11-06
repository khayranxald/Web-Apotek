<x-layouts.app title="Artikel Kesehatan">

    <section class="bg-gradient-to-b from-emerald-50 to-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-heading font-bold text-3xl sm:text-4xl text-navy-900">Artikel Kesehatan</h1>
            <p class="mt-3 text-slate-600">Informasi dan tips kesehatan terpercaya dari tim Apotek Abidzar.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($articles->isEmpty())
            <div class="text-center py-20">
                <p class="text-slate-500">Belum ada artikel yang tersedia saat ini.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($articles as $article)
                    <a href="{{ route('articles.show', $article->slug) }}" class="group block rounded-2xl border border-emerald-100 overflow-hidden shadow-sm hover:shadow-md transition">
                        <div class="aspect-video bg-emerald-50 overflow-hidden">
                            @if($article->cover_image)
                                <img src="{{ Storage::url($article->cover_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-emerald-300">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-5">
                            <p class="text-xs text-emerald-600 font-medium">{{ $article->published_at->translatedFormat('d F Y') }}</p>
                            <h3 class="mt-1 font-heading font-semibold text-navy-900 line-clamp-2 group-hover:text-emerald-700 transition">
                                {{ $article->title }}
                            </h3>
                            @if($article->excerpt)
                                <p class="mt-2 text-sm text-slate-600 line-clamp-2">{{ $article->excerpt }}</p>
                            @endif
                            @if($article->author)
                                <p class="mt-3 text-xs text-slate-400">oleh {{ $article->author->name }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $articles->links() }}
            </div>
        @endif
    </section>

</x-layouts.app>