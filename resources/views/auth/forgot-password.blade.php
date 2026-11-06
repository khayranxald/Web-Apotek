<x-guest-layout>

    <h1 class="font-heading font-bold text-xl text-navy-900 mb-1">Lupa Password?</h1>
    <p class="text-sm text-slate-500 mb-6">
        Tidak masalah. Masukkan email Anda dan kami akan mengirimkan link untuk membuat password baru.
    </p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500"
            >
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            x-data="{ submitting: false }"
            x-on:click="submitting = true"
            x-bind:disabled="submitting"
            class="w-full px-6 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition disabled:opacity-70 flex items-center justify-center gap-2"
        >
            <svg x-show="submitting" x-cloak class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>
            <span x-text="submitting ? 'Mengirim...' : 'Kirim Link Reset Password'"></span>
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">
        Ingat password Anda?
        <a href="{{ route('login') }}" class="text-emerald-600 font-medium hover:underline">Kembali ke Login</a>
    </p>

</x-guest-layout>