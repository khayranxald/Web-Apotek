<x-guest-layout :reverse="true">

    <h1 class="font-heading font-bold text-xl text-navy-900 mb-1">Buat Akun Baru</h1>
    <p class="text-sm text-slate-500 mb-6">Daftar untuk mulai berbelanja di Apotek Abidzar.</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500"
            >
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="username"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500"
            >
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div
            x-data="{
                password: '',
                get strength() {
                    if (!this.password) return 0;
                    let score = 0;
                    if (this.password.length >= 8) score++;
                    if (this.password.length >= 12) score++;
                    if (/[a-z]/.test(this.password) && /[A-Z]/.test(this.password)) score++;
                    if (/[0-9]/.test(this.password)) score++;
                    if (/[^a-zA-Z0-9]/.test(this.password)) score++;
                    return score;
                },
                get label() {
                    if (this.strength <= 1) return 'Lemah';
                    if (this.strength <= 3) return 'Sedang';
                    return 'Kuat';
                },
                get color() {
                    if (this.strength <= 1) return 'bg-red-500';
                    if (this.strength <= 3) return 'bg-amber-500';
                    return 'bg-green-500';
                },
                get textColor() {
                    if (this.strength <= 1) return 'text-red-600';
                    if (this.strength <= 3) return 'text-amber-600';
                    return 'text-green-600';
                },
                get widthPercent() {
                    return Math.min((this.strength / 5) * 100, 100);
                }
            }"
        >
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
            <input
                id="password"
                type="password"
                name="password"
                x-model="password"
                required
                autocomplete="new-password"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500"
            >

            <div x-show="password.length > 0" x-cloak class="mt-2">
                <div class="flex items-center gap-2">
                    <div class="flex-1 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                        <div
                            class="h-full rounded-full transition-all duration-300"
                            :class="color"
                            :style="`width: ${widthPercent}%`"
                        ></div>
                    </div>
                    <span class="text-xs font-medium" :class="textColor" x-text="label"></span>
                </div>
                <p class="mt-1.5 text-xs text-slate-400">
                    Gunakan minimal 8 karakter, kombinasi huruf besar, kecil, angka, dan simbol untuk password yang lebih kuat.
                </p>
            </div>

            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Password</label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500"
            >
            @error('password_confirmation')
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
            <span x-text="submitting ? 'Memproses...' : 'Daftar'"></span>
        </button>
    </form>

    <div class="my-6 flex items-center gap-3">
        <div class="flex-1 h-px bg-slate-200"></div>
        <span class="text-xs text-slate-400">atau</span>
        <div class="flex-1 h-px bg-slate-200"></div>
    </div>

    <a
        href="{{ route('auth.google') }}"
        class="w-full flex items-center justify-center gap-3 px-6 py-3 rounded-xl border border-slate-200 font-semibold text-slate-700 hover:bg-slate-50 transition"
    >
        <svg class="w-5 h-5" viewBox="0 0 24 24">
            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
        </svg>
        Daftar dengan Google
    </a>

    <p class="mt-6 text-center text-sm text-slate-500">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-emerald-600 font-medium hover:underline">Masuk di sini</a>
    </p>

</x-guest-layout>