@props(['categories'])

{{-- Mobile: Horizontal scrollable pills --}}
<div class="lg:hidden -mx-4 px-4 mb-6 relative">
    <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-hide">
        <a
            href="{{ route('products.index', array_filter(['search' => request('search')])) }}"
            class="shrink-0 px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition {{ !request('category') ? 'bg-emerald-600 text-white' : 'bg-emerald-50 text-slate-700 hover:bg-emerald-100' }}"
        >
            Semua Kategori
        </a>
        @foreach($categories as $category)
            <a
                href="{{ route('products.index', array_filter(['category' => $category->slug, 'search' => request('search')])) }}"
                class="shrink-0 px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition {{ request('category') === $category->slug ? 'bg-emerald-600 text-white' : 'bg-emerald-50 text-slate-700 hover:bg-emerald-100' }}"
            >
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    <div class="absolute right-4 top-0 bottom-2 w-10 bg-gradient-to-l from-white to-transparent pointer-events-none"></div>
</div>

{{-- Desktop: Vertical sidebar --}}
<aside x-data="{ navigating: false }" x-on:click.capture="navigating = true" class="hidden lg:block lg:w-64 shrink-0" :class="navigating ? 'opacity-50 pointer-events-none transition-opacity' : ''">
    <h2 class="font-heading font-semibold text-navy-900 mb-3">Kategori</h2>
    <ul class="space-y-1">
        <li>
            <a
                href="{{ route('products.index', array_filter(['search' => request('search')])) }}"
                class="block px-3 py-2 rounded-lg text-sm transition {{ !request('category') ? 'bg-emerald-600 text-white' : 'text-slate-700 hover:bg-emerald-50' }}"
            >
                Semua Kategori
            </a>
        </li>
        @foreach($categories as $category)
            <li>
                <a
                    href="{{ route('products.index', array_filter(['category' => $category->slug, 'search' => request('search')])) }}"
                    class="block px-3 py-2 rounded-lg text-sm transition {{ request('category') === $category->slug ? 'bg-emerald-600 text-white' : 'text-slate-700 hover:bg-emerald-50' }}"
                >
                    {{ $category->name }}
                </a>
            </li>
        @endforeach
    </ul>
</aside>