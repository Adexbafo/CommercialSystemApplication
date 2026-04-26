<nav class="bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            <div class="flex items-center">
                <div class="shrink-0 flex items-center mr-8">
                    <a href="{{ route('dashboard') }}" class="font-black text-xl tracking-tight text-blue-600">
                        Commercial<span class="text-slate-900">System</span>
                    </a>
                </div>

                <div class="hidden space-x-2 sm:flex items-center">
                    <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('dashboard') ? 'bg-slate-100 text-slate-900' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
                        {{ __('Marketplace') }}
                    </a>

                    @if(Auth::user()->id === 1 || Auth::user()->email === 'your-email@example.com')
    <div class="h-4 w-px bg-slate-200 mx-2"></div> 
    <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('admin.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}">
        {{ __('Admin Panel') }}
    </a>
@endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center space-x-6">
                <a href="{{ route('cart.index') }}" class="relative p-2 text-slate-500 hover:text-blue-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-bold text-slate-600 hover:text-slate-900 focus:outline-none transition">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="ms-1 h-4 w-4 fill-current" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('orders.index')">{{ __('My Orders') }}</x-dropdown-link>
                        <hr class="border-slate-100">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>