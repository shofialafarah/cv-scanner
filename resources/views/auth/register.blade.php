@section('title', 'Register Akun')
<x-guest-layout>
    <div class="mb-6 text-center">
        <div
            class="inline-flex items-center justify-center w-16 h-16 bg-indigo-500/10 rounded-2xl mb-4 border border-indigo-500/20">
            <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
            </svg>
        </div>
        <h1 class="text-3xl font-black text-white tracking-tight">Buat Akun</h1>
        <p class="text-slate-500 text-sm mt-2">Daftar sekarang untuk mulai analisis CV Anda.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div class="space-y-2">
            <label for="name" class="text-sm font-bold text-slate-400 ml-1">Nama Lengkap</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus
                class="block w-full bg-slate-900/50 border border-slate-800 rounded-2xl py-2.5 px-4 text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/10 transition-all"
                placeholder="Nama Anda">
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs text-red-400" />
        </div>

        <div class="space-y-2">
            <label for="email" class="text-sm font-bold text-slate-400 ml-1">Email Address</label>
            <input id="email" type="email" name="email" :value="old('email')" required
                class="block w-full bg-slate-900/50 border border-slate-800 rounded-2xl py-2.5 px-4 text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/10 transition-all"
                placeholder="nama@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-400" />
        </div>

        <div class="space-y-1.5" x-data="{ show: false }">
            <label for="password" class="text-xs font-bold text-slate-400 ml-1">Password</label>
            <div class="relative">
                <input id="password" :type="show ? 'text' : 'password'" name="password" required
                    class="block w-full bg-slate-900/50 border border-slate-800 rounded-xl py-2.5 px-4 text-sm text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/10 transition-all"
                    placeholder="••••••••">
                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-500 hover:text-indigo-400">
                    <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="show" x-cloak class="w-4 h-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.059 10.059 0 014.59-5.325m1.857-1.411a9.458 9.458 0 013.095-.551c4.478 0 8.268 2.943 9.542 7a10.059 10.059 0 01-2.163 4.11m-2.733-2.733L12 12m0 0l-4-4m4 4l4 4m-4-4l-4 4" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="space-y-1.5" x-data="{ show: false }">
            <label for="password_confirmation" class="text-xs font-bold text-slate-400 ml-1">Konfirmasi Password</label>
            <div class="relative">
                <input id="password_confirmation" :type="show ? 'text' : 'password'" name="password_confirmation"
                    required
                    class="block w-full bg-slate-900/50 border border-slate-800 rounded-xl py-2.5 px-4 text-sm text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/10 transition-all"
                    placeholder="••••••••">
                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-500 hover:text-indigo-400">
                    <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="show" x-cloak class="w-4 h-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.059 10.059 0 014.59-5.325m1.857-1.411a9.458 9.458 0 013.095-.551c4.478 0 8.268 2.943 9.542 7a10.059 10.059 0 01-2.163 4.11m-2.733-2.733L12 12m0 0l-4-4m4 4l4 4m-4-4l-4 4" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="pt-2">
            <button type="submit"
                class="w-full bg-white text-[#0B0F1A] font-black py-2.5 px-6 rounded-2xl transition-all duration-300 hover:bg-indigo-500 hover:text-white shadow-xl shadow-white/5 active:scale-[0.98]">
                DAFTAR SEKARANG
            </button>
        </div>

        <p class="text-center text-slate-500 text-xs font-bold mt-6">
            Sudah punya akun?
            <a href="{{ route('login') }}"
                class="text-indigo-400 hover:text-indigo-300 transition-colors underline decoration-indigo-500/30 underline-offset-4">Masuk
                di sini</a>
        </p>
    </form>
</x-guest-layout>
