<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="CommercialSystem - The premier marketplace for high-end curated goods and premium assets.">
        <meta name="keywords" content="marketplace, premium, curated, luxury, digital assets">

        <title>{{ config('app.name', 'CommercialSystem') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#F8FAFC] text-slate-900 selection:bg-primary-100 selection:text-primary-700">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-30">
                    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow">
                @if(session('success'))
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                        <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl flex items-center gap-3 animate-in fade-in slide-in-from-top-4 duration-500" role="alert">
                            <div class="p-1.5 bg-emerald-500 rounded-full">
                                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="font-bold text-sm tracking-wide">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif
                
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-slate-100 py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
                        <div class="col-span-1">
                            <div class="font-black text-2xl tracking-tighter text-primary-600 mb-6">
                                Commercial<span class="text-slate-900">System</span>
                            </div>
                            <p class="text-slate-500 font-medium leading-relaxed max-w-xs">
                                Redefining the digital marketplace with premium curation and seamless transaction experiences.
                            </p>
                        </div>
                        <div class="grid grid-cols-2 gap-8 col-span-2">
                            <div>
                                <h4 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Platform</h4>
                                <ul class="space-y-4">
                                    <li><a href="{{ route('dashboard') }}" class="text-slate-600 hover:text-primary-600 font-bold transition-colors">Marketplace</a></li>
                                    <li><a href="#" class="text-slate-600 hover:text-primary-600 font-bold transition-colors">Categories</a></li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Account</h4>
                                <ul class="space-y-4">
                                    <li><a href="{{ route('profile.edit') }}" class="text-slate-600 hover:text-primary-600 font-bold transition-colors">Profile</a></li>
                                    <li><a href="{{ route('orders.index') }}" class="text-slate-600 hover:text-primary-600 font-bold transition-colors">Order History</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="pt-8 border-t border-slate-50 flex flex-col md:flex-row justify-between items-center gap-6">
                        <div class="text-slate-400 text-sm font-bold tracking-tight">
                            &copy; {{ date('Y') }} CommercialSystem. Crafted for excellence.
                        </div>
                        <div class="flex gap-8">
                            <a href="#" class="text-slate-400 hover:text-slate-600 transition-colors"><span class="sr-only">Twitter</span><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
