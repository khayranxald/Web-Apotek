<x-layouts.app title="Upload Resep">

    <section class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <a href="{{ route('prescriptions.index') }}" class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-emerald-600 transition mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Resep Saya
        </a>

        <h1 class="font-heading font-bold text-2xl sm:text-3xl text-navy-900 mb-2">Upload Resep</h1>
        <p class="text-slate-600 mb-6">Unggah foto atau scan resep dokter Anda untuk direview oleh apoteker kami.</p>

        @if($errors->any())
            <div class="mb-4 px-4 py-3 rounded-xl bg-red-50 text-red-700 text-sm">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form
            x-data="{ submitting: false, fileName: null }"
            x-on:submit="submitting = true"
            method="POST"
            action="{{ route('prescriptions.store') }}"
            enctype="multipart/form-data"
            class="p-6 rounded-2xl border border-emerald-100"
        >
            @csrf

            <label
                for="file-upload"
                class="block border-2 border-dashed border-emerald-200 rounded-2xl p-8 text-center cursor-pointer hover:border-emerald-400 hover:bg-emerald-50/50 transition"
            >
                <svg class="w-10 h-10 mx-auto text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15m0-3l-3-3m0 0l-3 3m3-3V15" />
                </svg>

                <p class="mt-3 text-sm font-medium text-navy-900" x-text="fileName ?? 'Klik untuk pilih file'"></p>
                <p class="mt-1 text-xs text-slate-400">Format: JPG, PNG, atau PDF. Maksimal 5MB.</p>

                <input
                    id="file-upload"
                    type="file"
                    name="file"
                    accept=".jpg,.jpeg,.png,.pdf"
                    required
                    class="hidden"
                    x-on:change="fileName = $event.target.files[0]?.name ?? null"
                >
            </label>

            <button
                type="submit"
                x-bind:disabled="submitting || !fileName"
                class="mt-6 w-full px-6 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
            >
                <svg x-show="submitting" x-cloak class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
                <span x-text="submitting ? 'Mengunggah...' : 'Unggah Resep'"></span>
            </button>
        </form>
    </section>

</x-layouts.app>