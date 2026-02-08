<nav x-data="{ open: false }"
    class="bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-40 transition-all duration-300 shadow-sm shadow-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                        <img src="{{ asset('images/logo_kemenag.png') }}" alt="PMBM MAN 1 Tegal" class="block w-10 h-10">
                        <span
                            class="text-xl font-black text-gray-900 tracking-tighter uppercase italic group-hover:text-green-600 transition-colors">PMBM
                            <span class="text-green-600 font-light group-hover:text-gray-900">Admin</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:-my-px sm:ms-12 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="px-4 text-[11px] font-black uppercase tracking-widest hover:text-green-600 transition-colors">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.casis.index')" :active="request()->routeIs('admin.casis.*')"
                        class="px-4 text-[11px] font-black uppercase tracking-widest hover:text-green-600 transition-colors">
                        {{ __('Pendaftar') }}
                    </x-nav-link>

                    @if(Auth::user()->role === 'admin')
                    <x-nav-link :href="route('admin.nilai.index')" :active="request()->routeIs('admin.nilai.*')"
                        class="px-4 text-[11px] font-black uppercase tracking-widest hover:text-green-600 transition-colors">
                        {{ __('Nilai') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')"
                        class="px-4 text-[11px] font-black uppercase tracking-widest hover:text-green-600 transition-colors">
                        {{ __('Pengguna') }}
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="h-8 w-px bg-gray-100 mx-6"></div>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center gap-3 p-1.5 rounded-2xl hover:bg-gray-50 transition-all duration-300">
                            <div class="flex flex-col items-end">
                                <span class="text-xs font-black text-gray-900 uppercase tracking-tight">{{
                                    Auth::user()->name }}</span>
                                <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">{{
                                    Auth::user()->role }}</span>
                            </div>
                            <div
                                class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 font-black text-sm border border-gray-50 shadow-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="p-2">
                            <x-dropdown-link :href="route('profile.edit')"
                                class="rounded-xl flex items-center gap-3 text-xs font-bold py-3">
                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ __('Profil') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('admin.settings')"
                                class="rounded-xl flex items-center gap-3 text-xs font-bold py-3">
                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ __('Pengaturan') }}
                            </x-dropdown-link>

                            <div class="h-px bg-gray-50 my-1"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="rounded-xl flex items-center gap-3 text-xs font-bold py-3 text-red-600 hover:bg-red-50">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    {{ __('Keluar Sistem') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="p-2 rounded-xl text-gray-400 hover:text-green-600 hover:bg-green-50 transition-all">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-50 bg-white">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="rounded-2xl font-black uppercase text-[10px] tracking-widest my-1">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.casis.index')" :active="request()->routeIs('admin.casis.*')"
                class="rounded-2xl font-black uppercase text-[10px] tracking-widest my-1">
                {{ __('Pendaftar') }}
            </x-responsive-nav-link>

            @if(Auth::user()->role === 'admin')
            <x-responsive-nav-link :href="route('admin.nilai.index')" :active="request()->routeIs('admin.nilai.*')"
                class="rounded-2xl font-black uppercase text-[10px] tracking-widest my-1">
                {{ __('Nilai') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')"
                class="rounded-2xl font-black uppercase text-[10px] tracking-widest my-1">
                {{ __('Pengguna') }}
            </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-6 border-t border-gray-50 px-4 mt-4">
            <div class="flex items-center gap-4 px-4 py-2">
                <div
                    class="w-12 h-12 bg-gray-100 rounded-2xl flex items-center justify-center text-gray-400 font-black border border-gray-50">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="font-black text-sm text-gray-900 uppercase tracking-tight">{{ Auth::user()->name }}
                    </div>
                    <div class="font-bold text-[10px] text-gray-400 uppercase tracking-widest">{{ Auth::user()->email }}
                    </div>
                </div>
            </div>

            <div class="mt-4 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="rounded-2xl font-bold text-xs">
                    {{ __('Atur Profil') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="rounded-2xl font-bold text-xs text-red-600">
                        {{ __('Keluar Sistem') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>