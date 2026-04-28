<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-40">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center mr-10">
                    <a href="{{ route('dashboard') }}" class="font-black text-2xl tracking-tighter text-primary-600 hover:scale-105 transition-transform duration-300">
                        Commercial<span class="text-slate-900">System</span>
                    </a>
                </div>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden space-x-1 sm:flex items-center">
                    <a href="{{ route('dashboard') }}" 
                       class="px-4 py-2 rounded-xl text-sm font-bold transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-primary-50 text-primary-600' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                        {{ __('Marketplace') }}
                    </a>

                    @if(Auth::user()->id === 1 || Auth::user()->email === 'your-email@example.com')
                        <div class="h-4 w-px bg-slate-200 mx-2"></div> 
                        <a href="{{ route('admin.dashboard') }}" 
                           class="px-4 py-2 rounded-xl text-sm font-bold transition-all duration-300 {{ request()->routeIs('admin.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                            {{ __('Admin Panel') }}
                        </a>
                    @endif
                </div>
            </div>

            <!-- Settings & Actions (Desktop) -->
            <div class="hidden sm:flex sm:items-center space-x-4">
                <!-- Cart Icon -->
                <a href="{{ route('cart.index') }}" class="relative p-2.5 bg-slate-50 rounded-xl text-slate-500 hover:text-primary-600 hover:bg-primary-50 transition-all duration-300 group">
                    <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="absolute -top-1 -right-1 inline-flex items-center justify-center min-w-[20px] h-5 px-1 text-[10px] font-black leading-none text-white bg-primary-600 rounded-full border-2 border-white">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2.5 bg-slate-50 rounded-xl text-sm font-bold text-slate-700 hover:bg-slate-100 hover:text-slate-900 focus:outline-none transition-all duration-300">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="ms-2 h-4 w-4 text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-slate-50">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Signed in as</p>
                            <p class="text-sm font-bold text-slate-900 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        
                        <div class="p-1">
                            <x-dropdown-link :href="route('profile.edit')" class="rounded-lg font-bold text-slate-600 hover:text-primary-600 hover:bg-primary-50">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('orders.index')" class="rounded-lg font-bold text-slate-600 hover:text-primary-600 hover:bg-primary-50">
                                {{ __('My Orders') }}
                            </x-dropdown-link>
                        </div>

                        <div class="border-t border-slate-100 p-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="rounded-lg font-bold text-rose-600 hover:bg-rose-50">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <a href="{{ route('cart.index') }}" class="relative p-2 text-slate-500 mr-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-[10px] font-black leading-none text-white bg-primary-600 rounded-full border border-white">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2.5 rounded-xl text-slate-500 hover:text-primary-600 hover:bg-primary-50 focus:outline-none transition-all duration-300">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div x-show="open" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="sm:hidden bg-white border-t border-slate-100 shadow-2xl relative z-50">
        <div class="pt-4 pb-3 space-y-1 px-4">
            <a href="{{ route('dashboard') }}" 
               class="flex items-center px-4 py-3 rounded-xl text-base font-bold transition-all {{ request()->routeIs('dashboard') ? 'bg-primary-50 text-primary-600' : 'text-slate-600 hover:bg-slate-50' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                {{ __('Marketplace') }}
            </a>
            @if(Auth::user()->id === 1 || Auth::user()->email === 'your-email@example.com')
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-3 rounded-xl text-base font-bold transition-all {{ request()->routeIs('admin.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-50' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    {{ __('Admin Panel') }}
                </a>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-6 border-t border-slate-100 bg-slate-50/50">
            <div class="px-8 mb-4">
                <div class="text-base font-black text-slate-900">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-slate-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="px-4 space-y-1">
                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 rounded-xl text-base font-bold text-slate-600 hover:bg-white hover:shadow-sm transition-all">
                    <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    {{ __('Profile Settings') }}
                </a>
                <a href="{{ route('orders.index') }}" class="flex items-center px-4 py-3 rounded-xl text-base font-bold text-slate-600 hover:bg-white hover:shadow-sm transition-all">
                    <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    {{ __('Order History') }}
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-4 py-3 rounded-xl text-base font-bold text-rose-600 hover:bg-rose-50 transition-all">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4-4H7m6 4v1h1V7h-1z" /></svg>
                        {{ __('Sign Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>