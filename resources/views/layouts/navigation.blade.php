<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    {{-- Jika HR, tampilkan menu Manajemen --}}
    @if(Auth::user()->role === 'hr')
        <x-nav-link :href="route('jobs.index')" :active="request()->routeIs('jobs.*')">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            {{ __('Manajemen Lowongan') }}
        </x-nav-link>
    @endif

    {{-- Jika Kandidat, tampilkan menu Lamaran --}}
    {{-- @if(Auth::user()->role === 'candidate')
        <x-nav-link :href="route('candidates.index')" :active="request()->routeIs('candidates.index')">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01m-.01 4h.01"></path></svg>
            {{ __('Lamaran Saya') }}
        </x-nav-link>
        
        <x-nav-link :href="route('home')" :active="false">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            {{ __('Cari Lowongan') }}
        </x-nav-link>
    @endif --}}
</div>