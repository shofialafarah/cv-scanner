<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-500/10 rounded-2xl mb-4 border border-indigo-500/20">
            <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
            </svg>
        </div>
        <h1 class="text-3xl font-black text-white tracking-tight">Selamat Datang</h1>
        <p class="text-slate-500 text-sm mt-2">Masuk untuk melanjutkan analisis CV Anda.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div class="space-y-2">
            <label for="email" class="text-sm font-bold text-slate-400 ml-1">Email Address</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                class="block w-full bg-slate-900/50 border border-slate-800 rounded-2xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/10 transition-all"
                placeholder="nama@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-400" />
        </div>

        <div class="space-y-2">
            <div class="flex justify-between items-center px-1">
                <label for="password" class="text-sm font-bold text-slate-400">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-indigo-400 hover:text-indigo-300 transition-colors" href="{{ route('password.request') }}">
                        Lupa?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="block w-full bg-slate-900/50 border border-slate-800 rounded-2xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/10 transition-all"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-400" />
        </div>

        <div class="flex items-center ml-1">
            <input id="remember_me" type="checkbox" name="remember" 
                class="w-4 h-4 rounded border-slate-800 bg-slate-900 text-indigo-600 focus:ring-indigo-500/20 focus:ring-offset-0 transition-all">
            <span class="ms-3 text-sm font-bold text-slate-500 hover:text-slate-400 cursor-pointer select-none">{{ __('Ingat saya') }}</span>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full bg-white text-[#0B0F1A] font-black py-4 px-6 rounded-2xl transition-all duration-300 hover:bg-indigo-500 hover:text-white shadow-xl shadow-white/5 active:scale-[0.98]">
                MASUK SEKARANG
            </button>
        </div>

        <p class="text-center text-slate-500 text-xs font-bold mt-6">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 transition-colors underline decoration-indigo-500/30 underline-offset-4">Daftar di sini</a>
        </p>
    </form>
</x-guest-layout>