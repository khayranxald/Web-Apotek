@props(['categories'])

<aside
    x-data="{ navigating: false }"
    x-on:click.capture="navigating = true"
    class="lg:w-64 shrink-0"
    :class="navigating ? 'opacity-50 pointer-events-none transition-opacity' : ''"
>
    <h2 class="font-heading font-semibold text-navy-900 mb-3">
        Kategori
    </h2>

    <ul class="space-y-1">

        {{-- Semua Kategori --}}
        <li>
            <a
                href="{{ route('products.index', array_filter([
                    'search' => request('search'),
                ])) }}"
                class="block px-3 py-2 rounded-lg text-sm transition {{ !request('category') ? 'bg-emerald-600 text-white' : 'text-slate-700 hover:bg-emerald-50' }}"
            >
                Semua Kategori
            </a>
        </li>

        {{-- Daftar Kategori --}}
        @foreach($categories as $category)
            <li>
                <a
                    href="{{ route('products.index', array_filter([
                        'category' => $category->slug,
                        'search' => request('search'),
                    ])) }}"
                    class="block px-3 py-2 rounded-lg text-sm transition {{ request('category') === $category->slug ? 'bg-emerald-600 text-white' : 'text-slate-700 hover:bg-emerald-50' }}"
                >
                    {{ $category->name }}
                </a>
            </li>
        @endforeach

    </ul>
</aside>