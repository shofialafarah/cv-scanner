@section('title', 'Reset Password')
<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="inline-flex items-center justify-center w-14 h-14 bg-indigo-500/10 rounded-2xl mb-3 border border-indigo-500/20">
            <svg class="w-7 h-7 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
            </svg>
        </div>
        <h1 class="text-2xl font-black text-white tracking-tight">Lupa Password?</h1>
        <p class="text-slate-500 text-[11px] mt-2 px-4">
            Jangan khawatir! Masukkan email Anda dan kami akan kirimkan link reset password.
        </p>
    </div>

    <x-auth-session-status class="mb-4 text-xs text-green-400 bg-green-500/10 p-3 rounded-xl border border-green-500/20" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div class="space-y-1.5">
            <label for="email" class="text-xs font-bold text-slate-400 ml-1">Email Address</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                class="block w-full bg-slate-900/50 border border-slate-800 rounded-xl py-2.5 px-4 text-sm text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-500/10 transition-all"
                placeholder="nama@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-[10px] text-red-400" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full bg-white text-[#0B0F1A] text-sm font-black py-3 px-6 rounded-xl transition-all duration-300 hover:bg-indigo-500 hover:text-white shadow-lg active:scale-[0.98]">
                KIRIM LINK RESET
            </button>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 text-[11px] font-bold transition-colors flex items-center justify-center gap-2">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Login
            </a>
        </div>
    </form>
</x-guest-layout>