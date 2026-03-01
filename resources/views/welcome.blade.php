<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karir CV Scanner</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&display=swap"
        rel="stylesheet">

    <style>
        * {
            font-family: 'Bricolage Grotesque', sans-serif !important;
        }

        h2,
        h3,
        h4 {
            letter-spacing: -0.02em;
        }

        /* Tambahan agar scroll halus */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-[#0B0F1A] text-slate-200 selection:bg-indigo-500/30">
    <nav class="sticky top-0 z-50 py-6 px-4">
        <div class="max-w-7xl mx-auto">
            <div
                class="bg-[#161B2D]/80 backdrop-blur-xl shadow-2xl rounded-2xl px-6 py-4 flex justify-between items-center border border-white/5">
                <a href="/" class="text-2xl font-black tracking-tighter text-white flex items-center">
                    <span
                        class="bg-gradient-to-br from-indigo-500 to-violet-700 text-white p-2 rounded-lg mr-2 shadow-[0_0_15px_rgba(99,102,241,0.5)]">CV</span>
                    SCANNER
                </a>
                <div class="space-x-6 flex items-center font-bold text-sm">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-slate-400 hover:text-white transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-400 hover:text-white transition">Masuk</a>
                        <a href="{{ route('register') }}"
                            class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl hover:bg-indigo-500 transition shadow-lg shadow-indigo-500/20">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <header class="py-16">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="dark:text-white text-4xl md:text-5xl font-extrabold mb-4">Temukan Karir Impian Anda</h2>
            <p class="dark:text-gray-400 text-lg max-w-2xl mx-auto">Upload CV Anda dan biarkan AI kami mencocokkan
                keahlian Anda dengan lowongan yang tersedia secara objektif.</p>
        </div>
    </header>

    <main class="py-12 max-w-7xl mx-auto px-6">
        <h3 class="text-2xl font-bold mb-8 flex items-center">
            <span class="w-2 h-8 bg-indigo-600 mr-3 rounded-full"></span>
            Lowongan Terbaru
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($jobs as $job)
                <div
                    class="bg-[#161B2D] border border-slate-800 rounded-[2rem] p-8 hover:shadow-[0_20px_50px_rgba(0,0,0,0.5)] hover:-translate-y-2 transition-all duration-500 flex flex-col h-full group">
                    <div class="mb-auto">
                        <div class="flex justify-between items-center mb-6">
                            <span
                                class="bg-indigo-500/10 text-indigo-400 text-[10px] font-black px-4 py-1.5 rounded-full uppercase border border-indigo-500/20">
                                {{ $job->category ?? 'Full Time' }}
                            </span>
                            @php
                                $deadline = \Carbon\Carbon::parse($job->deadline);
                                $daysLeft = (int) now()->diffInDays($deadline, false);
                            @endphp

                            @if ($daysLeft <= 0)
                                <div
                                    class="flex items-center text-[10px] text-red-400 font-bold bg-red-500/10 px-3 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-2"></span> Terakhir Hari Ini
                                </div>
                            @elseif($daysLeft <= 2)
                                <div
                                    class="flex items-center text-[10px] text-amber-400 font-bold bg-amber-500/10 px-3 py-1 rounded-full animate-pulse border border-amber-500/20">
                                    <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mr-2"></span> Urgent
                                    ({{ $daysLeft }} Hari Lagi)
                                </div>
                            @else
                                <div
                                    class="flex items-center text-[10px] text-emerald-400 font-bold bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-2 animate-pulse"></span>
                                    Aktif
                                </div>
                            @endif
                        </div>

                        <h4 class="text-2xl font-bold mb-3 text-white transition-colors">{{ $job->title }}</h4>
                        <p class="text-slate-400 text-sm mb-8 leading-relaxed font-light">{{ $job->description }}</p>
                    </div>
                    <div
                        class="flex items-center gap-2 mb-6 text-slate-500 text-[10px] font-bold uppercase tracking-widest">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v14a2 2 0 002 2z" />
                        </svg>
                        Batas: {{ $deadline->translatedFormat('d F Y') }}
                    </div>

                    <a href="{{ route('candidates.create', ['job_post_id' => $job->id]) }}"
                        class="block w-full text-center bg-indigo-600 hover:bg-indigo-500 text-white font-black py-4 rounded-2xl shadow-xl shadow-indigo-900/20 transition-all duration-300">
                        Lamar Sekarang
                    </a>
                </div>
            @empty
                <p class="text-slate-500 text-center col-span-full">Belum ada lowongan tersedia.</p>
            @endforelse
        </div>
    </main>

    <x-footer />
</body>

</html>
