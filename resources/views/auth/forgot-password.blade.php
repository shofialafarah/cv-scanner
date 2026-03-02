@section('title', 'Reset Password')
<x-guest-layout>
    <div class="mb-6 md:mb-8 text-center px-2">
        <div class="inline-flex items-center justify-center w-14 h-14 md:w-16 md:h-16 bg-indigo-500/10 rounded-2xl mb-4 border border-indigo-500/20">
            <svg class="w-7 h-7 md:w-8 md:h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
            </svg>
        </div>
        <h1 class="text-2xl md:text-3xl font-black text-white tracking-tight">Lupa Password?</h1>
        <p class="text-slate-500 text-[11px] md:text-sm mt-2 px-4 max-w-[280px] md:max-w-none mx-auto leading-relaxed">
            Jangan khawatir! Masukkan email Anda dan kami akan kirimkan link reset password.
        </p>
    </div>

    <x-auth-session-status class="mb-5 text-[10px] md:text-xs text-green-400 bg-green-500/10 p-3 md:p-4 rounded-xl border border-green-500/20" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5 px-1 md:px-0">
        @csrf

        <div class="space-y-2">
            <label for="email" class="text-xs md:text-sm font-bold text-slate-400 ml-1">Email Address</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                class="block w-full bg-slate-900/50 border border-slate-800 rounded-xl md:rounded-2xl py-2.5 md:py-3 px-4 text-sm md:text-base text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/10 transition-all"
                placeholder="nama@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-[10px] md:text-xs text-red-400" />
        </div>

        <div class="pt-2 md:pt-4">
            <button type="submit" class="w-full bg-white text-[#0B0F1A] text-sm md:text-base font-black py-3 md:py-3.5 px-6 rounded-xl md:rounded-2xl transition-all duration-300 hover:bg-indigo-500 hover:text-white shadow-xl shadow-white/5 active:scale-[0.98]">
                KIRIM LINK RESET
            </button>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 text-[11px] md:text-xs font-bold transition-colors inline-flex items-center justify-center gap-2 group">
                <svg class="w-3 h-3 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Login
            </a>
        </div>
    </form>
</x-guest-layout>