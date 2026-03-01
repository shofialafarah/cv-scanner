@section('title', 'Login Akun')
<x-guest-layout>
    <div class="mb-6 text-center">
        <div
            class="inline-flex items-center justify-center w-16 h-16 bg-indigo-500/10 rounded-2xl mb-4 border border-indigo-500/20">
            <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
            </svg>
        </div>
        <h1 class="text-3xl font-black text-white tracking-tight">Selamat Datang</h1>
        <p class="text-slate-500 text-sm mt-2">Masuk untuk melanjutkan analisis CV Anda.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div class="space-y-2">
            <label for="email" class="text-sm font-bold text-slate-400 ml-1">Email Address</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus
                class="block w-full bg-slate-900/50 border border-slate-800 rounded-2xl py-2.5 px-4 text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/10 transition-all"
                placeholder="nama@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-400" />
        </div>

        <div class="space-y-1.5" x-data="{ show: false }">
            <div class="flex justify-between items-center px-1">
                <label for="password" class="text-xs font-bold text-slate-400">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-[10px] font-bold text-indigo-400 hover:text-indigo-300 transition-colors"
                        href="{{ route('password.request') }}">
                        Lupa?
                    </a>
                @endif
            </div>
            <div class="relative">
                <input id="password" :type="show ? 'text' : 'password'" name="password" required
                    autocomplete="current-password"
                    class="block w-full bg-slate-900/50 border border-slate-800 rounded-xl py-2.5 px-4 text-sm text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/10 transition-all"
                    placeholder="••••••••">

                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-500 hover:text-indigo-400 transition-colors">
                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.059 10.059 0 014.59-5.325m1.857-1.411a9.458 9.458 0 013.095-.551c4.478 0 8.268 2.943 9.542 7a10.059 10.059 0 01-2.163 4.11m-2.733-2.733L12 12m0 0l-4-4m4 4l4 4m-4-4l-4 4" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-[10px] text-red-400" />
        </div>

        <div class="flex items-center ml-1">
            <input id="remember_me" type="checkbox" name="remember"
                class="w-4 h-4 rounded border-slate-800 bg-slate-900 text-indigo-600 focus:ring-indigo-500/20 focus:ring-offset-0 transition-all">
            <span
                class="ms-3 text-sm font-bold text-slate-500 hover:text-slate-400 cursor-pointer select-none">{{ __('Ingat saya') }}</span>
        </div>

        <div class="pt-2">
            <button type="submit"
                class="w-full bg-white text-[#0B0F1A] font-black py-2.5 px-6 rounded-2xl transition-all duration-300 hover:bg-indigo-500 hover:text-white shadow-xl shadow-white/5 active:scale-[0.98]">
                MASUK SEKARANG
            </button>
        </div>

        <p class="text-center text-slate-500 text-xs font-bold mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}"
                class="text-indigo-400 hover:text-indigo-300 transition-colors underline decoration-indigo-500/30 underline-offset-4">Daftar
                di sini</a>
        </p>
    </form>
</x-guest-layout>
