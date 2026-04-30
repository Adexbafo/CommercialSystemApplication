<x-app-layout>
    <div class="py-12 bg-gradient-premium min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Page Header -->
            <div class="mb-12 flex flex-col md:flex-row md:items-end md:justify-between gap-8">
                <div class="space-y-3">
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-primary-50 text-primary-600 text-[10px] font-black uppercase tracking-[0.2em] border border-primary-100">
                        Explore Collection
                    </div>
                    <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tightest">
                        Market<span class="text-primary-600">place</span>
                    </h1>
                    <p class="text-slate-500 font-medium text-lg max-w-md leading-relaxed">
                        Discover premium products from our curated selection of high-end goods.
                    </p>
                </div>
            </div> <!-- Fixed: Added missing closing div for Header -->
                
            <!-- Search Section -->
            <div class="mb-12">
                <form action="{{ route('dashboard') }}" method="GET" class="relative max-w-xl">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search premium products..." 
                           class="w-full pl-12 pr-4 py-4 bg-white border border-slate-200 rounded-2xl focus:ring-2 focus:ring-primary-500 focus:border-transparent shadow-sm transition-all">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    @if(request('search'))
                        <a href="{{ route('dashboard') }}" class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400 hover:text-rose-500">Clear</a>
                    @endif
                </form>
            </div>

            <!-- Products Grid -->
            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
                    @foreach($products as $index => $product)
                        <div class="premium-card group flex flex-col overflow-hidden animate-fade-in-up" style="animation-delay: {{ $index * 100 }}ms">
                            <!-- Product Image Container -->
                            <div class="aspect-[16/10] relative overflow-hidden bg-slate-50">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000 ease-out">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-200">
                                        <svg class="w-20 h-20 mb-3 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Image Preview</span>
                                    </div>
                                @endif
                                
                                <!-- Category Badge -->
                                <div class="absolute top-5 left-5">
                                    <span class="px-4 py-1.5 rounded-full bg-white/95 backdrop-blur-md text-[10px] font-black text-slate-900 uppercase tracking-[0.2em] border border-white/50 shadow-sm">
                                        Premium
                                    </span>
                                </div>

                                <!-- Quick Stock Indicator -->
                                @if($product->quantity > 0 && $product->quantity < 5)
                                    <div class="absolute top-5 right-5">
                                        <span class="px-3 py-1.5 rounded-xl bg-amber-500/90 backdrop-blur-md text-[10px] font-black text-white uppercase tracking-widest shadow-lg">
                                            Limited
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="p-8 flex-grow flex flex-col">
                                <div class="mb-6">
                                    <div class="flex justify-between items-start gap-4 mb-3">
                                        <h3 class="text-2xl font-black text-slate-900 leading-tight group-hover:text-primary-600 transition-colors">
                                            {{ $product->name }}
                                        </h3>
                                        <div class="shrink-0 flex items-center gap-1.5 px-3 py-1 bg-slate-50 rounded-lg border border-slate-100">
                                            <div class="w-1.5 h-1.5 rounded-full {{ $product->quantity > 0 ? 'bg-emerald-500' : 'bg-rose-500' }}"></div>
                                            <span class="text-[10px] font-black uppercase tracking-widest {{ $product->quantity > 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                                {{ $product->quantity > 0 ? 'In Stock' : 'Sold Out' }}
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-slate-500 text-sm font-medium line-clamp-2 leading-relaxed">
                                        {{ $product->description }}
                                    </p>
                                </div>
                                
                                <div class="mt-auto pt-8 border-t border-slate-50">
                                    <div class="flex justify-between items-end mb-8">
                                        <div class="flex flex-col">
                                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Value</span>
                                            <span class="text-3xl font-black text-slate-900 tracking-tight">${{ number_format($product->price, 2) }}</span>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1 block">Units</span>
                                            <span class="text-lg font-bold text-slate-700">{{ $product->quantity }} available</span>
                                        </div>
                                    </div>

                                    @if($product->quantity > 0)
                                        <div class="grid grid-cols-1 gap-3">
                                            <form action="{{ route('checkout.store', $product->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn-primary w-full group/btn shadow-xl shadow-primary-500/10">
                                                    Purchase Now
                                                    <svg class="w-5 h-5 ml-3 group-hover/btn:translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                                    </svg>
                                                </button>
                                            </form>

                                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn-secondary w-full">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                    </svg>
                                                    Add to Cart
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <button disabled class="w-full bg-slate-100 text-slate-400 py-5 rounded-[1.25rem] cursor-not-allowed font-black uppercase tracking-widest text-xs flex items-center justify-center border border-slate-200">
                                            Currently Unavailable
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-32 text-center glass-card rounded-[3rem] animate-in fade-in zoom-in duration-700">
                    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-8 border border-slate-100">
                        <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 mb-3">No matches found</h3>
                    <p class="text-slate-500 font-medium mb-10 max-w-xs mx-auto">We couldn't find any products matching your current criteria.</p>
                    <a href="{{ route('dashboard') }}" class="btn-secondary">Reset Search</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>