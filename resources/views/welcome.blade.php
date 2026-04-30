<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'CommercialSystem') }} | Premium Marketplace</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased selection:bg-primary-500 selection:text-white">
        <div class="relative min-h-screen bg-slate-50 overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-0 left-0 w-full h-[800px] bg-gradient-to-b from-primary-50/50 to-transparent pointer-events-none"></div>
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary-200/30 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute top-1/2 -left-24 w-72 h-72 bg-indigo-200/30 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Navbar -->
            <nav class="relative z-10 max-w-7xl mx-auto px-6 py-8 flex justify-between items-center">
                <a href="/" class="flex items-center gap-2 group">
                    <div class="w-10 h-10 bg-primary-600 rounded-xl flex items-center justify-center shadow-lg shadow-primary-500/30">
                        <x-application-logo class="w-6 h-6 fill-white" />
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-slate-900">Commercial<span class="text-primary-600">System</span></span>
                </a>

                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary py-2.5">Dashboard</a>
                    @else
                        <div class="flex items-center gap-6">
                            <a href="{{ route('login') }}" class="text-slate-600 font-bold hover:text-primary-600 transition-all">Sign In</a>
                            <a href="{{ route('admin.login') }}" class="text-slate-400 font-bold hover:text-indigo-600 transition-all text-sm uppercase tracking-wider">Admin</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-primary py-2.5 px-6">Get Started</a>
                            @endif
                        </div>
                    @endauth
                </div>
            </nav>

            <!-- Hero Section -->
            <main class="relative z-10 max-w-7xl mx-auto px-6 pt-12 pb-24 lg:pt-20">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div class="space-y-10">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary-50 border border-primary-100 text-primary-600 text-sm font-bold uppercase tracking-wider">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-500"></span>
                            </span>
                            Now Live: Global Marketplace
                        </div>
                        
                        <h1 class="text-6xl lg:text-7xl font-bold text-slate-900 leading-[1.1] tracking-tight">
                            The Future of <span class="text-gradient">Commerce</span> is Here.
                        </h1>
                        
                        <p class="text-xl text-slate-600 leading-relaxed max-w-xl">
                            Experience a seamless, secure, and intuitive marketplace designed for modern commerce. Explore premium products and manage your business with ease.
                        </p>

                        <div class="flex flex-wrap gap-4">
                            @auth
                                <a href="{{ route('dashboard') }}" class="btn-primary px-10 py-4 text-lg">
                                    Browse Marketplace
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="btn-primary px-10 py-4 text-lg">
                                    Start Your Journey
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                                <a href="#features" class="btn-secondary px-10 py-4 text-lg">
                                    Explore Features
                                </a>
                            @endauth
                        </div>

                        <div class="pt-8 flex items-center gap-8">
                            <div>
                                <div class="text-2xl font-bold text-slate-900">10k+</div>
                                <div class="text-sm text-slate-500">Active Users</div>
                            </div>
                            <div class="w-px h-10 bg-slate-200"></div>
                            <div>
                                <div class="text-2xl font-bold text-slate-900">500+</div>
                                <div class="text-sm text-slate-500">Premium Products</div>
                            </div>
                            <div class="w-px h-10 bg-slate-200"></div>
                            <div>
                                <div class="text-2xl font-bold text-slate-900">24/7</div>
                                <div class="text-sm text-slate-500">Global Support</div>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute -inset-4 bg-gradient-to-tr from-primary-500 to-indigo-500 rounded-[2.5rem] blur-2xl opacity-20 animate-pulse"></div>
                        <div class="relative rounded-[2rem] overflow-hidden shadow-2xl border border-white/20">
                            <!-- Using the generated hero image -->
                            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2426&auto=format&fit=crop" 
                                 alt="Commercial System Interface" 
                                 class="w-full h-auto object-cover transform hover:scale-105 transition-transform duration-700">
                        </div>
                    </div>
                </div>
            </main>

            <!-- Features Section -->
            <section id="features" class="py-24 bg-white">
                <div class="max-w-7xl mx-auto px-6">
                    <div class="text-center space-y-4 mb-16">
                        <h2 class="text-4xl font-bold text-slate-900">Built for Modern Businesses</h2>
                        <p class="text-lg text-slate-500 max-w-2xl mx-auto">Everything you need to buy, sell, and manage your inventory with professional-grade tools.</p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        <div class="premium-card p-8">
                            <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-xl flex items-center justify-center mb-6">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            </div>
                            <h3 class="text-xl font-bold mb-3">Smart Cart</h3>
                            <p class="text-slate-600">Advanced session-based cart management with real-time stock validation.</p>
                        </div>
                        <div class="premium-card p-8">
                            <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center mb-6">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.040L3 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622l-0.382-3.016z"/></svg>
                            </div>
                            <h3 class="text-xl font-bold mb-3">Secure Checkout</h3>
                            <p class="text-slate-600">Encrypted transaction processing and instant receipt generation.</p>
                        </div>
                        <div class="premium-card p-8">
                            <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-xl flex items-center justify-center mb-6">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            </div>
                            <h3 class="text-xl font-bold mb-3">Insights Dashboard</h3>
                            <p class="text-slate-600">Track your orders and monitor inventory status in real-time.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <footer class="bg-slate-900 py-12 text-slate-400">
                <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-12">
                    <div class="col-span-2">
                        <a href="/" class="flex items-center gap-2 mb-6">
                            <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center shadow-lg shadow-primary-500/30">
                                <x-application-logo class="w-5 h-5 fill-white" />
                            </div>
                            <span class="text-xl font-bold tracking-tight text-white">Commercial<span class="text-primary-500">System</span></span>
                        </a>
                        <p class="max-w-sm">A state-of-the-art commercial platform built for efficiency and scale. Empowering businesses worldwide.</p>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-6">Platform</h4>
                        <ul class="space-y-4">
                            <li><a href="{{ route('dashboard') }}" class="hover:text-primary-500 transition-colors">Marketplace</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-colors">Features</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-colors">Pricing</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-6">Account</h4>
                        <ul class="space-y-4">
                            <li><a href="{{ route('login') }}" class="hover:text-primary-500 transition-colors">Sign In</a></li>
                            <li><a href="{{ route('admin.login') }}" class="hover:text-primary-500 transition-colors">Admin Portal</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-primary-500 transition-colors">Register</a></li>
                            <li><a href="{{ route('profile.edit') }}" class="hover:text-primary-500 transition-colors">Settings</a></li>
                        </ul>
                    </div>
                </div>
                <div class="max-w-7xl mx-auto px-6 pt-12 mt-12 border-t border-slate-800 text-sm text-center">
                    &copy; {{ date('Y') }} CommercialSystemApplication. All rights reserved. Built with excellence.
                </div>
            </footer>
        </div>
    </body>
</html>
