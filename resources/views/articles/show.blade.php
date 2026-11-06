<x-layouts.app :title="$article->title">

    <article class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-emerald-600 transition mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Artikel
        </a>

        <p class="text-sm text-emerald-600 font-medium">{{ $article->published_at->translatedFormat('d F Y') }}</p>
        <h1 class="mt-2 font-heading font-bold text-2xl sm:text-3xl text-navy-900 leading-tight">
            {{ $article->title }}
        </h1>
        @if($article->author)
            <p class="mt-3 text-sm text-slate-500">oleh {{ $article->author->name }}</p>
        @endif

        @if($article->cover_image)
            <div class="mt-6 rounded-2xl overflow-hidden aspect-video bg-emerald-50">
                <img src="{{ Storage::url($article->cover_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
            </div>
        @endif

        <div class="mt-8 prose prose-emerald max-w-none text-slate-700">
            {!! $article->content !!}
        </div>

        @if($relatedArticles->isNotEmpty())
            <div class="mt-16 pt-10 border-t border-slate-100">
                <h2 class="font-heading font-semibold text-xl text-navy-900 mb-6">Artikel Lainnya</h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @foreach($relatedArticles as $related)
                        <a href="{{ route('articles.show', $related->slug) }}" class="block group">
                            <p class="text-xs text-emerald-600 font-medium">{{ $related->published_at->translatedFormat('d F Y') }}</p>
                            <h3 class="mt-1 text-sm font-semibold text-navy-900 line-clamp-2 group-hover:text-emerald-700 transition">
                                {{ $related->title }}
                            </h3>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </article>

</x-layouts.app>